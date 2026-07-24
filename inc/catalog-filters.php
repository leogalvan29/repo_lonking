<?php
/**
 * Filtros del catálogo (archive-product.php).
 *
 * Filtrado server-side vía GET + WP_Query (sin AJAX): cada select manda
 * un form GET que recarga la página, replicando el patrón de URL del
 * sitio de referencia (?Marca_equal=Dingli). 100% indexable, sin JS
 * requerido para funcionar.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Definición de los filtros de taxonomía disponibles.
 * clave GET => [ 'taxonomy' => ..., 'label' => ... ]
 */
function amex_catalog_taxonomy_filters() {
	return array(
		'Marca_equal'       => array(
			'taxonomy' => 'pa_marca',
			'label'    => __( 'Marca', 'amex-machinery' ),
		),
		'Combustible_equal' => array(
			'taxonomy' => 'pa_tipo-de-combustible',
			'label'    => __( 'Tipo de Combustible', 'amex-machinery' ),
		),
		'Llanta_equal'      => array(
			'taxonomy' => 'pa_tipo-de-llanta',
			'label'    => __( 'Tipo de Llanta', 'amex-machinery' ),
		),
		'Condicion_equal'   => array(
			'taxonomy' => 'pa_condicion',
			'label'    => __( 'Condición', 'amex-machinery' ),
		),
	);
}

/**
 * URL del catálogo filtrado por condición (nuevo/usado) — usada por los
 * CTAs del hero del home ("Ver equipos usados" / "Ver equipos nuevos").
 */
function amex_catalog_condition_url( $condicion_slug ) {
	return add_query_arg( 'Condicion_equal', $condicion_slug, get_post_type_archive_link( 'product' ) );
}

/**
 * URL del catálogo filtrado por marca — usada por el footer ("Nuestro
 * Catálogo" y fallback de "Marcas") para enlazar a cada marca real.
 */
function amex_catalog_marca_url( $marca_slug ) {
	return add_query_arg( 'Marca_equal', $marca_slug, get_post_type_archive_link( 'product' ) );
}

/**
 * get_terms() seguro: si la taxonomía todavía no existe (p. ej. el
 * atributo de WooCommerce no se ha creado en Productos > Atributos),
 * get_terms() devuelve un WP_Error. Iterar eso directo hace que PHP
 * recorra sus propiedades internas en vez de términos reales — este
 * helper evita ese bug devolviendo un array vacío en su lugar.
 */
function amex_get_terms_safe( $taxonomy ) {
	if ( ! taxonomy_exists( $taxonomy ) ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => true,
		)
	);

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Valores distintos de capacidad_ton (ACF) entre productos publicados,
 * ordenados numéricamente. Usa una consulta directa a postmeta porque
 * no es una taxonomía sino un campo numérico.
 */
function amex_get_distinct_capacities() {
	global $wpdb;

	$values = $wpdb->get_col(
		"SELECT DISTINCT pm.meta_value
		FROM {$wpdb->postmeta} pm
		INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
		WHERE pm.meta_key = 'capacidad_ton'
			AND pm.meta_value != ''
			AND p.post_type = 'product'
			AND p.post_status = 'publish'"
	);

	$values = array_map( 'floatval', $values );
	sort( $values );

	return $values;
}

/**
 * Arma los argumentos de WP_Query a partir de los filtros activos en $_GET.
 */
function amex_build_catalog_query_args( $paged = 1 ) {
	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 12,
		'paged'          => max( 1, (int) $paged ),
	);

	$tax_query = array( 'relation' => 'AND' );

	// Si estamos viendo el archivo de una categoría/atributo de producto
	// (ej. /product-category/montacargas/), filtra por ese término. Sin
	// esto, archive-product.php ignora la URL y siempre muestra lo mismo
	// sin importar la categoría, porque corre su propia WP_Query aparte
	// de la principal (necesario para el filtrado por GET).
	$queried_object = get_queried_object();
	if ( $queried_object instanceof WP_Term && in_array( $queried_object->taxonomy, get_object_taxonomies( 'product' ), true ) ) {
		$tax_query[] = array(
			'taxonomy' => $queried_object->taxonomy,
			'field'    => 'term_id',
			'terms'    => $queried_object->term_id,
		);
	}

	foreach ( amex_catalog_taxonomy_filters() as $get_key => $filter ) {
		if ( empty( $_GET[ $get_key ] ) ) {
			continue;
		}

		$tax_query[] = array(
			'taxonomy' => $filter['taxonomy'],
			'field'    => 'slug',
			'terms'    => sanitize_title( wp_unslash( $_GET[ $get_key ] ) ),
		);
	}

	if ( count( $tax_query ) > 1 ) {
		$args['tax_query'] = $tax_query;
	}

	if ( ! empty( $_GET['Capacidad_equal'] ) ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'capacidad_ton',
				'value'   => floatval( wp_unslash( $_GET['Capacidad_equal'] ) ),
				'compare' => '=',
				'type'    => 'DECIMAL(10,2)',
			),
		);
	}

	if ( ! empty( $_GET['buscar'] ) ) {
		$args['s'] = sanitize_text_field( wp_unslash( $_GET['buscar'] ) );
	}

	return $args;
}

/**
 * Pills de filtros activos para mostrar arriba del grid, con su URL
 * de "quitar este filtro" (conserva los demás parámetros del GET).
 */
function amex_active_catalog_filters() {
	$pills = array();

	foreach ( amex_catalog_taxonomy_filters() as $get_key => $filter ) {
		if ( empty( $_GET[ $get_key ] ) ) {
			continue;
		}

		$term = get_term_by( 'slug', sanitize_title( wp_unslash( $_GET[ $get_key ] ) ), $filter['taxonomy'] );
		$value_label = $term ? $term->name : sanitize_text_field( wp_unslash( $_GET[ $get_key ] ) );

		$pills[] = array(
			'label'      => $filter['label'] . ' = ' . $value_label,
			'remove_url' => amex_catalog_url_without( $get_key ),
		);
	}

	if ( ! empty( $_GET['Capacidad_equal'] ) ) {
		$pills[] = array(
			'label'      => __( 'Capacidad', 'amex-machinery' ) . ' = ' . sanitize_text_field( wp_unslash( $_GET['Capacidad_equal'] ) ) . ' t',
			'remove_url' => amex_catalog_url_without( 'Capacidad_equal' ),
		);
	}

	if ( ! empty( $_GET['buscar'] ) ) {
		$pills[] = array(
			'label'      => __( 'Buscar', 'amex-machinery' ) . ' = ' . sanitize_text_field( wp_unslash( $_GET['buscar'] ) ),
			'remove_url' => amex_catalog_url_without( 'buscar' ),
		);
	}

	return $pills;
}

/**
 * URL del catálogo conservando todos los filtros activos excepto $key.
 */
function amex_catalog_url_without( $key ) {
	$query = $_GET;
	unset( $query[ $key ], $query['paged'] );
	$query = array_map( 'wp_unslash', $query );

	$base = get_post_type_archive_link( 'product' );

	return $query ? add_query_arg( $query, $base ) : $base;
}

/**
 * URL del catálogo sin ningún filtro.
 */
function amex_catalog_clear_url() {
	return get_post_type_archive_link( 'product' );
}

/**
 * ¿Hay algún filtro activo?
 */
function amex_catalog_has_active_filters() {
	foreach ( array( 'Marca_equal', 'Combustible_equal', 'Llanta_equal', 'Condicion_equal', 'Capacidad_equal', 'buscar' ) as $key ) {
		if ( ! empty( $_GET[ $key ] ) ) {
			return true;
		}
	}

	return false;
}

<?php
/**
 * WooCommerce — configuración de catálogo sin carrito.
 *
 * WooCommerce se usa únicamente como motor de catálogo: sin precio,
 * sin "Añadir al carrito", sin checkout. Ver brief-amex-clone.md.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Oculta el precio en todo el sitio (loop, single, widgets).
 * El campo ACF `mostrar_precio` queda reservado para activarlo a futuro
 * en alguna línea de producto, pero ningún template lo consume todavía.
 */
add_filter( 'woocommerce_get_price_html', '__return_empty_string' );

/**
 * Quita "Añadir al carrito" de archivo/loop y de la ficha de producto.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

/**
 * Quita el ícono/enlace del carrito y cualquier bloque de checkout que
 * WooCommerce intente inyectar (mini-cart en widgets, fragmentos AJAX).
 */
function amex_disable_cart_fragments() {
	wp_dequeue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'amex_disable_cart_fragments', 20 );

/**
 * Redirige /carrito y /checkout al home — por si quedan enlaces o bots
 * apuntando a esas rutas nativas de WooCommerce.
 */
function amex_disable_cart_checkout_pages() {
	if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() ) ) {
		wp_safe_redirect( home_url( '/' ) );
		exit;
	}
}
add_action( 'template_redirect', 'amex_disable_cart_checkout_pages' );

/**
 * Devuelve "Nuevo" o "Usado" según el atributo pa_condicion del producto.
 */
function amex_product_condition_label( $product_id ) {
	$terms = get_the_terms( $product_id, 'pa_condicion' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	return $terms[0]->name;
}

/**
 * Slug de archivo a donde debe apuntar el breadcrumb / "volver al catálogo"
 * según la condición del producto (nuevo vs. usado).
 */
function amex_product_catalog_label( $product_id ) {
	$condition = amex_product_condition_label( $product_id );

	if ( false !== stripos( $condition, 'usado' ) ) {
		return __( 'Equipos Usados', 'amex-machinery' );
	}

	return __( 'Equipos Nuevos', 'amex-machinery' );
}

/**
 * URL de WhatsApp con mensaje precargado con el nombre del equipo.
 */
function amex_whatsapp_url( $product_name = '' ) {
	$message = $product_name
		? sprintf( __( 'Hola, me interesa cotizar el equipo %s', 'amex-machinery' ), $product_name )
		: __( 'Necesito más información sobre AMEX Machinery', 'amex-machinery' );

	return 'https://wa.me/526142800464?text=' . rawurlencode( $message );
}

/**
 * WP_Query de productos marcados con un flag ACF true/false (p. ej.
 * `destacado` en el home, `recomendado` en la ficha de producto).
 * Usado por template-parts/product-carousel.php.
 */
function amex_product_carousel_query( $meta_key, $exclude = array(), $limit = 10 ) {
	return new WP_Query(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'post__not_in'   => $exclude,
			'meta_key'       => $meta_key,
			'meta_value'     => '1',
		)
	);
}

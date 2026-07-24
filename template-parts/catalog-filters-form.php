<?php
/**
 * Formulario de búsqueda + filtros del catálogo — reusable.
 *
 * Usado en archive-product.php (donde además filtra en el lugar) y en
 * la sección de catálogo del home (donde solo redirige al catálogo
 * real con esos filtros aplicados — mismo action, mismo mecanismo GET
 * de inc/catalog-filters.php, sin lógica nueva).
 *
 * Autocontenido: no requiere $args, resuelve sus propios términos.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$archive_url        = get_post_type_archive_link( 'product' );
$marca_terms        = amex_get_terms_safe( 'pa_marca' );
$combustible_terms  = amex_get_terms_safe( 'pa_tipo-de-combustible' );
$llanta_terms       = amex_get_terms_safe( 'pa_tipo-de-llanta' );
$capacidades        = amex_get_distinct_capacities();
?>
<form method="get" action="<?php echo esc_url( $archive_url ); ?>" class="catalog-filters">

	<div class="catalog-filters__search">
		<input type="search" name="buscar" placeholder="<?php esc_attr_e( 'Buscar – Escribe aquí', 'amex-machinery' ); ?>"
			value="<?php echo isset( $_GET['buscar'] ) ? esc_attr( wp_unslash( $_GET['buscar'] ) ) : ''; ?>">
		<button type="submit" aria-label="<?php esc_attr_e( 'Buscar', 'amex-machinery' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8"/><path d="M20 20l-3.2-3.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
		</button>
	</div>

	<div class="catalog-filters__grid">
		<label class="catalog-filter">
			<span><?php esc_html_e( 'Marca', 'amex-machinery' ); ?></span>
			<select name="Marca_equal">
				<option value=""><?php esc_html_e( 'Seleccionar…', 'amex-machinery' ); ?></option>
				<?php foreach ( $marca_terms as $term ) : ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( isset( $_GET['Marca_equal'] ) ? sanitize_title( wp_unslash( $_GET['Marca_equal'] ) ) : '', $term->slug ); ?>>
						<?php echo esc_html( $term->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</label>

		<label class="catalog-filter">
			<span><?php esc_html_e( 'Tipo de Combustible', 'amex-machinery' ); ?></span>
			<select name="Combustible_equal">
				<option value=""><?php esc_html_e( 'Seleccionar…', 'amex-machinery' ); ?></option>
				<?php foreach ( $combustible_terms as $term ) : ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( isset( $_GET['Combustible_equal'] ) ? sanitize_title( wp_unslash( $_GET['Combustible_equal'] ) ) : '', $term->slug ); ?>>
						<?php echo esc_html( $term->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</label>

		<label class="catalog-filter">
			<span><?php esc_html_e( 'Tipo de Llanta', 'amex-machinery' ); ?></span>
			<select name="Llanta_equal">
				<option value=""><?php esc_html_e( 'Seleccionar…', 'amex-machinery' ); ?></option>
				<?php foreach ( $llanta_terms as $term ) : ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( isset( $_GET['Llanta_equal'] ) ? sanitize_title( wp_unslash( $_GET['Llanta_equal'] ) ) : '', $term->slug ); ?>>
						<?php echo esc_html( $term->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</label>

		<label class="catalog-filter catalog-filter--capacidad">
			<span><?php esc_html_e( 'Capacidad de carga', 'amex-machinery' ); ?></span>
			<div class="catalog-filter__inline">
				<select name="Capacidad_equal">
					<option value=""><?php esc_html_e( 'Seleccionar…', 'amex-machinery' ); ?></option>
					<?php foreach ( $capacidades as $cap ) : ?>
						<option value="<?php echo esc_attr( $cap ); ?>" <?php selected( isset( $_GET['Capacidad_equal'] ) ? floatval( wp_unslash( $_GET['Capacidad_equal'] ) ) : '', $cap ); ?>>
							<?php echo esc_html( $cap ); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<span class="catalog-filter__unit">t</span>
			</div>
		</label>
	</div>
</form>

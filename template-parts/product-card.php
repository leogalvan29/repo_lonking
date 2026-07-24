<?php
/**
 * Tarjeta de producto reusable (home, archivo de catálogo, similares).
 * Espera el global $product (WC_Product) ya inicializado por el loop.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}

$product_id  = $product->get_id();
$brand_terms = get_the_terms( $product_id, 'pa_marca' );
$brand       = ( ! empty( $brand_terms ) && ! is_wp_error( $brand_terms ) ) ? $brand_terms[0]->name : '';
$type_terms  = get_the_terms( $product_id, 'pa_tipo-de-combustible' );
$type        = ( ! empty( $type_terms ) && ! is_wp_error( $type_terms ) ) ? $type_terms[0]->name : '';
$tire_terms  = get_the_terms( $product_id, 'pa_tipo-de-llanta' );
$tire        = ( ! empty( $tire_terms ) && ! is_wp_error( $tire_terms ) ) ? $tire_terms[0]->name : '';
$condition   = amex_product_condition_label( $product_id );
$cap_ton     = amex_get_field( 'capacidad_ton', $product_id );
$cap_lb      = amex_get_field( 'capacidad_lb', $product_id );
?>
<article class="product-card">
	<div class="product-card__media">
		<?php if ( $condition ) : ?>
			<span class="product-card__badge"><?php echo esc_html( $condition ); ?></span>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="product-card__image-link">
			<?php echo $product->get_image( 'medium', array( 'class' => 'product-card__image' ) ); ?>
		</a>
	</div>

	<div class="product-card__body">
		<p class="product-card__brand"><?php echo esc_html( $brand ); ?></p>
		<h3 class="product-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<ul class="product-card__meta">
			<?php if ( $cap_ton ) : ?>
				<li><span><?php esc_html_e( 'Capacidad:', 'amex-machinery' ); ?></span> <?php echo esc_html( $cap_ton ); ?> t</li>
			<?php elseif ( $cap_lb ) : ?>
				<li><span><?php esc_html_e( 'Capacidad:', 'amex-machinery' ); ?></span> <?php echo esc_html( $cap_lb ); ?> lb</li>
			<?php endif; ?>
			<?php if ( $type ) : ?>
				<li><span><?php esc_html_e( 'Tipo:', 'amex-machinery' ); ?></span> <?php echo esc_html( $type ); ?></li>
			<?php endif; ?>
			<?php if ( $tire ) : ?>
				<li><span><?php esc_html_e( 'Llanta:', 'amex-machinery' ); ?></span> <?php echo esc_html( $tire ); ?></li>
			<?php endif; ?>
		</ul>

		<div class="product-card__buttons">
			<button type="button" class="btn btn--primary btn--sm js-open-quote" data-product-name="<?php the_title_attribute(); ?>">
				<?php esc_html_e( 'Cotizar', 'amex-machinery' ); ?>
			</button>
			<a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">
				<?php esc_html_e( 'Ver detalles', 'amex-machinery' ); ?>
			</a>
		</div>

		<button type="button" class="product-card__favorite" aria-pressed="false">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 20.5s-7.5-4.6-10-9.3C0.3 8 2 4.5 5.5 4.2c2-.2 3.7.8 4.9 2.4 1.2-1.6 2.9-2.6 4.9-2.4 3.5.3 5.2 3.8 3.5 7-2.5 4.7-10 9.3-10 9.3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
			<span><?php esc_html_e( 'Guardar en favoritos', 'amex-machinery' ); ?></span>
		</button>
	</div>
</article>

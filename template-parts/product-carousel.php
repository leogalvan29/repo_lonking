<?php
/**
 * Carrusel de productos reusable — template-parts/product-carousel.php
 *
 * Solo la mecánica (track + product-card + flechas). El título, el
 * query y cualquier contenido extra (CTAs, barra de confianza, etc.)
 * los decide quien lo llama — ver template-parts/destacados-home.php
 * y la sección "Recomendados" en single-product.php.
 *
 * $args esperados:
 *   'query'        WP_Query ya ejecutado, con have_posts() en true.
 *   'carousel_id'  string único, usado por assets/js/main.js para
 *                  distinguir las flechas de cada carrusel si hay
 *                  más de uno en la misma página.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$query       = $args['query'];
$carousel_id = $args['carousel_id'];
?>
<div class="carousel" data-carousel="<?php echo esc_attr( $carousel_id ); ?>">
	<div class="carousel__viewport">
		<div class="carousel__track">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<div class="carousel__item">
					<?php get_template_part( 'template-parts/product-card' ); ?>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>

	<div class="carousel__arrows">
		<button type="button" class="carousel__arrow" data-carousel-prev aria-label="<?php esc_attr_e( 'Anterior', 'amex-machinery' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
		<button type="button" class="carousel__arrow" data-carousel-next aria-label="<?php esc_attr_e( 'Siguiente', 'amex-machinery' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
	</div>
</div>

<?php
/**
 * Sección de catálogo del home — template-parts/catalogo-home.php
 *
 * Reusa el mismo formulario de búsqueda/filtros del catálogo
 * (template-parts/catalog-filters-form.php) — al enviarlo, redirige a
 * archive-product.php con esos filtros aplicados, no filtra en el
 * lugar. El grid de abajo muestra productos aleatorios (decorativo,
 * independiente del formulario).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$titulo    = get_field( 'catalogo_titulo' ) ?: __( 'Explora nuestro catálogo', 'amex-machinery' );
$subtitulo = get_field( 'catalogo_subtitulo' ) ?: __( 'Usa los filtros para encontrar tu equipo más rápido', 'amex-machinery' );
$cta_texto = get_field( 'catalogo_cta_texto' ) ?: __( 'Ver todo el catálogo', 'amex-machinery' );

$random_query = new WP_Query(
	array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 8,
		'orderby'        => 'rand',
	)
);
?>
<section class="catalogo-home">
	<div class="container">
		<h2 class="catalogo-home__title"><?php echo esc_html( $titulo ); ?></h2>
		<p class="catalogo-home__subtitle"><?php echo esc_html( $subtitulo ); ?></p>

		<?php get_template_part( 'template-parts/catalog-filters-form' ); ?>

		<?php if ( $random_query->have_posts() ) : ?>
			<div class="product-grid catalogo-home__grid">
				<?php
				while ( $random_query->have_posts() ) :
					$random_query->the_post();
					get_template_part( 'template-parts/product-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php endif; ?>

		<div class="catalogo-home__cta-row">
			<a class="btn btn--primary" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>"><?php echo esc_html( $cta_texto ); ?></a>
		</div>
	</div>
</section>

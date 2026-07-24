<?php
/**
 * archive-product.php — Catálogo con filtros
 *
 * Filtrado server-side vía GET + WP_Query (ver inc/catalog-filters.php),
 * replicando el patrón ?Marca_equal=Dingli del sitio de referencia.
 * Reusa template-parts/product-card.php para el grid.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

$query = new WP_Query( amex_build_catalog_query_args( $paged ) );
$pills = amex_active_catalog_filters();
?>

<section class="catalog-intro">
	<div class="container">
		<p class="catalog-intro__lead">
			<?php
			printf(
				/* translators: 1: "filtros" bold, 2: "más rápido" bold */
				esc_html__( 'Usa los %1$s para encontrar tu equipo %2$s', 'amex-machinery' ),
				'<strong>' . esc_html__( 'filtros', 'amex-machinery' ) . '</strong>',
				'<strong>' . esc_html__( 'más rápido', 'amex-machinery' ) . '</strong>'
			);
			?>
		</p>

		<?php get_template_part( 'template-parts/catalog-filters-form' ); ?>

		<div class="catalog-filters__status">
			<div class="catalog-filters__pills">
				<?php foreach ( $pills as $pill ) : ?>
					<a class="filter-pill" href="<?php echo esc_url( $pill['remove_url'] ); ?>">
						<?php echo esc_html( $pill['label'] ); ?>
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
					</a>
				<?php endforeach; ?>
			</div>

			<div class="catalog-filters__meta">
				<span>
					<?php
					printf(
						/* translators: 1: número mostrado, 2: total */
						esc_html__( 'Mostrando %1$d de %2$d', 'amex-machinery' ),
						count( $query->posts ),
						(int) $query->found_posts
					);
					?>
				</span>
				<?php if ( amex_catalog_has_active_filters() ) : ?>
					<a class="btn btn--outline btn--sm" href="<?php echo esc_url( amex_catalog_clear_url() ); ?>">
						<?php esc_html_e( 'Borrar Filtros', 'amex-machinery' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="catalog-grid">
	<div class="container">
		<?php if ( $query->have_posts() ) : ?>
			<div class="product-grid">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/product-card' );
				endwhile;
				?>
			</div>

			<?php
			$pagination_links = paginate_links(
				array(
					'base'      => add_query_arg( 'paged', '%#%' ),
					'format'    => '',
					'current'   => max( 1, (int) $paged ),
					'total'     => (int) $query->max_num_pages,
					'prev_text' => __( '‹ Anterior', 'amex-machinery' ),
					'next_text' => __( 'Siguiente ›', 'amex-machinery' ),
				)
			);

			if ( $pagination_links ) :
				?>
				<nav class="catalog-pagination" aria-label="<?php esc_attr_e( 'Paginación del catálogo', 'amex-machinery' ); ?>">
					<?php echo wp_kses_post( $pagination_links ); ?>
				</nav>
				<?php
			endif;
			?>

		<?php else : ?>
			<p class="catalog-empty">
				<?php esc_html_e( 'No se encontraron equipos con esos filtros. Intenta quitar alguno.', 'amex-machinery' ); ?>
			</p>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>

<?php get_template_part( 'template-parts/quote-modal' ); ?>

<?php get_footer(); ?>

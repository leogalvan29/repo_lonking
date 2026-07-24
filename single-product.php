<?php
/**
 * single-product.php — Ficha de producto
 *
 * Reemplaza el wrapper por defecto de WooCommerce por un template
 * propio (sin precio, sin "Añadir al carrito"), siguiendo el diseño
 * del sitio de referencia: hero con galería + CTAs, tabs de
 * Descripción/Detalles técnicos y sección de productos similares.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	global $product;
	if ( ! $product instanceof WC_Product ) {
		$product = wc_get_product( get_the_ID() );
	}

	$product_id   = get_the_ID();
	$brand_terms  = get_the_terms( $product_id, 'pa_marca' );
	$brand        = ( ! empty( $brand_terms ) && ! is_wp_error( $brand_terms ) ) ? $brand_terms[0]->name : '';
	$type_terms   = get_the_terms( $product_id, 'pa_tipo-de-combustible' );
	$type         = ( ! empty( $type_terms ) && ! is_wp_error( $type_terms ) ) ? $type_terms[0]->name : '';
	$tire_terms   = get_the_terms( $product_id, 'pa_tipo-de-llanta' );
	$tire         = ( ! empty( $tire_terms ) && ! is_wp_error( $tire_terms ) ) ? $tire_terms[0]->name : '';
	$condition    = amex_product_condition_label( $product_id );
	$catalog_label = amex_product_catalog_label( $product_id );
	$sku          = $product->get_sku();

	$cap_ton  = amex_get_field( 'capacidad_ton', $product_id );
	$cap_lb   = amex_get_field( 'capacidad_lb', $product_id );
	$horas    = amex_get_field( 'horas', $product_id );
	$ficha_pdf = amex_get_field( 'ficha_tecnica_pdf', $product_id );
	$descripcion_larga = amex_get_field( 'descripcion_larga', $product_id );

	$main_image_id = $product->get_image_id();
	$gallery_ids   = $product->get_gallery_image_ids();
	$details_image = amex_get_field( 'imagen_detalle', $product_id );
	?>

	<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'amex-machinery' ); ?>">
		<div class="container breadcrumb__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Inicio', 'amex-machinery' ); ?></a>
			<span class="breadcrumb__sep">/</span>
			<a href="#"><?php echo esc_html( $catalog_label ); ?></a>
			<span class="breadcrumb__sep">/</span>
			<span class="breadcrumb__current"><?php the_title(); ?></span>
		</div>
	</nav>

	<section class="product-hero">
		<div class="container product-hero__grid">

			<div class="product-hero__gallery">
				<div class="product-hero__main-image">
					<?php if ( $condition ) : ?>
						<span class="product-hero__badge"><?php echo esc_html( $condition ); ?></span>
					<?php endif; ?>
					<?php if ( $main_image_id ) : ?>
						<img src="<?php echo esc_url( wp_get_attachment_image_url( $main_image_id, 'large' ) ); ?>"
							data-full="<?php echo esc_url( wp_get_attachment_image_url( $main_image_id, 'full' ) ); ?>"
							alt="<?php echo esc_attr( get_the_title() ); ?>" id="product-main-image">
					<?php else : ?>
						<?php echo wc_placeholder_img( 'large' ); ?>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $gallery_ids ) ) : ?>
					<div class="product-hero__thumbs">
						<?php if ( $main_image_id ) : ?>
							<button type="button" class="product-hero__thumb is-active" data-full="<?php echo esc_url( wp_get_attachment_image_url( $main_image_id, 'full' ) ); ?>">
								<?php echo wp_get_attachment_image( $main_image_id, 'thumbnail' ); ?>
							</button>
						<?php endif; ?>
						<?php foreach ( $gallery_ids as $image_id ) : ?>
							<button type="button" class="product-hero__thumb" data-full="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'full' ) ); ?>">
								<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="product-hero__info">
				<p class="product-hero__eyebrow"><?php echo esc_html( $brand ); ?></p>
				<h1 class="product-hero__title"><?php the_title(); ?></h1>

				<?php if ( $sku ) : ?>
					<p class="product-hero__sku"><?php esc_html_e( 'Modelo/SKU:', 'amex-machinery' ); ?> <strong><?php echo esc_html( $sku ); ?></strong></p>
				<?php endif; ?>

				<?php if ( $product->get_short_description() ) : ?>
					<div class="product-hero__excerpt"><?php echo wp_kses_post( $product->get_short_description() ); ?></div>
				<?php endif; ?>

				<div class="product-hero__utility-actions">
					<button type="button" class="product-hero__action js-share">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16.5 8a2.5 2.5 0 1 0-2.45-3H14a2.5 2.5 0 0 0 .05 1L8.3 9.02A2.5 2.5 0 0 0 6 8a2.5 2.5 0 0 0 0 5 2.48 2.48 0 0 0 1.7-.68L14 15.4a2.5 2.5 0 1 0 .5-1.9l-6.2-3.06a2.5 2.5 0 0 0 0-1L14.5 6.4c.4.35.9.58 1.45.6H16.5Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
						<span><?php esc_html_e( 'Compartir', 'amex-machinery' ); ?></span>
					</button>
					<button type="button" class="product-hero__action js-print">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 9V4h12v5M6 18H4a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-2M6 14h12v6H6v-6Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
						<span><?php esc_html_e( 'Imprimir', 'amex-machinery' ); ?></span>
					</button>
				</div>

				<div class="product-hero__cta-row">
					<button type="button" class="btn btn--primary js-open-quote" data-product-name="<?php the_title_attribute(); ?>">
						<?php esc_html_e( 'Solicitar Cotización', 'amex-machinery' ); ?>
					</button>
					<a class="btn btn--whatsapp" href="<?php echo esc_url( amex_whatsapp_url( get_the_title() ) ); ?>" target="_blank" rel="noopener">
						<?php esc_html_e( 'WhatsApp', 'amex-machinery' ); ?>
					</a>
				</div>

			</div>

		</div>
	</section>

	<section class="product-details">
		<div class="container product-details__grid<?php echo $details_image ? '' : ' has-no-image'; ?>">

			<div class="product-details__content">
				<p class="product-details__eyebrow"><?php esc_html_e( 'Detalles', 'amex-machinery' ); ?></p>
				<h2 class="product-details__title"><?php the_title(); ?></h2>

				<div class="product-tabs">
					<div class="product-tabs__menu" role="tablist">
						<button type="button" class="product-tabs__link is-active" role="tab" aria-selected="true" data-tab="descripcion">
							<?php esc_html_e( 'Descripción', 'amex-machinery' ); ?>
						</button>
						<button type="button" class="product-tabs__link" role="tab" aria-selected="false" data-tab="tecnico">
							<?php esc_html_e( 'Detalles técnicos', 'amex-machinery' ); ?>
						</button>
					</div>

					<div class="product-tabs__content">
						<div class="product-tabs__pane is-active" data-pane="descripcion">
							<?php if ( $descripcion_larga ) : ?>
								<div class="product-tabs__prose"><?php echo wp_kses_post( $descripcion_larga ); ?></div>
							<?php elseif ( get_the_content() ) : ?>
								<div class="product-tabs__prose"><?php the_content(); ?></div>
							<?php else : ?>
								<p><?php esc_html_e( 'Descripción no disponible todavía.', 'amex-machinery' ); ?></p>
							<?php endif; ?>
						</div>

						<div class="product-tabs__pane" data-pane="tecnico">
							<table class="product-specs">
								<thead>
									<tr>
										<th><?php esc_html_e( 'Característica', 'amex-machinery' ); ?></th>
										<th><?php esc_html_e( 'Detalle', 'amex-machinery' ); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php if ( $brand ) : ?>
										<tr><td><?php esc_html_e( 'Marca', 'amex-machinery' ); ?></td><td><?php echo esc_html( $brand ); ?></td></tr>
									<?php endif; ?>
									<?php if ( $type ) : ?>
										<tr><td><?php esc_html_e( 'Tipo de combustible', 'amex-machinery' ); ?></td><td><?php echo esc_html( $type ); ?></td></tr>
									<?php endif; ?>
									<?php if ( $cap_ton ) : ?>
										<tr><td><?php esc_html_e( 'Capacidad (t)', 'amex-machinery' ); ?></td><td><?php echo esc_html( $cap_ton ); ?> t</td></tr>
									<?php endif; ?>
									<?php if ( $cap_lb ) : ?>
										<tr><td><?php esc_html_e( 'Capacidad (lb)', 'amex-machinery' ); ?></td><td><?php echo esc_html( $cap_lb ); ?> lb</td></tr>
									<?php endif; ?>
									<?php if ( $tire ) : ?>
										<tr><td><?php esc_html_e( 'Tipo de llanta', 'amex-machinery' ); ?></td><td><?php echo esc_html( $tire ); ?></td></tr>
									<?php endif; ?>
									<?php if ( $horas && false !== stripos( $condition, 'usado' ) ) : ?>
										<tr><td><?php esc_html_e( 'Horas de uso', 'amex-machinery' ); ?></td><td><?php echo esc_html( $horas ); ?> h</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="product-details__actions">
					<a class="btn btn--primary" href="tel:+526142800464">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.6"/><path d="M5 19.5c1.2-3.2 4-5 7-5s5.8 1.8 7 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
						<span><?php esc_html_e( 'Contacta a un asesor', 'amex-machinery' ); ?></span>
					</a>

					<?php if ( $ficha_pdf ) : ?>
						<a class="btn btn--outline" href="<?php echo esc_url( is_array( $ficha_pdf ) ? $ficha_pdf['url'] : $ficha_pdf ); ?>" target="_blank" rel="noopener">
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 16L16 11H13V4H11V11H8L12 16Z" fill="currentColor"/><path d="M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z" fill="currentColor"/></svg>
							<span><?php esc_html_e( 'Descargar ficha técnica', 'amex-machinery' ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( $details_image ) : ?>
				<div class="product-details__image">
					<img src="<?php echo esc_url( $details_image['url'] ); ?>" alt="<?php echo esc_attr( $details_image['alt'] ); ?>" loading="lazy">
				</div>
			<?php endif; ?>

		</div>
	</section>

	<?php
	$related_ids = array();
	if ( $brand_terms && ! is_wp_error( $brand_terms ) ) {
		$related_query = new WP_Query(
			array(
				'post_type'      => 'product',
				'posts_per_page' => 6,
				'post__not_in'   => array( $product_id ),
				'tax_query'      => array(
					array(
						'taxonomy' => 'pa_marca',
						'field'    => 'slug',
						'terms'    => $brand_terms[0]->slug,
					),
				),
			)
		);

		if ( $related_query->have_posts() ) :
			?>
			<section class="products-similar">
				<div class="container">
					<h2 class="products-similar__title"><?php esc_html_e( 'Productos Similares', 'amex-machinery' ); ?></h2>
					<div class="product-grid">
						<?php
						while ( $related_query->have_posts() ) :
							$related_query->the_post();
							get_template_part( 'template-parts/product-card' );
						endwhile;
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
		wp_reset_postdata();
	}

	$recomendados_query = amex_product_carousel_query( 'recomendado', array( $product_id ) );

	if ( $recomendados_query->have_posts() ) :
		?>
		<section class="recomendados">
			<div class="container">
				<h2 class="recomendados__title"><?php esc_html_e( 'Recomendados', 'amex-machinery' ); ?></h2>
				<?php get_template_part( 'template-parts/product-carousel', null, array( 'query' => $recomendados_query, 'carousel_id' => 'recomendados' ) ); ?>
			</div>
		</section>
		<?php
	endif;
	?>

<?php endwhile; ?>

<?php get_template_part( 'template-parts/quote-modal' ); ?>

<?php get_footer(); ?>

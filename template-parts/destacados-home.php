<?php
/**
 * Sección "Equipos Destacados" del home — template-parts/destacados-home.php
 *
 * Carrusel de productos marcados como destacados (campo ACF
 * `destacado` en el producto — brief-amex-clone.md, home sección 5).
 * La mecánica del carrusel vive en template-parts/product-carousel.php
 * (compartida con "Recomendados" en la ficha de producto). Debajo va
 * una barra de confianza con 4 puntos (íconos fijos por posición).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$destacados_query = amex_product_carousel_query( 'destacado' );

if ( ! $destacados_query->have_posts() ) {
	return;
}

$titulo     = get_field( 'destacados_titulo' ) ?: __( 'Equipos Destacados', 'amex-machinery' );
$cta1_texto = get_field( 'destacados_cta1_texto' ) ?: __( 'Ver equipos nuevos', 'amex-machinery' );
$cta2_texto = get_field( 'destacados_cta2_texto' ) ?: __( 'Contáctanos', 'amex-machinery' );
$cta2_url   = amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#';

$trust = array(
	array(
		'texto' => get_field( 'trust_1_texto' ) ?: __( 'Entrega en todo México', 'amex-machinery' ),
		'icon'  => '<path d="M12 21s-7-6.5-7-12a7 7 0 1 1 14 0c0 5.5-7 12-7 12Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5"/>',
	),
	array(
		'texto' => get_field( 'trust_2_texto' ) ?: __( 'Soporte técnico especializado', 'amex-machinery' ),
		'icon'  => '<circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M4 20c0-2.8 2.2-5 5-5s5 2.2 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M15 8.5l1.5 1.5L20 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
	array(
		'texto' => get_field( 'trust_3_texto' ) ?: __( 'Aliado oficial de HELI', 'amex-machinery' ),
		'icon'  => 'text',
	),
	array(
		'texto' => get_field( 'trust_4_texto' ) ?: __( '+500 Empresas confían en nosotros', 'amex-machinery' ),
		'icon'  => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
);
?>
<section class="destacados">
	<div class="container">
		<h2 class="destacados__title"><?php echo esc_html( $titulo ); ?></h2>

		<?php get_template_part( 'template-parts/product-carousel', null, array( 'query' => $destacados_query, 'carousel_id' => 'destacados' ) ); ?>

		<div class="destacados__cta-row">
			<a class="btn btn--primary" href="<?php echo esc_url( amex_catalog_condition_url( 'nuevo' ) ); ?>"><?php echo esc_html( $cta1_texto ); ?></a>
			<a class="btn btn--outline" href="<?php echo esc_url( $cta2_url ); ?>"><?php echo esc_html( $cta2_texto ); ?></a>
		</div>

		<div class="destacados__trust">
			<?php foreach ( $trust as $item ) : ?>
				<div class="destacados__trust-item">
					<span class="destacados__trust-icon">
						<?php if ( 'text' === $item['icon'] ) : ?>
							HELI
						<?php else : ?>
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><?php echo $item['icon']; ?></svg>
						<?php endif; ?>
					</span>
					<span><?php echo esc_html( $item['texto'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

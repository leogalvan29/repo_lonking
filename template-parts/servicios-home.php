<?php
/**
 * Sección "Servicios" del home — template-parts/servicios-home.php
 *
 * Bloque de servicios (Servicio Técnico, Refacciones, Capacitación y
 * Seguridad) con 3 tarjetas. Mismo patrón que amex360-home.php:
 * contenido editable vía ACF (field group "Home — Servicios"),
 * íconos de las 3 tarjetas fijos por posición.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$titulo    = get_field( 'servicios_titulo' ) ?: __( 'Cero downtime, máxima productividad', 'amex-machinery' );
$subtitulo = get_field( 'servicios_subtitulo' ) ?: __( 'Stock permanente de refacciones críticas. Piezas originales, entrega express y soporte técnico para instalación. Con AMEX tu operación nunca se detiene.', 'amex-machinery' );
$cta_texto = get_field( 'servicios_cta_texto' ) ?: __( 'Contáctanos', 'amex-machinery' );
$bg_image  = get_field( 'servicios_imagen_fondo' );
$cta_url   = amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#';

$cards = array(
	array(
		'titulo' => get_field( 'servicios_card_1_titulo' ) ?: __( 'Servicio Técnico y Mantenimiento', 'amex-machinery' ),
		'desc'   => get_field( 'servicios_card_1_desc' ) ?: __( 'Tu equipo siempre disponible, tu operación sin pausas', 'amex-machinery' ),
		'icon'   => '<circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M12 8v4l3 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 3v1.5M12 19.5V21M21 12h-1.5M4.5 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
	),
	array(
		'titulo' => get_field( 'servicios_card_2_titulo' ) ?: __( 'Refacciones', 'amex-machinery' ),
		'desc'   => get_field( 'servicios_card_2_desc' ) ?: __( 'Refacciones originales y marcas líderes para tu operación', 'amex-machinery' ),
		'icon'   => '<path d="M20 11a8 8 0 0 0-14.9-3.5M4 13a8 8 0 0 0 14.9 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M4 4v4h4M20 20v-4h-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
	array(
		'titulo' => get_field( 'servicios_card_3_titulo' ) ?: __( 'Capacitación y Seguridad', 'amex-machinery' ),
		'desc'   => get_field( 'servicios_card_3_desc' ) ?: __( 'Operadores capacitados, operaciones más seguras', 'amex-machinery' ),
		'icon'   => '<path d="M4 13.5c0-3 2.5-4 5-5.5V5a2 2 0 1 1 4 0v3c2.5 1.5 5 2.5 5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 13.5 2 20l6-2 4 2 4-2 6 2-2-6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
);
?>
<section class="servicios-home"<?php echo $bg_image ? ' style="--servicios-bg: url(' . esc_url( $bg_image['url'] ) . ')"' : ''; ?>>
	<div class="servicios-home__overlay"></div>

	<div class="container servicios-home__grid">
		<div class="servicios-home__content">
			<p class="servicios-home__logo">
				<span class="servicios-home__logo-word">A<span class="servicios-home__logo-m">M</span>EX</span>
				<span class="servicios-home__logo-box">MACHINERY</span>
			</p>

			<h2 class="servicios-home__title"><?php echo esc_html( $titulo ); ?></h2>

			<p class="servicios-home__subtitle"><?php echo esc_html( $subtitulo ); ?></p>

			<a class="btn btn--primary" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_texto ); ?></a>
		</div>

		<div class="servicios-home__cards">
			<?php foreach ( $cards as $card ) : ?>
				<div class="servicios-home__card">
					<span class="servicios-home__card-icon">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><?php echo $card['icon']; ?></svg>
					</span>
					<div>
						<h3><?php echo esc_html( $card['titulo'] ); ?></h3>
						<p><?php echo esc_html( $card['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

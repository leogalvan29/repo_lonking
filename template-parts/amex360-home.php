<?php
/**
 * Sección "AMEX 360°" del home — template-parts/amex360-home.php
 *
 * Bloque de app/servicios con 4 features (brief-amex-clone.md, home
 * sección 4). Contenido editable vía ACF (field group "Home — AMEX
 * 360°"), excepto los íconos de las 4 features, fijos por posición.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$titulo    = get_field( 'amex360_titulo' ) ?: __( 'Soluciones flexibles para cada necesidad operativa', 'amex-machinery' );
$subtitulo = get_field( 'amex360_subtitulo' ) ?: __( 'Nuestra app está diseñada para que tengas visibilidad, control y soporte inmediato, optimizando cada aspecto de tu operación.', 'amex-machinery' );
$cta_texto = get_field( 'amex360_cta_texto' ) ?: __( 'Contáctanos', 'amex-machinery' );
$bg_image  = get_field( 'amex360_imagen_fondo' );
$cta_url   = amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#';

$features = array(
	array(
		'texto' => get_field( 'amex360_feature_1' ) ?: __( 'Gestión de flota', 'amex-machinery' ),
		'icon'  => '<path d="M4 17V9l6-3 6 3v8" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M4 17h12M16 17v-5l4-1v6" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><circle cx="7" cy="19" r="1.4" stroke="currentColor" stroke-width="1.3"/><circle cx="14" cy="19" r="1.4" stroke="currentColor" stroke-width="1.3"/>',
	),
	array(
		'texto' => get_field( 'amex360_feature_2' ) ?: __( 'Solicitudes en línea', 'amex-machinery' ),
		'icon'  => '<circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M4 19c0-2.8 2.2-5 5-5s5 2.2 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M15 8.5l1.5 1.5L20 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
	array(
		'texto' => get_field( 'amex360_feature_3' ) ?: __( 'Historial de servicio', 'amex-machinery' ),
		'icon'  => '<path d="M6 3.5h9l3 3V20a.5.5 0 0 1-.5.5h-11A.5.5 0 0 1 6 20V4a.5.5 0 0 1 .5-.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 10h6M9 13.5h6M9 17h3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
	),
	array(
		'texto' => get_field( 'amex360_feature_4' ) ?: __( 'Disponibilidad de flota', 'amex-machinery' ),
		'icon'  => '<circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
);
?>
<section class="amex360"<?php echo $bg_image ? ' style="--amex360-bg: url(' . esc_url( $bg_image['url'] ) . ')"' : ''; ?>>
	<div class="amex360__overlay"></div>

	<div class="container amex360__content">
		<p class="amex360__logo">Lonking<span> - Mexico</span></p>

		<h2 class="amex360__title"><?php echo esc_html( $titulo ); ?></h2>

		<p class="amex360__subtitle"><?php echo esc_html( $subtitulo ); ?></p>

		<a class="btn btn--primary" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_texto ); ?></a>

		<div class="amex360__features">
			<?php foreach ( $features as $feature ) : ?>
				<div class="amex360__feature">
					<span class="amex360__feature-icon">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><?php echo $feature['icon']; ?></svg>
					</span>
					<span class="amex360__feature-text"><?php echo esc_html( $feature['texto'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

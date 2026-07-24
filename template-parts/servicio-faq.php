<?php
/**
 * Bloque 3b — FAQ de página de servicio (reusable: venta, renta, etc.).
 * Acordeón (JS genérico en main.js, data-accordion). 6 preguntas fijas
 * (ACF free no tiene repeater), pregunta+respuesta cada una editable.
 *
 * $args esperados:
 *   'prefix'   string, prefijo de los campos ACF.
 *   'defaults' array asociativo: faq_titulo, faq_N_pregunta (N=1..6).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prefix   = $args['prefix'];
$defaults = isset( $args['defaults'] ) ? $args['defaults'] : array();

$titulo   = get_field( "{$prefix}_faq_titulo" ) ?: ( $defaults['faq_titulo'] ?? __( 'Preguntas frecuentes', 'amex-machinery' ) );
$bg_image = get_field( "{$prefix}_faq_imagen_fondo" );

$faqs = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$pregunta = get_field( "{$prefix}_faq_{$i}_pregunta" ) ?: ( $defaults["faq_{$i}_pregunta"] ?? '' );
	if ( ! $pregunta ) {
		continue;
	}
	$faqs[] = array(
		'pregunta'  => $pregunta,
		'respuesta' => get_field( "{$prefix}_faq_{$i}_respuesta" ),
	);
}

if ( ! $faqs ) {
	return;
}
?>
<section class="servicio-faq"<?php echo $bg_image ? ' style="--servicio-faq-bg: url(' . esc_url( $bg_image['url'] ) . ')"' : ''; ?>>
	<div class="servicio-faq__overlay"></div>

	<div class="container servicio-faq__container">
		<div class="servicio-faq__card">
			<h2><?php echo esc_html( $titulo ); ?></h2>

			<div class="servicio-faq__list">
				<?php foreach ( $faqs as $faq ) : ?>
					<div class="servicio-faq__item" data-accordion>
						<button type="button" class="servicio-faq__question" data-accordion-toggle aria-expanded="false">
							<span><?php echo esc_html( $faq['pregunta'] ); ?></span>
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<div class="servicio-faq__answer" data-accordion-panel>
							<p><?php echo esc_html( $faq['respuesta'] ? $faq['respuesta'] : __( 'Contáctanos para más detalles.', 'amex-machinery' ) ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

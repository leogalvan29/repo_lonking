<?php
/**
 * Template Name: Contacto
 *
 * Aplica automáticamente a la página con slug "contacto" (la que
 * enlaza el footer en "Nosotros > Contáctanos"), o selecciónala a mano
 * en Atributos de página > Plantilla.
 *
 * Estructura tomada de la referencia (capturaContacto.png): columna
 * izquierda con título/subtítulo, mapa embebido y tarjetas de
 * sucursales; columna derecha con el formulario centrado. Todo el
 * contenido (excepto el formulario) es editable vía ACF — ver
 * inc/contact-fields.php.
 *
 * Fase actual: maqueta visual. El envío real del formulario se conecta
 * más adelante vía Contact Form 7, según el brief.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hero_titulo    = amex_contact_field( 'hero_titulo', __( 'Más de 35 años optimizando tu productividad operacional', 'amex-machinery' ) );
$hero_subtitulo = amex_contact_field( 'hero_subtitulo', __( 'Desde maquiladoras hasta Centros de Distribución, entendemos los retos únicos de cada industria. Cuéntanos tu desafío para ayudarte a diseñar una solución personalizada.', 'amex-machinery' ) );

$form_titulo    = amex_contact_field( 'form_titulo', __( 'Ponte en contacto con nosotros', 'amex-machinery' ) );
$form_subtitulo = amex_contact_field( 'form_subtitulo', __( 'Platícanos sobre tu operación y retos para poderte ofrecer una asesoría, sin compromiso.', 'amex-machinery' ) );
$form_nota      = amex_contact_field( 'form_nota', __( 'Una vez que completes el formulario, nuestro equipo se comunicará contigo a la brevedad posible para conocer tus necesidades específicas y orientarte en todo el proceso de selección.', 'amex-machinery' ) );

$telefono = amex_contact_field( 'telefono', '614 280 0464' );

// Los teléfonos del sitio son de México (+52); solo se editan los 10 dígitos locales vía ACF.
$telefono_digits = preg_replace( '/[^0-9]/', '', $telefono );
$telefono_href    = '+52' . $telefono_digits;

$sucursales = amex_sucursales();
?>

<section class="contact-page">
	<div class="container contact-page__grid">

		<div class="contact-intro">
			<h1><?php echo esc_html( $hero_titulo ); ?></h1>
			<p><?php echo esc_html( $hero_subtitulo ); ?></p>

			<div class="contact-branches">
				<?php foreach ( $sucursales as $sucursal ) : ?>
					<div class="contact-branch-card">
						<h3><?php echo esc_html( $sucursal['nombre'] ); ?></h3>
						<p>
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 21s-7-6.1-7-11a7 7 0 1 1 14 0c0 4.9-7 11-7 11Z" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/></svg>
							<span><?php echo esc_html( $sucursal['direccion'] ); ?></span>
						</p>
						<?php if ( ! empty( $sucursal['telefono'] ) ) : ?>
							<p>
								<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
								<a href="tel:+52<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $sucursal['telefono'] ) ); ?>"><?php echo esc_html( $sucursal['telefono'] ); ?></a>
							</p>
						<?php endif; ?>
						<?php if ( ! empty( $sucursal['encargado'] ) ) : ?>
							<p>
								<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.5"/><path d="M5 19.5c1.2-3.2 4-5 7-5s5.8 1.8 7 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
								<span><?php echo esc_html( $sucursal['encargado'] ); ?></span>
							</p>
						<?php endif; ?>
						<a href="https://www.google.com/maps/search/?api=1&query=<?php echo rawurlencode( $sucursal['nombre'] . ', ' . $sucursal['direccion'] ); ?>" target="_blank" rel="noopener">
							<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
							<?php esc_html_e( 'Abrir en Google Maps', 'amex-machinery' ); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="contact-form-panel">
			<h2><?php echo esc_html( $form_titulo ); ?></h2>
			<p class="contact-form-panel__subtitle"><?php echo esc_html( $form_subtitulo ); ?></p>

			<?php get_template_part( 'template-parts/quote-form-fields' ); ?>

			<p class="contact-form-panel__call">
				<?php esc_html_e( 'o llámanos', 'amex-machinery' ); ?>
				<a href="tel:<?php echo esc_attr( $telefono_href ); ?>">
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					<?php echo esc_html( $telefono ); ?>
				</a>
			</p>

			<p class="contact-form-panel__note"><?php echo esc_html( $form_nota ); ?></p>
		</div>

	</div>
</section>

<?php get_footer(); ?>

<?php
/**
 * Bloque 3a — Contacto de página de servicio (reusable: venta, renta,
 * etc.). Foto a la izquierda, formulario compartido a la derecha
 * (mismos campos que page-contacto.php vía quote-form-fields.php).
 *
 * $args esperados:
 *   'prefix'   string, prefijo de los campos ACF.
 *   'defaults' array asociativo: contacto_titulo.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prefix   = $args['prefix'];
$defaults = isset( $args['defaults'] ) ? $args['defaults'] : array();

$titulo        = get_field( "{$prefix}_contacto_titulo" ) ?: ( $defaults['contacto_titulo'] ?? __( 'Ponte en contacto con nosotros', 'amex-machinery' ) );
$imagen        = get_field( "{$prefix}_contacto_imagen" );
$telefono      = amex_contact_field( 'telefono', '614 280 0464' );
$telefono_href = '+52' . preg_replace( '/[^0-9]/', '', $telefono );
$form_nota     = amex_contact_field( 'form_nota', '' );
?>
<section class="servicio-contacto">
	<div class="container servicio-contacto__grid">

		<div class="servicio-contacto__intro">
			<h2><?php echo esc_html( $titulo ); ?></h2>

			<?php if ( $imagen ) : ?>
				<div class="servicio-contacto__image">
					<img src="<?php echo esc_url( $imagen['url'] ); ?>" alt="<?php echo esc_attr( $imagen['alt'] ); ?>" loading="lazy">
				</div>
			<?php endif; ?>
		</div>

		<div class="servicio-contacto__form">
			<?php get_template_part( 'template-parts/quote-form-fields' ); ?>

			<p class="contact-form-panel__call">
				<?php esc_html_e( 'o llámanos', 'amex-machinery' ); ?>
				<a href="tel:<?php echo esc_attr( $telefono_href ); ?>">
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					<?php echo esc_html( $telefono ); ?>
				</a>
			</p>

			<?php if ( $form_nota ) : ?>
				<p class="contact-form-panel__note"><?php echo esc_html( $form_nota ); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>

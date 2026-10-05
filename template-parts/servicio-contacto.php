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

			<?php get_template_part( 'template-parts/llamanos' ); ?>

			<?php if ( $form_nota ) : ?>
				<p class="contact-form-panel__note"><?php echo esc_html( $form_nota ); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>

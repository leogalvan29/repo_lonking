<?php
/**
 * "o llámanos" debajo del formulario compartido (page-contacto.php y
 * servicio-contacto.php). Lista los teléfonos del Customizer — ver
 * amex_theme_telefonos().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$telefonos = amex_theme_telefonos();

if ( ! $telefonos ) {
	return;
}
?>
<p class="contact-form-panel__call">
	<?php esc_html_e( 'o llámanos', 'amex-machinery' ); ?>
	<?php foreach ( $telefonos as $tel ) : ?>
		<a href="tel:<?php echo esc_attr( $tel['href'] ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
			<?php if ( count( $telefonos ) > 1 && $tel['label'] ) : ?><small><?php echo esc_html( $tel['label'] ); ?></small><?php endif; ?>
			<?php echo esc_html( $tel['numero'] ); ?>
		</a>
	<?php endforeach; ?>
</p>

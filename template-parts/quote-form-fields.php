<?php
/**
 * Formulario de contacto/cotización reusable (campos + botón).
 *
 * Usado en page-contacto.php y page-venta.php (y cualquier otra página
 * de servicio futura). El wrapper .quote-form-panel/título/nota los
 * decide quien lo llama — esta pieza es solo el <form>.
 *
 * El envío se procesa vía admin-post.php (ver inc/quote-form.php),
 * sin depender de ningún plugin de formularios — envía por wp_mail()
 * al admin_email del sitio.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$quote_status = isset( $_GET['cotizacion'] ) ? sanitize_key( wp_unslash( $_GET['cotizacion'] ) ) : '';
$current_url  = remove_query_arg( 'cotizacion', home_url( add_query_arg( null, null ) ) );
?>
<?php if ( 'ok' === $quote_status ) : ?>
	<p class="quote-form__notice quote-form__notice--success"><?php esc_html_e( '¡Gracias! Recibimos tu solicitud, te contactaremos pronto.', 'amex-machinery' ); ?></p>
<?php elseif ( 'error' === $quote_status ) : ?>
	<p class="quote-form__notice quote-form__notice--error"><?php esc_html_e( 'Hubo un problema al enviar tu solicitud. Intenta de nuevo o contáctanos por WhatsApp/teléfono.', 'amex-machinery' ); ?></p>
<?php endif; ?>
<form class="quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="amex_quote_submit">
	<input type="hidden" name="redirect_to" value="<?php echo esc_url( $current_url ); ?>">
	<?php wp_nonce_field( 'amex_quote_submit', 'amex_quote_nonce' ); ?>

	<div class="quote-form__row">
		<label>
			<?php esc_html_e( 'Nombre', 'amex-machinery' ); ?> *
			<input type="text" name="nombre" required>
		</label>
		<label>
			<?php esc_html_e( 'Apellido', 'amex-machinery' ); ?> *
			<input type="text" name="apellido" required>
		</label>
	</div>

	<div class="quote-form__row">
		<label>
			<?php esc_html_e( 'Email', 'amex-machinery' ); ?> *
			<input type="email" name="email" required>
		</label>
		<label>
			<?php esc_html_e( 'Teléfono', 'amex-machinery' ); ?> *
			<input type="tel" name="telefono" required>
		</label>
	</div>

	<div class="quote-form__row">
		<label>
			<?php esc_html_e( 'Compañía', 'amex-machinery' ); ?> *
			<input type="text" name="compania" required>
		</label>
		<label>
			<?php esc_html_e( 'Estado', 'amex-machinery' ); ?> *
			<select name="estado" required>
				<option value=""><?php esc_html_e( '-- Elige un estado --', 'amex-machinery' ); ?></option>
				<?php foreach ( amex_estados_mx() as $estado ) : ?>
					<option value="<?php echo esc_attr( $estado ); ?>"><?php echo esc_html( $estado ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
	</div>

	<label class="quote-form__full">
		<?php esc_html_e( 'Cuéntanos qué necesitas', 'amex-machinery' ); ?> *
		<textarea name="mensaje" rows="4" required></textarea>
	</label>

	<button type="submit" class="btn btn--primary quote-form__submit">
		<?php esc_html_e( 'Enviar', 'amex-machinery' ); ?>
	</button>
</form>

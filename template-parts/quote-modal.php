<?php
/**
 * Modal de "Solicitar Cotización".
 *
 * Apertura/cierre y precarga del nombre del equipo vía JS
 * (assets/js/product.js). El envío se procesa vía admin-post.php (ver
 * inc/quote-form.php) — sin AJAX: si el envío trae ?cotizacion= en la
 * URL (tras el redirect del handler), el modal se abre ya con el
 * aviso de éxito/error visible.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$estados_mx = amex_estados_mx();

$quote_status = isset( $_GET['cotizacion'] ) ? sanitize_key( wp_unslash( $_GET['cotizacion'] ) ) : '';
$current_url  = remove_query_arg( 'cotizacion', home_url( add_query_arg( null, null ) ) );
?>
<div class="quote-modal<?php echo $quote_status ? ' is-open' : ''; ?>" id="quote-modal" aria-hidden="<?php echo $quote_status ? 'false' : 'true'; ?>">
	<div class="quote-modal__overlay js-close-quote"></div>

	<div class="quote-modal__panel" role="dialog" aria-modal="true" aria-labelledby="quote-modal-title">
		<button type="button" class="quote-modal__close js-close-quote" aria-label="<?php esc_attr_e( 'Cerrar', 'amex-machinery' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
		</button>

		<h3 id="quote-modal-title"><?php esc_html_e( 'Solicitar Cotización', 'amex-machinery' ); ?></h3>
		<p class="quote-modal__equipment" data-quote-equipment-label></p>

		<?php if ( 'ok' === $quote_status ) : ?>
			<p class="quote-form__notice quote-form__notice--success"><?php esc_html_e( '¡Gracias! Recibimos tu solicitud, te contactaremos pronto.', 'amex-machinery' ); ?></p>
		<?php elseif ( 'error' === $quote_status ) : ?>
			<p class="quote-form__notice quote-form__notice--error"><?php esc_html_e( 'Hubo un problema al enviar tu solicitud. Intenta de nuevo o contáctanos por WhatsApp/teléfono.', 'amex-machinery' ); ?></p>
		<?php endif; ?>

		<form class="quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="amex_quote_submit">
			<input type="hidden" name="redirect_to" value="<?php echo esc_url( $current_url ); ?>">
			<?php wp_nonce_field( 'amex_quote_submit', 'amex_quote_nonce' ); ?>
			<input type="hidden" name="equipo" value="" data-quote-equipment-field>

			<div class="quote-form__row">
				<label>
					<?php esc_html_e( 'Nombre', 'amex-machinery' ); ?>
					<input type="text" name="nombre" required>
				</label>
				<label>
					<?php esc_html_e( 'Apellido', 'amex-machinery' ); ?>
					<input type="text" name="apellido" required>
				</label>
			</div>

			<div class="quote-form__row">
				<label>
					<?php esc_html_e( 'Email', 'amex-machinery' ); ?>
					<input type="email" name="email" required>
				</label>
				<label>
					<?php esc_html_e( 'Teléfono', 'amex-machinery' ); ?>
					<input type="tel" name="telefono" required>
				</label>
			</div>

			<div class="quote-form__row">
				<label>
					<?php esc_html_e( 'Compañía', 'amex-machinery' ); ?>
					<input type="text" name="compania">
				</label>
				<label>
					<?php esc_html_e( 'Estado', 'amex-machinery' ); ?>
					<select name="estado" required>
						<option value=""><?php esc_html_e( 'Selecciona un estado', 'amex-machinery' ); ?></option>
						<?php foreach ( $estados_mx as $estado ) : ?>
							<option value="<?php echo esc_attr( $estado ); ?>"><?php echo esc_html( $estado ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</div>

			<label class="quote-form__full">
				<?php esc_html_e( 'Mensaje', 'amex-machinery' ); ?>
				<textarea name="mensaje" rows="4"></textarea>
			</label>

			<button type="submit" class="btn btn--primary quote-form__submit">
				<?php esc_html_e( 'Enviar solicitud', 'amex-machinery' ); ?>
			</button>
		</form>
	</div>
</div>

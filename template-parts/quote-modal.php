<?php
/**
 * Modal de "Solicitar Cotización".
 *
 * Fase actual: maqueta visual + comportamiento de apertura/cierre y
 * precarga del nombre del equipo (JS). El envío real (Contact Form 7 +
 * notificación por email) se conecta en una fase posterior — ver brief.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$estados_mx = amex_estados_mx();
?>
<div class="quote-modal" id="quote-modal" aria-hidden="true">
	<div class="quote-modal__overlay js-close-quote"></div>

	<div class="quote-modal__panel" role="dialog" aria-modal="true" aria-labelledby="quote-modal-title">
		<button type="button" class="quote-modal__close js-close-quote" aria-label="<?php esc_attr_e( 'Cerrar', 'amex-machinery' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
		</button>

		<h3 id="quote-modal-title"><?php esc_html_e( 'Solicitar Cotización', 'amex-machinery' ); ?></h3>
		<p class="quote-modal__equipment" data-quote-equipment-label></p>

		<form class="quote-form" method="post" action="">
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

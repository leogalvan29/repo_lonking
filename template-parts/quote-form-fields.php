<?php
/**
 * Formulario de contacto/cotización reusable (campos + botón).
 *
 * Usado en page-contacto.php y page-venta.php (y cualquier otra página
 * de servicio futura). El wrapper .quote-form-panel/título/nota los
 * decide quien lo llama — esta pieza es solo el <form>.
 *
 * Fase actual: maqueta visual, sin envío real (ver brief — Contact
 * Form 7 se conecta en una fase posterior).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="quote-form" method="post" action="">
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

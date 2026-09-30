<?php
/**
 * Maneja el envío del formulario de cotización/contacto reusable
 * (template-parts/quote-form-fields.php y template-parts/quote-modal.php)
 * vía admin-post.php — sin depender de ningún plugin de formularios.
 *
 * El correo destino es el admin_email del sitio (Ajustes > Generales).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function amex_handle_quote_submit() {
	$redirect_to = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : home_url( '/' );
	$redirect_to = remove_query_arg( 'cotizacion', $redirect_to );

	if ( ! isset( $_POST['amex_quote_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['amex_quote_nonce'] ), 'amex_quote_submit' ) ) {
		wp_safe_redirect( add_query_arg( 'cotizacion', 'error', $redirect_to ) );
		exit;
	}

	$nombre   = sanitize_text_field( wp_unslash( $_POST['nombre'] ?? '' ) );
	$apellido = sanitize_text_field( wp_unslash( $_POST['apellido'] ?? '' ) );
	$email    = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$telefono = sanitize_text_field( wp_unslash( $_POST['telefono'] ?? '' ) );
	$compania = sanitize_text_field( wp_unslash( $_POST['compania'] ?? '' ) );
	$estado   = sanitize_text_field( wp_unslash( $_POST['estado'] ?? '' ) );
	$mensaje  = sanitize_textarea_field( wp_unslash( $_POST['mensaje'] ?? '' ) );
	$equipo   = sanitize_text_field( wp_unslash( $_POST['equipo'] ?? '' ) );

	if ( ! $nombre || ! $apellido || ! is_email( $email ) || ! $telefono ) {
		wp_safe_redirect( add_query_arg( 'cotizacion', 'error', $redirect_to ) );
		exit;
	}

	$subject = $equipo
		? sprintf( __( 'Nueva solicitud de cotización: %s', 'amex-machinery' ), $equipo )
		: __( 'Nueva solicitud de contacto', 'amex-machinery' );

	$body = array(
		sprintf( __( 'Nombre: %s %s', 'amex-machinery' ), $nombre, $apellido ),
		sprintf( __( 'Email: %s', 'amex-machinery' ), $email ),
		sprintf( __( 'Teléfono: %s', 'amex-machinery' ), $telefono ),
	);

	if ( $compania ) {
		$body[] = sprintf( __( 'Compañía: %s', 'amex-machinery' ), $compania );
	}
	if ( $estado ) {
		$body[] = sprintf( __( 'Estado: %s', 'amex-machinery' ), $estado );
	}
	if ( $equipo ) {
		$body[] = sprintf( __( 'Equipo de interés: %s', 'amex-machinery' ), $equipo );
	}
	if ( $mensaje ) {
		$body[] = "\n" . __( 'Mensaje:', 'amex-machinery' ) . "\n" . $mensaje;
	}

	$headers = array( 'Reply-To: ' . $nombre . ' ' . $apellido . ' <' . $email . '>' );

	$sent = wp_mail( get_option( 'admin_email' ), $subject, implode( "\n", $body ), $headers );

	wp_safe_redirect( add_query_arg( 'cotizacion', $sent ? 'ok' : 'error', $redirect_to ) );
	exit;
}
add_action( 'admin_post_amex_quote_submit', 'amex_handle_quote_submit' );
add_action( 'admin_post_nopriv_amex_quote_submit', 'amex_handle_quote_submit' );

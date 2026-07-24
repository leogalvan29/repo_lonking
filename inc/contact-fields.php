<?php
/**
 * Fuente de verdad para el contenido editable de contacto (hero,
 * teléfono, redes, sucursales), leído vía ACF desde la página
 * "Contacto". ACF free no tiene Options Page, así que esta página hace
 * ese papel para el footer y para page-contacto.php — evita tener el
 * mismo dato hardcodeado en dos lugares.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ID de la página con slug "contacto", o 0 si todavía no existe.
 */
function amex_contacto_page_id() {
	static $page_id = null;

	if ( null === $page_id ) {
		$page    = get_page_by_path( 'contacto' );
		$page_id = $page ? $page->ID : 0;
	}

	return $page_id;
}

/**
 * Lee un campo ACF de la página "Contacto", con fallback si la página
 * o el campo todavía no existen.
 */
function amex_contact_field( $selector, $default = '' ) {
	$page_id = amex_contacto_page_id();

	if ( ! $page_id ) {
		return $default;
	}

	return amex_get_field( $selector, $page_id, $default );
}

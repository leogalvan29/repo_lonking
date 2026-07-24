<?php
/**
 * AMEX Machinery — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AMEX_THEME_VERSION', '0.1.0' );
define( 'AMEX_THEME_DIR', get_template_directory() );
define( 'AMEX_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function amex_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// WooCommerce (catálogo únicamente, ver amex_woocommerce_setup()).
	add_theme_support( 'woocommerce' );

	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'amex-machinery' ),
			'footer-catalogo' => __( 'Footer — Catálogo', 'amex-machinery' ),
			'footer-marcas'   => __( 'Footer — Marcas', 'amex-machinery' ),
			'footer-servicios' => __( 'Footer — Servicios', 'amex-machinery' ),
		)
	);
}
add_action( 'after_setup_theme', 'amex_theme_setup' );

/**
 * Versión de cache-busting basada en la fecha de modificación del
 * archivo, para no depender de subir AMEX_THEME_VERSION a mano en cada
 * cambio de CSS/JS (evita que el navegador sirva versiones viejas).
 */
function amex_asset_version( $relative_path ) {
	$file = AMEX_THEME_DIR . $relative_path;

	return file_exists( $file ) ? filemtime( $file ) : AMEX_THEME_VERSION;
}

/**
 * Assets.
 */
function amex_enqueue_assets() {
	wp_enqueue_style(
		'amex-google-fonts',
		'https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'amex-style',
		AMEX_THEME_URI . '/assets/css/style.css',
		array(),
		amex_asset_version( '/assets/css/style.css' )
	);

	wp_enqueue_script(
		'amex-main',
		AMEX_THEME_URI . '/assets/js/main.js',
		array(),
		amex_asset_version( '/assets/js/main.js' ),
		true
	);

	$is_home_template = is_page_template( 'page-home.php' );

	// product.css trae .product-card, reusada tanto en WooCommerce como
	// en el carrusel de Equipos Destacados del home.
	if ( ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) || $is_home_template ) {
		wp_enqueue_style(
			'amex-product',
			AMEX_THEME_URI . '/assets/css/product.css',
			array( 'amex-style' ),
			amex_asset_version( '/assets/css/product.css' )
		);

		wp_enqueue_script(
			'amex-product',
			AMEX_THEME_URI . '/assets/js/product.js',
			array(),
			amex_asset_version( '/assets/js/product.js' ),
			true
		);
	}

	if ( is_page( 'contacto' ) ) {
		wp_enqueue_style(
			'amex-contact',
			AMEX_THEME_URI . '/assets/css/contact.css',
			array( 'amex-style' ),
			amex_asset_version( '/assets/css/contact.css' )
		);
	}

	if ( $is_home_template ) {
		wp_enqueue_style(
			'amex-home',
			AMEX_THEME_URI . '/assets/css/home.css',
			array( 'amex-style', 'amex-product' ),
			amex_asset_version( '/assets/css/home.css' )
		);
	}

	// CSS de página de servicio (.servicio-*): compartido por venta,
	// renta y cualquier página de servicio futura (mismos template-parts
	// genéricos, ver template-parts/servicio-*.php).
	if ( is_page_template( array_keys( amex_service_page_templates() ) ) ) {
		wp_enqueue_style(
			'amex-servicio',
			AMEX_THEME_URI . '/assets/css/servicio.css',
			array( 'amex-style' ),
			amex_asset_version( '/assets/css/servicio.css' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'amex_enqueue_assets' );

/**
 * Helper: lee un campo ACF de forma segura. Si el plugin ACF todavía no
 * está instalado/activo, devuelve $default en vez de un fatal error por
 * función inexistente — útil mientras se termina de configurar el stack.
 */
function amex_get_field( $selector, $post_id = false, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $selector, $post_id );

	return ( null === $value || false === $value || '' === $value ) ? $default : $value;
}

/**
 * Teléfono del sitio (header/footer/WhatsApp) — vive en el Customizer
 * (Apariencia > Personalizar > Información de Contacto), no en ACF.
 */
function amex_theme_telefono() {
	return get_theme_mod( 'site_telefono', '614 280 0464' );
}

/**
 * Mismo teléfono, listo para usarse en un href="tel:..." (+52 y solo
 * dígitos).
 */
function amex_theme_telefono_href() {
	return '+52' . preg_replace( '/[^0-9]/', '', amex_theme_telefono() );
}

/**
 * Mismo teléfono, listo para usarse en un link https://wa.me/... (52 y
 * solo dígitos, sin el "+").
 */
function amex_theme_telefono_whatsapp() {
	return '52' . preg_replace( '/[^0-9]/', '', amex_theme_telefono() );
}

/**
 * Lista de estados de México, usada en el select de cualquier
 * formulario de contacto/cotización del sitio.
 */
function amex_estados_mx() {
	return array(
		'Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche', 'Chiapas', 'Chihuahua',
		'Ciudad de México', 'Coahuila', 'Colima', 'Durango', 'Estado de México', 'Guanajuato', 'Guerrero',
		'Hidalgo', 'Jalisco', 'Michoacán', 'Morelos', 'Nayarit', 'Nuevo León', 'Oaxaca', 'Puebla', 'Querétaro',
		'Quintana Roo', 'San Luis Potosí', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala', 'Veracruz',
		'Yucatán', 'Zacatecas',
	);
}

/**
 * Sucursales AMEX, usadas en el footer y en la página de contacto.
 * Editable vía ACF en la página "Contacto" (sucursal_1_nombre,
 * sucursal_1_direccion, ... sucursal_14_*) — 14 en total. Las que no
 * tengan nombre capturado todavía se omiten (no se muestran vacías).
 */
function amex_sucursales() {
	$defaults = array(
		1  => array(
			'nombre'    => 'AMEX Culiacán Matriz',
			'direccion' => 'Blvd. Emiliano Zapata 4701, Fraccionamiento Villa Serena, 80159 Culiacán Rosales, Sin.',
			'telefono'  => '667 502 7907',
			'encargado' => 'Carlos Baltazar Castro',
		),
		2  => array(
			'nombre'    => 'AMEX La Barca',
			'direccion' => 'Lázaro Cárdenas #131 B, Col. Centro, 47910 La Barca, Jal.',
			'telefono'  => '393 158 0062',
			'encargado' => 'Luis Antonio Cabrera Amezcua',
		),
		3  => array(
			'nombre'    => 'AMEX Mérida Caucel',
			'direccion' => 'Tab Cat 45084 45085, Bod. Inmobiliaria RBR Caucel, 97314 Mérida, Yuc.',
			'telefono'  => '999 649 8838',
			'encargado' => 'Ivan Galindo Fabian',
		),
		4  => array(
			'nombre'    => 'AMEX Mérida Centralia',
			'direccion' => 'Centralia Mérida, Km 47 Periférico Lic. Manuel Berzunza, Local 115, Col. Paseos de Tixcacal, 97314 Mérida, Yuc.',
			'telefono'  => '999 649 8838',
			'encargado' => 'Ivan Galindo Fabian',
		),
		5  => array(
			'nombre'    => 'AMEX Puebla',
			'direccion' => 'Galeana No. 59, San Lorenzo Amecatla, 72710 Puebla, Pue.',
			'telefono'  => '221 533 9788',
			'encargado' => 'Adrian Lopez Parra',
		),
		6  => array(
			'nombre'    => 'AMEX Querétaro',
			'direccion' => 'Carretera Estatal 200, Km 16+079, Col. San Isidro, Interior 93, El Marqués, 76249 Querétaro, Qro.',
			'telefono'  => '442 503 9909',
			'encargado' => 'Brandon Omar Rojas Melendez',
		),
		7  => array(
			'nombre'    => 'AMEX Tijuana',
			'direccion' => 'Blvd. Cucapah #21847, entre Las Torres y Bugambilias, Col. Villa Fontana, Lomas del Matamoros, 22206 Tijuana, B.C.',
			'telefono'  => '663 322 4186',
			'encargado' => 'Maria Cecilia Castro',
		),
		8  => array(
			'nombre'    => 'AMEX La Paz',
			'direccion' => 'Carretera Transpeninsular al Sur Km 8, Col. Tabachines, 23084 La Paz, B.C.S.',
			'telefono'  => '612 104 2639',
			'encargado' => 'Luis Alberto Bañuelos Miramontes',
		),
		9  => array(
			'nombre'    => 'AMEX León Guanajuato',
			'direccion' => 'Omicrón 301, Industrial Delta, 37549 León de los Aldama, Gto.',
			'telefono'  => '442 503 9909',
			'encargado' => 'Brandon Omar Rojas Melendez',
		),
		10 => array(
			'nombre'    => 'AMEX Monterrey',
			'direccion' => 'Blvd. José López Portillo 333, Bodega 107, Col. Valles del Canadá, Gral. Escobedo, N.L., C.P. 66220',
			'telefono'  => '81 8287 9123',
			'encargado' => 'Marcos Reynaldo Ruiz Perez',
		),
		11 => array(
			'nombre'    => 'AMEX Guaymas',
			'direccion' => '99B California y Luis Encinas Km 1982, Carr. Internacional, Petrolera, 85456 Guaymas, Son.',
			'telefono'  => '622 103 7441',
			'encargado' => 'Gerardo Garcia Valenzuela',
		),
		12 => array(
			'nombre'    => 'AMEX Hermosillo',
			'direccion' => 'Av. Sahuaripa 27, Col. Central de Abastos, 83283 Hermosillo, Son.',
			'telefono'  => '',
			'encargado' => '',
		),
		13 => array(
			'nombre'    => 'AMEX Los Mochis',
			'direccion' => '21 de Marzo 569 Pte. B-2, Jiquilpan, Los Mochis, Sin.',
			'telefono'  => '',
			'encargado' => '',
		),
		14 => array(
			'nombre'    => 'AMEX Torreón',
			'direccion' => 'Antigua Carretera Torreón - San Pedro No. 150, Loc. Ejido Ana, C.P. 27070',
			'telefono'  => '81 8287 8985',
			'encargado' => 'Pablo Canales Hernandez',
		),
	);

	$sucursales = array();

	for ( $n = 1; $n <= 14; $n++ ) {
		$default = $defaults[ $n ] ?? array(
			'nombre'    => '',
			'direccion' => '',
			'telefono'  => '',
			'encargado' => '',
		);

		$nombre = amex_contact_field( "sucursal_{$n}_nombre", $default['nombre'] );

		if ( ! $nombre ) {
			continue;
		}

		$sucursales[] = array(
			'nombre'    => $nombre,
			'direccion' => amex_contact_field( "sucursal_{$n}_direccion", $default['direccion'] ),
			'telefono'  => amex_contact_field( "sucursal_{$n}_telefono", $default['telefono'] ),
			'encargado' => amex_contact_field( "sucursal_{$n}_encargado", $default['encargado'] ),
		);
	}

	return $sucursales;
}

require AMEX_THEME_DIR . '/inc/contact-fields.php';
require AMEX_THEME_DIR . '/inc/woocommerce.php';
require AMEX_THEME_DIR . '/inc/catalog-filters.php';

/**
 * Plantillas de página de servicio conocidas (venta, renta, y las que
 * se vayan agregando — refacciones, mantenimiento, capacitación...).
 * Usada por amex_get_service_pages() para el footer "Servicios".
 */
function amex_service_page_templates() {
	return array(
		'page-venta.php'         => __( 'Venta de Montacargas', 'amex-machinery' ),
		'page-renta.php'         => __( 'Renta de Montacargas', 'amex-machinery' ),
		'page-mantenimiento.php' => __( 'Servicio Técnico y Mantenimiento', 'amex-machinery' ),
		'page-capacitacion.php'  => __( 'Capacitación y Seguridad', 'amex-machinery' ),
	);
}

/**
 * Páginas de servicio realmente publicadas (independiente de qué slug
 * les hayan puesto), para generar el footer "Servicios" sin mantener
 * una lista aparte a mano.
 */
function amex_get_service_pages() {
	$templates = array_keys( amex_service_page_templates() );

	$query = new WP_Query(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'     => '_wp_page_template',
					'value'   => $templates,
					'compare' => 'IN',
				),
			),
		)
	);

	$pages = array();
	foreach ( $query->posts as $post ) {
		$pages[] = array(
			'titulo' => get_the_title( $post ),
			'url'    => get_permalink( $post ),
		);
	}

	return $pages;
}

/**
 * Imprime un menú de footer si está configurado en Apariencia > Menús
 * para esa ubicación; si no, devuelve false para que el llamador use
 * su propio fallback.
 */
function amex_footer_nav( $location ) {
	if ( ! has_nav_menu( $location ) ) {
		return false;
	}

	wp_nav_menu(
		array(
			'theme_location' => $location,
			'container'      => false,
			'items_wrap'     => '<ul>%3$s</ul>',
		)
	);

	return true;
}

/**
 * Helper: imprime el menú principal usando wp_nav_menu si el usuario ya
 * lo configuró en Apariencia > Menús, o un fallback estático que
 * reproduce la estructura del sitio de referencia (Equipos nuevos /
 * Marcas / Servicios / Equipos usados) mientras tanto.
 */
function amex_primary_nav( $mobile = false ) {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '<ul>%3$s</ul>',
				'walker'         => new Amex_Nav_Walker( $mobile ),
			)
		);
		return;
	}

	amex_render_fallback_nav( $mobile );
}

require AMEX_THEME_DIR . '/inc/class-amex-nav-walker.php';
require AMEX_THEME_DIR . '/inc/nav-fallback.php';
require AMEX_THEME_DIR . '/inc/customizer.php';

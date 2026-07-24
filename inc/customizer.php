<?php
/**
 * Customizer — Header
 *
 * Expone en Apariencia > Personalizar > Header los controles de logo
 * y colores (fondo, texto, acento, submenús) usando la API nativa del
 * Customizer. No depende de ACF.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function amex_header_customizer_defaults() {
	return array(
		'header_bg_color'           => '#fefefe',
		'header_text_color'         => '#121212',
		'header_accent_color'       => '#f4cd45',
		'header_submenu_bg_color'   => '#fefefe',
		'header_submenu_text_color' => '#555555',
	);
}

/**
 * Título del producto (H1 en single-product.php) y título de la sección
 * de Detalles (donde vive el campo ACF imagen_detalle del producto).
 */
function amex_product_typography_defaults() {
	return array(
		'product_title_color'         => '#121212',
		'product_title_size'          => 36,
		'product_details_title_color' => '#121212',
		'product_details_title_size'  => 30,
	);
}

function amex_customize_register( $wp_customize ) {
	$defaults = amex_header_customizer_defaults();

	$wp_customize->add_section(
		'amex_header_design',
		array(
			'title'       => __( 'Header — Diseño', 'amex-machinery' ),
			'description' => __( 'Logo, fondo, texto y colores del menú (incluyendo submenús).', 'amex-machinery' ),
			'priority'    => 30,
		)
	);

	$color_fields = array(
		'header_bg_color'           => __( 'Color de fondo del header', 'amex-machinery' ),
		'header_text_color'         => __( 'Color de texto del header', 'amex-machinery' ),
		'header_accent_color'       => __( 'Color de acento (hover / activo)', 'amex-machinery' ),
		'header_submenu_bg_color'   => __( 'Fondo de submenús', 'amex-machinery' ),
		'header_submenu_text_color' => __( 'Texto de submenús', 'amex-machinery' ),
	);

	foreach ( $color_fields as $setting_id => $label ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $defaults[ $setting_id ],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'   => $label,
					'section' => 'amex_header_design',
				)
			)
		);
	}

	/**
	 * Sección: Producto — Título.
	 */
	$type_defaults = amex_product_typography_defaults();

	$wp_customize->add_section(
		'amex_product_typography',
		array(
			'title'       => __( 'Producto — Título', 'amex-machinery' ),
			'description' => __( 'Color y tamaño del título del producto y del título de la sección de Detalles (donde va la imagen institucional).', 'amex-machinery' ),
			'priority'    => 31,
		)
	);

	$wp_customize->add_setting(
		'product_title_color',
		array(
			'default'           => $type_defaults['product_title_color'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'product_title_color',
			array(
				'label'   => __( 'Color del título del producto', 'amex-machinery' ),
				'section' => 'amex_product_typography',
			)
		)
	);

	$wp_customize->add_setting(
		'product_title_size',
		array(
			'default'           => $type_defaults['product_title_size'],
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'product_title_size',
		array(
			'type'        => 'range',
			'section'     => 'amex_product_typography',
			'label'       => __( 'Tamaño del título del producto (px)', 'amex-machinery' ),
			'input_attrs' => array( 'min' => 20, 'max' => 64, 'step' => 1 ),
		)
	);

	$wp_customize->add_setting(
		'product_details_title_color',
		array(
			'default'           => $type_defaults['product_details_title_color'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'product_details_title_color',
			array(
				'label'   => __( 'Color del título de la sección Detalles', 'amex-machinery' ),
				'section' => 'amex_product_typography',
			)
		)
	);

	$wp_customize->add_setting(
		'product_details_title_size',
		array(
			'default'           => $type_defaults['product_details_title_size'],
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'product_details_title_size',
		array(
			'type'        => 'range',
			'section'     => 'amex_product_typography',
			'label'       => __( 'Tamaño del título de la sección Detalles (px)', 'amex-machinery' ),
			'input_attrs' => array( 'min' => 18, 'max' => 56, 'step' => 1 ),
		)
	);
}
add_action( 'customize_register', 'amex_customize_register' );

/**
 * Imprime las variables CSS del header en el <head>, después de la
 * hoja de estilos principal para que el override tenga prioridad.
 */
function amex_header_customizer_css() {
	$defaults = amex_header_customizer_defaults();
	$values   = array();

	foreach ( $defaults as $setting_id => $default ) {
		$values[ $setting_id ] = get_theme_mod( $setting_id, $default );
	}

	$type_defaults = amex_product_typography_defaults();
	$type_values   = array();

	foreach ( $type_defaults as $setting_id => $default ) {
		$type_values[ $setting_id ] = get_theme_mod( $setting_id, $default );
	}
	?>
	<style id="amex-header-customizer-css">
		:root {
			--header-bg: <?php echo esc_html( $values['header_bg_color'] ); ?>;
			--header-text: <?php echo esc_html( $values['header_text_color'] ); ?>;
			--header-accent: <?php echo esc_html( $values['header_accent_color'] ); ?>;
			--header-submenu-bg: <?php echo esc_html( $values['header_submenu_bg_color'] ); ?>;
			--header-submenu-text: <?php echo esc_html( $values['header_submenu_text_color'] ); ?>;
			--product-title-color: <?php echo esc_html( $type_values['product_title_color'] ); ?>;
			--product-title-size: <?php echo absint( $type_values['product_title_size'] ); ?>px;
			--product-details-title-color: <?php echo esc_html( $type_values['product_details_title_color'] ); ?>;
			--product-details-title-size: <?php echo absint( $type_values['product_details_title_size'] ); ?>px;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'amex_header_customizer_css', 20 );

/**
 * JS de previsualización en vivo dentro del Customizer.
 */
function amex_customize_preview_js() {
	wp_enqueue_script(
		'amex-customizer-preview',
		AMEX_THEME_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		amex_asset_version( '/assets/js/customizer-preview.js' ),
		true
	);
}
add_action( 'customize_preview_init', 'amex_customize_preview_js' );

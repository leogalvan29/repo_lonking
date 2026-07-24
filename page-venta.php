<?php
/**
 * Template Name: Venta
 *
 * Página de servicio "Venta de Montacargas". Usa los template-parts
 * genéricos de página de servicio (servicio-hero, servicio-detalle,
 * servicio-contacto, servicio-faq — reusados también por page-renta.php
 * y cualquier página de servicio futura), pasando 'prefix' => 'venta'
 * para que lean sus propios campos ACF (acf-json/group_pagina_venta.json)
 * y 'defaults' con la copia de la referencia (ventaMontacargas1/2/3.png)
 * por si el campo todavía no se ha llenado.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$defaults = array(
	'hero_titulo'           => __( 'Venta de Montacargas', 'amex-machinery' ),
	'hero_subtitulo'        => __( 'Tu socio estratégico en soluciones de manejo de materiales', 'amex-machinery' ),
	'hero_texto_1'          => __( 'En Amex Machinery ofrecemos un portafolio completo de montacargas, plataformas elevadoras y soluciones de almacén de las marcas líderes a nivel mundial. Nuestro compromiso es brindarte equipos certificados, confiables y eficientes que mantengan tu operación sin interrupciones.', 'amex-machinery' ),
	'hero_texto_2'          => __( 'Ya sea que busques un montacargas para aplicaciones ligeras, un equipo especializado para pasillo angosto, o una plataforma de elevación para construcción e industria, contamos con la solución ideal para cada necesidad.', 'amex-machinery' ),
	'servicio_titulo'       => __( 'Nuestro servicio de Venta de Montacargas incluye:', 'amex-machinery' ),
	'feature_1_titulo'      => __( 'Amplia gama de equipos nuevos y seminuevos certificados', 'amex-machinery' ),
	'feature_1_desc'        => __( 'Montacargas eléctricos, de combustión, multidireccionales, montados en camión, plataformas de elevación, equipos de almacén y más. Todos pasan rigurosos procesos de inspección para garantizar su óptimo funcionamiento.', 'amex-machinery' ),
	'feature_2_titulo'      => __( 'Asesoría personalizada:', 'amex-machinery' ),
	'feature_2_desc'        => __( 'Te ayudamos a elegir el equipo adecuado según tu industria, capacidad de carga requerida, nivel de operación y presupuesto. Nuestros especialistas conocen las normas de seguridad aplicables a cada sector.', 'amex-machinery' ),
	'feature_3_titulo'      => __( 'Planes financieros flexibles', 'amex-machinery' ),
	'feature_3_desc'        => __( 'Opciones de compra directa, crédito y arrendamiento para optimizar tu inversión en cualquier tipo de equipo, desde montacargas hasta plataformas especializadas.', 'amex-machinery' ),
	'feature_4_titulo'      => __( 'Garantía Amex 360', 'amex-machinery' ),
	'feature_4_desc'        => __( 'Respaldo completo con refacciones originales, servicio técnico especializado en sistema hidráulico y programas de mantenimiento preventivo para maximizar la vida útil de tu equipo.', 'amex-machinery' ),
	'feature_5_titulo'      => __( 'Disponibilidad inmediata', 'amex-machinery' ),
	'feature_5_desc'        => __( 'Inventario estratégico de equipos listos para entrega en México, incluyendo toda nuestra gama de montacargas y equipos especializados.', 'amex-machinery' ),
	'beneficio_1'           => __( 'Reducción de costos operativos con equipos de alta eficiencia energética que cumplen con todas las normativas vigentes.', 'amex-machinery' ),
	'beneficio_2'           => __( 'Mayor seguridad y productividad en tu operación gracias a equipos de punta y mantenimiento preventivo programado.', 'amex-machinery' ),
	'beneficio_3'           => __( 'Equipos de marcas líderes con presencia global y soporte local, respaldados con refacciones originales siempre disponibles.', 'amex-machinery' ),
	'beneficio_4'           => __( 'Un solo proveedor confiable para venta, renta, refacciones y servicio con atención personalizada en cada etapa.', 'amex-machinery' ),
	'contacto_titulo'       => __( 'Ponte en contacto con nosotros', 'amex-machinery' ),
	'faq_1_pregunta'        => __( '¿Qué diferencia hay entre un montacargas nuevo y uno remanufacturado?', 'amex-machinery' ),
	'faq_2_pregunta'        => __( '¿Qué marcas de montacargas manejan y cuál recomiendan?', 'amex-machinery' ),
	'faq_3_pregunta'        => __( '¿Ofrecen servicio y refacciones en toda la República?', 'amex-machinery' ),
	'faq_4_pregunta'        => __( '¿Qué incluye la capacitación de operadores?', 'amex-machinery' ),
	'faq_5_pregunta'        => __( '¿Qué opciones de financiamiento ofrecen?', 'amex-machinery' ),
	'faq_6_pregunta'        => __( '¿Manejan equipos especializados además de montacargas?', 'amex-machinery' ),
);
?>

<?php get_template_part( 'template-parts/servicio-hero', null, array( 'prefix' => 'venta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-detalle', null, array( 'prefix' => 'venta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-contacto', null, array( 'prefix' => 'venta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-faq', null, array( 'prefix' => 'venta', 'defaults' => $defaults ) ); ?>

<?php get_footer(); ?>

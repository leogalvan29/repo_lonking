<?php
/**
 * Template Name: Mantenimiento
 *
 * Página de servicio "Servicio Técnico y Mantenimiento". Misma
 * estructura que page-venta.php/page-renta.php (mismos template-parts
 * genéricos de servicio), con 'prefix' => 'mantenimiento' para leer sus
 * propios campos ACF (acf-json/group_pagina_mantenimiento.json).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$defaults = array(
	'hero_titulo'      => __( 'Servicio Técnico y Mantenimiento', 'amex-machinery' ),
	'hero_subtitulo'   => __( 'Tu equipo siempre disponible, tu operación sin pausas', 'amex-machinery' ),
	'hero_texto_1'     => __( 'En Amex Machinery contamos con técnicos certificados y refacciones originales para mantener tu flota de montacargas y equipos especializados funcionando de forma segura y eficiente.', 'amex-machinery' ),
	'hero_texto_2'     => __( 'Ofrecemos mantenimiento preventivo programado y servicio correctivo rápido, minimizando el tiempo de inactividad de tu operación.', 'amex-machinery' ),
	'servicio_titulo'  => __( 'Nuestro servicio de Mantenimiento incluye:', 'amex-machinery' ),
	'feature_1_titulo' => __( 'Mantenimiento preventivo programado', 'amex-machinery' ),
	'feature_1_desc'   => __( 'Revisiones periódicas planeadas para detectar y corregir fallas antes de que afecten tu operación.', 'amex-machinery' ),
	'feature_2_titulo' => __( 'Servicio correctivo especializado', 'amex-machinery' ),
	'feature_2_desc'   => __( 'Diagnóstico y reparación rápida ante cualquier falla, con técnicos capacitados en las principales marcas del mercado.', 'amex-machinery' ),
	'feature_3_titulo' => __( 'Técnicos certificados', 'amex-machinery' ),
	'feature_3_desc'   => __( 'Personal capacitado directamente por los fabricantes, con conocimiento profundo de sistemas hidráulicos, eléctricos y de combustión.', 'amex-machinery' ),
	'feature_4_titulo' => __( 'Refacciones originales', 'amex-machinery' ),
	'feature_4_desc'   => __( 'Stock permanente de refacciones originales para minimizar tiempos de espera en cada servicio.', 'amex-machinery' ),
	'feature_5_titulo' => __( 'Cobertura en toda la República', 'amex-machinery' ),
	'feature_5_desc'   => __( 'Atención técnica en cualquiera de nuestras sucursales o directamente en las instalaciones de tu empresa.', 'amex-machinery' ),
	'beneficio_1'      => __( 'Reduces el tiempo de inactividad no planeado de tu flota.', 'amex-machinery' ),
	'beneficio_2'      => __( 'Alargas la vida útil de tus equipos con mantenimiento adecuado.', 'amex-machinery' ),
	'beneficio_3'      => __( 'Bajas tus costos operativos a largo plazo al evitar fallas mayores.', 'amex-machinery' ),
	'beneficio_4'      => __( 'Tienes un solo proveedor confiable para todo el mantenimiento de tu flota.', 'amex-machinery' ),
	'contacto_titulo'  => __( 'Ponte en contacto con nosotros', 'amex-machinery' ),
	'faq_1_pregunta'   => __( '¿Cada cuánto se recomienda el mantenimiento preventivo?', 'amex-machinery' ),
	'faq_2_pregunta'   => __( '¿Atienden todas las marcas de montacargas?', 'amex-machinery' ),
	'faq_3_pregunta'   => __( '¿Ofrecen contratos de mantenimiento anual?', 'amex-machinery' ),
	'faq_4_pregunta'   => __( '¿Cuánto tiempo tarda una visita de servicio?', 'amex-machinery' ),
	'faq_5_pregunta'   => __( '¿Manejan refacciones originales?', 'amex-machinery' ),
	'faq_6_pregunta'   => __( '¿Tienen cobertura en mi ciudad?', 'amex-machinery' ),
);
?>

<?php get_template_part( 'template-parts/servicio-hero', null, array( 'prefix' => 'mantenimiento', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-detalle', null, array( 'prefix' => 'mantenimiento', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-contacto', null, array( 'prefix' => 'mantenimiento', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-faq', null, array( 'prefix' => 'mantenimiento', 'defaults' => $defaults ) ); ?>

<?php get_footer(); ?>

<?php
/**
 * Template Name: Capacitacion
 *
 * Página de servicio "Capacitación y Seguridad". Misma estructura que
 * page-venta.php/page-renta.php (mismos template-parts genéricos de
 * servicio), con 'prefix' => 'capacitacion' para leer sus propios
 * campos ACF (acf-json/group_pagina_capacitacion.json).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$defaults = array(
	'hero_titulo'      => __( 'Capacitación y Seguridad', 'amex-machinery' ),
	'hero_subtitulo'   => __( 'Operadores capacitados, operaciones más seguras', 'amex-machinery' ),
	'hero_texto_1'     => __( 'En Amex Machinery capacitamos a tus operadores para el manejo seguro y eficiente de montacargas y equipos especializados, cumpliendo con las normativas de seguridad vigentes.', 'amex-machinery' ),
	'hero_texto_2'     => __( 'Reduce accidentes, protege a tu personal y mejora la productividad de tu operación con operadores certificados.', 'amex-machinery' ),
	'servicio_titulo'  => __( 'Nuestro servicio de Capacitación y Seguridad incluye:', 'amex-machinery' ),
	'feature_1_titulo' => __( 'Certificación de operadores', 'amex-machinery' ),
	'feature_1_desc'   => __( 'Programas de certificación que avalan el manejo seguro y correcto de montacargas y equipos especializados.', 'amex-machinery' ),
	'feature_2_titulo' => __( 'Cursos teórico-prácticos', 'amex-machinery' ),
	'feature_2_desc'   => __( 'Capacitación que combina fundamentos teóricos con práctica real sobre el equipo.', 'amex-machinery' ),
	'feature_3_titulo' => __( 'Normativas de seguridad vigentes', 'amex-machinery' ),
	'feature_3_desc'   => __( 'Cursos alineados a las normas oficiales de seguridad e higiene aplicables en México.', 'amex-machinery' ),
	'feature_4_titulo' => __( 'Capacitación en sitio', 'amex-machinery' ),
	'feature_4_desc'   => __( 'Llevamos la capacitación directamente a tus instalaciones, adaptada a tu operación real.', 'amex-machinery' ),
	'feature_5_titulo' => __( 'Renovación y actualización', 'amex-machinery' ),
	'feature_5_desc'   => __( 'Cursos de refuerzo periódicos para mantener vigente la certificación de tus operadores.', 'amex-machinery' ),
	'beneficio_1'      => __( 'Reduces accidentes y riesgos laborales en tu operación.', 'amex-machinery' ),
	'beneficio_2'      => __( 'Cumples con las normativas de seguridad aplicables.', 'amex-machinery' ),
	'beneficio_3'      => __( 'Aumentas la eficiencia operativa de tus equipos.', 'amex-machinery' ),
	'beneficio_4'      => __( 'Disminuyes el desgaste y daño al equipo por mal manejo.', 'amex-machinery' ),
	'contacto_titulo'  => __( 'Ponte en contacto con nosotros', 'amex-machinery' ),
	'faq_1_pregunta'   => __( '¿Cuánto dura la certificación de un operador?', 'amex-machinery' ),
	'faq_2_pregunta'   => __( '¿La capacitación es en sus instalaciones o en las nuestras?', 'amex-machinery' ),
	'faq_3_pregunta'   => __( '¿Qué normativas cubre la certificación?', 'amex-machinery' ),
	'faq_4_pregunta'   => __( '¿Cada cuánto se debe renovar la certificación?', 'amex-machinery' ),
	'faq_5_pregunta'   => __( '¿Cuántos operadores pueden capacitarse por sesión?', 'amex-machinery' ),
	'faq_6_pregunta'   => __( '¿Entregan alguna constancia oficial?', 'amex-machinery' ),
);
?>

<?php get_template_part( 'template-parts/servicio-hero', null, array( 'prefix' => 'capacitacion', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-detalle', null, array( 'prefix' => 'capacitacion', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-contacto', null, array( 'prefix' => 'capacitacion', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-faq', null, array( 'prefix' => 'capacitacion', 'defaults' => $defaults ) ); ?>

<?php get_footer(); ?>

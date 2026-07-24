<?php
/**
 * Template Name: Renta
 *
 * Página de servicio "Renta de Montacargas". Misma estructura que
 * page-venta.php (mismos template-parts genéricos de servicio), con
 * 'prefix' => 'renta' para leer sus propios campos ACF
 * (acf-json/group_pagina_renta.json).
 *
 * El copy por defecto de abajo es placeholder adaptado al contexto de
 * renta (no vino de una captura de referencia como venta) — ajústalo
 * si tienes el diseño real de esta página.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$defaults = array(
	'hero_titulo'      => __( 'Renta de Montacargas', 'amex-machinery' ),
	'hero_subtitulo'   => __( 'Soluciones de renta flexibles para cada necesidad operativa', 'amex-machinery' ),
	'hero_texto_1'     => __( 'En Amex Machinery ofrecemos renta de montacargas, plataformas elevadoras y equipos especializados sin necesidad de una inversión de capital. Mantén tu operación funcionando con equipos certificados y en óptimas condiciones.', 'amex-machinery' ),
	'hero_texto_2'     => __( 'Ya sea que necesites un equipo para un proyecto temporal, un pico de demanda estacional, o como solución mientras decides tu compra, tenemos el plan de renta ideal para cada operación.', 'amex-machinery' ),
	'servicio_titulo'  => __( 'Nuestro servicio de Renta de Montacargas incluye:', 'amex-machinery' ),
	'feature_1_titulo' => __( 'Amplia flota de equipos disponibles', 'amex-machinery' ),
	'feature_1_desc'   => __( 'Montacargas eléctricos, de combustión, plataformas de elevación y equipos especializados, listos para renta inmediata en toda la región.', 'amex-machinery' ),
	'feature_2_titulo' => __( 'Renta a corto y largo plazo', 'amex-machinery' ),
	'feature_2_desc'   => __( 'Planes flexibles por día, semana, mes o proyecto completo, adaptados al tiempo real que necesitas el equipo.', 'amex-machinery' ),
	'feature_3_titulo' => __( 'Mantenimiento incluido', 'amex-machinery' ),
	'feature_3_desc'   => __( 'Todo el mantenimiento preventivo y correctivo durante el periodo de renta corre por nuestra cuenta, sin costos ocultos.', 'amex-machinery' ),
	'feature_4_titulo' => __( 'Entrega e instalación en sitio', 'amex-machinery' ),
	'feature_4_desc'   => __( 'Llevamos el equipo directo a tu operación, con capacitación básica de uso incluida para tu equipo de trabajo.', 'amex-machinery' ),
	'feature_5_titulo' => __( 'Soporte técnico permanente', 'amex-machinery' ),
	'feature_5_desc'   => __( 'Asistencia técnica durante todo el periodo de renta para que tu operación nunca se detenga.', 'amex-machinery' ),
	'beneficio_1'      => __( 'Sin inversión de capital: opera con equipo de punta sin comprarlo.', 'amex-machinery' ),
	'beneficio_2'      => __( 'Flexibilidad para escalar tu flota según la demanda de cada temporada o proyecto.', 'amex-machinery' ),
	'beneficio_3'      => __( 'Cero preocupaciones por mantenimiento, depreciación o reventa del equipo.', 'amex-machinery' ),
	'beneficio_4'      => __( 'Acceso a tecnología reciente y equipos siempre certificados y en buen estado.', 'amex-machinery' ),
	'contacto_titulo'  => __( 'Ponte en contacto con nosotros', 'amex-machinery' ),
	'faq_1_pregunta'   => __( '¿Cuál es el periodo mínimo de renta?', 'amex-machinery' ),
	'faq_2_pregunta'   => __( '¿Qué incluye el servicio de renta?', 'amex-machinery' ),
	'faq_3_pregunta'   => __( '¿Puedo rentar por proyecto o temporada?', 'amex-machinery' ),
	'faq_4_pregunta'   => __( '¿Qué pasa si el equipo falla durante la renta?', 'amex-machinery' ),
	'faq_5_pregunta'   => __( '¿Ofrecen opción de compra al finalizar la renta?', 'amex-machinery' ),
	'faq_6_pregunta'   => __( '¿En qué zonas del país tienen cobertura de renta?', 'amex-machinery' ),
);
?>

<?php get_template_part( 'template-parts/servicio-hero', null, array( 'prefix' => 'renta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-detalle', null, array( 'prefix' => 'renta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-contacto', null, array( 'prefix' => 'renta', 'defaults' => $defaults ) ); ?>

<?php get_template_part( 'template-parts/servicio-faq', null, array( 'prefix' => 'renta', 'defaults' => $defaults ) ); ?>

<?php get_footer(); ?>

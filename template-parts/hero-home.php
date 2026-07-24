<?php
/**
 * Hero del home — template-parts/hero-home.php
 *
 * Todo el contenido es editable vía ACF (field group "Home — Hero",
 * ver acf-json/group_home_hero.json), excepto los íconos de las 4
 * métricas, que son fijos por posición (1-4) en este template.
 *
 * Los CTAs "Ver equipos usados/nuevos" enlazan al catálogo real
 * filtrado por condición (?Condicion_equal=usado|nuevo).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$badge      = get_field( 'hero_badge' ) ?: __( 'Amex Machinery', 'amex-machinery' );
$titulo     = get_field( 'hero_titulo' ) ?: __( 'Montacargas que maximizan tu eficiencia operativa', 'amex-machinery' );
$subtitulo  = get_field( 'hero_subtitulo' ) ?: __( 'Soluciones Integrales para tu operación: Montacargas, Plataformas de Elevación, Refacciones, Mantenimiento, Renta, Venta y Capacitación. Todo en un sólo partner.', 'amex-machinery' );
$bg_image   = get_field( 'hero_imagen_fondo' );
$cta_usados = get_field( 'hero_cta_usados_texto' ) ?: __( 'Ver equipos usados', 'amex-machinery' );
$cta_nuevos = get_field( 'hero_cta_nuevos_texto' ) ?: __( 'Ver equipos nuevos', 'amex-machinery' );
$telefono   = get_field( 'hero_telefono' ) ?: amex_contact_field( 'telefono', '614 280 0464' );
$telefono_href = '+52' . preg_replace( '/[^0-9]/', '', $telefono );

$stats = array(
	array(
		'numero' => get_field( 'stat_1_numero' ) ?: '+4,500',
		'label'  => get_field( 'stat_1_label' ) ?: __( 'equipos entregados', 'amex-machinery' ),
		'icon'   => '<path d="M12 3l8 4v10l-8 4-8-4V7l8-4Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M4 7l8 4 8-4M12 11v10" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>',
	),
	array(
		'numero' => get_field( 'stat_2_numero' ) ?: '38',
		'label'  => get_field( 'stat_2_label' ) ?: __( 'años de experiencia', 'amex-machinery' ),
		'icon'   => '<circle cx="12" cy="9" r="5" stroke="currentColor" stroke-width="1.5"/><path d="M9 13.5L7 21l5-2.5L17 21l-2-7.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>',
	),
	array(
		'numero' => get_field( 'stat_3_numero' ) ?: '+900',
		'label'  => get_field( 'stat_3_label' ) ?: __( 'clientes satisfechos', 'amex-machinery' ),
		'icon'   => '<path d="M12 21s-7-4.35-9.5-8.5C0.5 8.5 2.5 5 6 5c2 0 3.5 1 6 3.2C14.5 6 16 5 18 5c3.5 0 5.5 3.5 3.5 7.5C19 16.65 12 21 12 21Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>',
	),
	array(
		'numero' => get_field( 'stat_4_numero' ) ?: '+9',
		'label'  => get_field( 'stat_4_label' ) ?: __( 'marcas reconocidas a nivel mundial', 'amex-machinery' ),
		'icon'   => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
	),
);
?>
<section class="home-hero"<?php echo $bg_image ? ' style="--home-hero-bg: url(' . esc_url( $bg_image['url'] ) . ')"' : ''; ?>>
	<div class="home-hero__overlay"></div>

	<div class="container home-hero__content">
		<span class="home-hero__badge"><?php echo esc_html( $badge ); ?></span>

		<h1 class="home-hero__title"><?php echo esc_html( $titulo ); ?></h1>

		<p class="home-hero__subtitle"><?php echo esc_html( $subtitulo ); ?></p>

		<div class="home-hero__cta-row">
			<a class="btn btn--primary" href="<?php echo esc_url( amex_catalog_condition_url( 'usado' ) ); ?>">
				<?php echo esc_html( $cta_usados ); ?>
			</a>
			<a class="btn btn--outline-white" href="<?php echo esc_url( amex_catalog_condition_url( 'nuevo' ) ); ?>">
				<?php echo esc_html( $cta_nuevos ); ?>
			</a>
		</div>

		<a class="home-hero__phone" href="tel:<?php echo esc_attr( $telefono_href ); ?>">
			<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
			<span><?php esc_html_e( '¿Necesitas atención inmediata?', 'amex-machinery' ); ?> <strong><?php echo esc_html( $telefono ); ?></strong></span>
		</a>
	</div>

	<div class="home-hero__stats">
		<div class="container home-hero__stats-grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="home-hero__stat">
					<span class="home-hero__stat-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><?php echo $stat['icon']; ?></svg>
					</span>
					<div>
						<strong><?php echo esc_html( $stat['numero'] ); ?></strong>
						<span><?php echo esc_html( $stat['label'] ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
/**
 * Bloque 2 — "Servicio incluye" + "Beneficios para tu empresa"
 * (reusable: venta, renta, etc.). Dos columnas: contenido (dos
 * sub-bloques apilados) a la izquierda, dos imágenes apiladas a la
 * derecha con la misma altura total.
 *
 * $args esperados:
 *   'prefix'   string, prefijo de los campos ACF.
 *   'defaults' array asociativo con defaults por sufijo de campo:
 *              servicio_titulo, cta1_texto, cta2_texto,
 *              feature_N_titulo/desc (N=1..5), beneficios_titulo,
 *              beneficios_cta_texto, beneficio_N (N=1..4).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prefix   = $args['prefix'];
$defaults = isset( $args['defaults'] ) ? $args['defaults'] : array();

$servicio_titulo = get_field( "{$prefix}_servicio_titulo" ) ?: ( $defaults['servicio_titulo'] ?? '' );
$cta1_texto      = get_field( "{$prefix}_cta1_texto" ) ?: ( $defaults['cta1_texto'] ?? __( 'Ver equipos usados', 'amex-machinery' ) );
$cta2_texto      = get_field( "{$prefix}_cta2_texto" ) ?: ( $defaults['cta2_texto'] ?? __( 'Ver equipos nuevos', 'amex-machinery' ) );

$features = array();
for ( $i = 1; $i <= 5; $i++ ) {
	$titulo = get_field( "{$prefix}_feature_{$i}_titulo" ) ?: ( $defaults["feature_{$i}_titulo"] ?? '' );
	if ( ! $titulo ) {
		continue;
	}
	$features[] = array(
		'titulo' => $titulo,
		'desc'   => get_field( "{$prefix}_feature_{$i}_desc" ) ?: ( $defaults["feature_{$i}_desc"] ?? '' ),
	);
}

$beneficios_titulo = get_field( "{$prefix}_beneficios_titulo" ) ?: ( $defaults['beneficios_titulo'] ?? __( 'Beneficios para tu empresa', 'amex-machinery' ) );
$beneficios_cta     = get_field( "{$prefix}_beneficios_cta_texto" ) ?: ( $defaults['beneficios_cta_texto'] ?? __( 'Contáctanos', 'amex-machinery' ) );

$beneficios = array();
for ( $i = 1; $i <= 4; $i++ ) {
	$texto = get_field( "{$prefix}_beneficio_{$i}" ) ?: ( $defaults["beneficio_{$i}"] ?? '' );
	if ( $texto ) {
		$beneficios[] = $texto;
	}
}

$imagen_1 = get_field( "{$prefix}_imagen_1" );
$imagen_2 = get_field( "{$prefix}_imagen_2" );
$cta_url  = amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#';
?>
<section class="servicio-detalle">
	<div class="container servicio-detalle__grid">

		<div class="servicio-detalle__content">

			<div class="servicio-detalle__block">
				<h2><?php echo esc_html( $servicio_titulo ); ?></h2>

				<?php if ( $features ) : ?>
					<div class="servicio-features">
						<?php foreach ( $features as $feature ) : ?>
							<div class="servicio-features__item">
								<span class="servicio-features__icon">
									<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M8.5 12.3l2.3 2.3 4.7-4.7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</span>
								<h3><?php echo esc_html( $feature['titulo'] ); ?></h3>
								<?php if ( $feature['desc'] ) : ?>
									<p><?php echo esc_html( $feature['desc'] ); ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="servicio-detalle__cta-row">
					<a class="btn btn--primary" href="<?php echo esc_url( amex_catalog_condition_url( 'usado' ) ); ?>"><?php echo esc_html( $cta1_texto ); ?></a>
					<a class="btn btn--outline" href="<?php echo esc_url( amex_catalog_condition_url( 'nuevo' ) ); ?>"><?php echo esc_html( $cta2_texto ); ?></a>
				</div>
			</div>

			<div class="servicio-detalle__block">
				<h2><?php echo esc_html( $beneficios_titulo ); ?></h2>

				<?php if ( $beneficios ) : ?>
					<ul class="servicio-beneficios">
						<?php foreach ( $beneficios as $beneficio ) : ?>
							<li><?php echo esc_html( $beneficio ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<a class="btn btn--outline" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $beneficios_cta ); ?></a>
			</div>

		</div>

		<div class="servicio-detalle__images">
			<?php if ( $imagen_1 ) : ?>
				<div class="servicio-detalle__image">
					<img src="<?php echo esc_url( $imagen_1['url'] ); ?>" alt="<?php echo esc_attr( $imagen_1['alt'] ); ?>" loading="lazy">
				</div>
			<?php endif; ?>
			<?php if ( $imagen_2 ) : ?>
				<div class="servicio-detalle__image">
					<img src="<?php echo esc_url( $imagen_2['url'] ); ?>" alt="<?php echo esc_attr( $imagen_2['alt'] ); ?>" loading="lazy">
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>

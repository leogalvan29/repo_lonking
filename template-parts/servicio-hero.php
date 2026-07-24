<?php
/**
 * Bloque 1 — Hero de página de servicio (reusable: venta, renta, etc.).
 *
 * $args esperados:
 *   'prefix'   string, prefijo de los campos ACF (ej. 'venta', 'renta').
 *   'defaults' array asociativo con defaults por sufijo de campo:
 *              hero_titulo, hero_subtitulo, hero_texto_1, hero_texto_2.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$prefix   = $args['prefix'];
$defaults = isset( $args['defaults'] ) ? $args['defaults'] : array();

$titulo    = get_field( "{$prefix}_hero_titulo" ) ?: ( $defaults['hero_titulo'] ?? '' );
$subtitulo = get_field( "{$prefix}_hero_subtitulo" ) ?: ( $defaults['hero_subtitulo'] ?? '' );
$texto_1   = get_field( "{$prefix}_hero_texto_1" ) ?: ( $defaults['hero_texto_1'] ?? '' );
$texto_2   = get_field( "{$prefix}_hero_texto_2" ) ?: ( $defaults['hero_texto_2'] ?? '' );
$bg_image  = get_field( "{$prefix}_hero_imagen_fondo" );
?>
<section class="servicio-hero"<?php echo $bg_image ? ' style="--servicio-hero-bg: url(' . esc_url( $bg_image['url'] ) . ')"' : ''; ?>>
	<div class="servicio-hero__overlay"></div>

	<div class="container">
		<div class="servicio-hero__content">
			<h1><?php echo esc_html( $titulo ); ?></h1>
			<?php if ( $subtitulo ) : ?>
				<p class="servicio-hero__subtitle"><?php echo esc_html( $subtitulo ); ?></p>
			<?php endif; ?>

			<?php if ( $texto_1 ) : ?>
				<p><?php echo esc_html( $texto_1 ); ?></p>
			<?php endif; ?>

			<?php if ( $texto_2 ) : ?>
				<p><?php echo esc_html( $texto_2 ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

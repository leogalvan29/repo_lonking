<?php
/**
 * Sección de video del home — template-parts/video-home.php
 *
 * Video de YouTube como fondo decorativo (autoplay, sin sonido, en loop
 * y sin controles), justo después del hero. Contenido editable vía ACF
 * (field group "Home — Video", ver acf-json/group_home_video.json).
 * Si la URL del video está vacía o no es válida, la sección no se muestra.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$video_id = amex_youtube_id( amex_get_field( 'video_home_url' ) );

if ( ! $video_id ) {
	return;
}

$titulo    = amex_get_field( 'video_home_titulo' );
$subtitulo = amex_get_field( 'video_home_subtitulo' );
$poster    = amex_get_field( 'video_home_imagen_respaldo' );
$poster    = $poster ? $poster['url'] : 'https://i.ytimg.com/vi/' . $video_id . '/hqdefault.jpg';

// loop=1 solo funciona en el embed si playlist apunta al mismo video.
$embed_url = add_query_arg(
	array(
		'autoplay'       => 1,
		'mute'           => 1,
		'loop'           => 1,
		'playlist'       => $video_id,
		'controls'       => 0,
		'playsinline'    => 1,
		'rel'            => 0,
		'disablekb'      => 1,
		'iv_load_policy' => 3,
	),
	'https://www.youtube-nocookie.com/embed/' . $video_id
);
?>
<section class="video-home<?php echo ( $titulo || $subtitulo ) ? ' video-home--has-text' : ''; ?>" style="--video-home-poster: url(<?php echo esc_url( $poster ); ?>)">
	<div class="video-home__bg" aria-hidden="true">
		<iframe
			src="<?php echo esc_url( $embed_url ); ?>"
			title="<?php echo esc_attr( $titulo ?: __( 'Video Amex Machinery', 'amex-machinery' ) ); ?>"
			allow="autoplay; encrypted-media; picture-in-picture"
			tabindex="-1"
			loading="lazy"
			frameborder="0"
		></iframe>
	</div>

	<div class="video-home__overlay"></div>

	<?php if ( $titulo || $subtitulo ) : ?>
		<div class="container video-home__content">
			<?php if ( $titulo ) : ?>
				<h2 class="video-home__title"><?php echo esc_html( $titulo ); ?></h2>
			<?php endif; ?>

			<?php if ( $subtitulo ) : ?>
				<p class="video-home__subtitle"><?php echo esc_html( $subtitulo ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>

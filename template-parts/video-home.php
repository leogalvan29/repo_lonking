<?php
/**
 * Sección de video del home — template-parts/video-home.php
 *
 * Video de YouTube centrado, justo después del hero. Se muestra la
 * miniatura con un botón de play y el iframe de YouTube solo se carga
 * al hacer clic (initVideoFacades en main.js), para no cargar ~1MB de
 * JS de YouTube en cada visita. Sin JS, el botón abre el video en YouTube.
 *
 * Contenido editable vía ACF (field group "Home — Video", ver
 * acf-json/group_home_video.json). Si la URL del video está vacía o no
 * es válida, la sección no se muestra.
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
$imagen    = amex_get_field( 'video_home_imagen_respaldo' );
$imagen    = $imagen ? $imagen['url'] : amex_youtube_thumbnail( $video_id );
$label     = $titulo ?: __( 'Video Amex Machinery', 'amex-machinery' );

$embed_url = add_query_arg(
	array(
		'autoplay' => 1,
		'rel'      => 0,
	),
	'https://www.youtube-nocookie.com/embed/' . $video_id
);
?>
<section class="video-home">
	<div class="container">
		<?php if ( $titulo || $subtitulo ) : ?>
			<div class="video-home__header">
				<?php if ( $titulo ) : ?>
					<h2 class="video-home__title"><?php echo esc_html( $titulo ); ?></h2>
				<?php endif; ?>

				<?php if ( $subtitulo ) : ?>
					<p class="video-home__subtitle"><?php echo esc_html( $subtitulo ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="video-home__player" data-video-facade data-embed-url="<?php echo esc_url( $embed_url ); ?>" data-video-title="<?php echo esc_attr( $label ); ?>">
			<a class="video-home__facade" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=' . $video_id ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( sprintf( __( 'Reproducir video: %s', 'amex-machinery' ), $label ) ); ?>">
				<img src="<?php echo esc_url( $imagen ); ?>" alt="" loading="lazy" decoding="async">
				<span class="video-home__play" aria-hidden="true">
					<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M8 5.5v13a.5.5 0 0 0 .76.43l10.4-6.5a.5.5 0 0 0 0-.86L8.76 5.07A.5.5 0 0 0 8 5.5Z"/></svg>
				</span>
			</a>
		</div>
	</div>
</section>

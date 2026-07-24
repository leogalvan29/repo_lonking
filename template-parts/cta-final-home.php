<?php
/**
 * CTA final del home — template-parts/cta-final-home.php
 *
 * Último bloque del home: tarjeta con foto + texto + botón a
 * Contáctanos. Contenido editable vía ACF (field group "Home — CTA
 * final").
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$titulo    = get_field( 'final_titulo' ) ?: __( '¿No encuentras lo que buscas?', 'amex-machinery' );
$subtitulo = get_field( 'final_subtitulo' ) ?: __( 'Ponte en contacto con nuestro equipo para dudas sobre inventarios, maquinarias, detalles, ubicaciones y más.', 'amex-machinery' );
$cta_texto = get_field( 'final_cta_texto' ) ?: __( 'Contáctanos', 'amex-machinery' );
$imagen    = get_field( 'final_imagen' );
$cta_url   = amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#';
?>
<section class="cta-final">
	<div class="container">
		<div class="cta-final__card">
			<div class="cta-final__image">
				<?php if ( $imagen ) : ?>
					<img src="<?php echo esc_url( $imagen['url'] ); ?>" alt="<?php echo esc_attr( $imagen['alt'] ); ?>" loading="lazy">
				<?php endif; ?>
			</div>

			<div class="cta-final__content">
				<h2><?php echo esc_html( $titulo ); ?></h2>
				<p><?php echo esc_html( $subtitulo ); ?></p>
				<a class="btn btn--primary" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_texto ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
/**
 * Fallback template principal.
 * Las plantillas específicas (front-page.php, archive-product.php,
 * single-product.php, etc.) se agregan en fases posteriores del brief.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="container" style="padding-block: 80px;">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?></div>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No hay contenido todavía.', 'amex-machinery' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();

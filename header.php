<?php
/**
 * Header — AMEX Machinery
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'Saltar al contenido', 'amex-machinery' ); ?></a>

<header class="site-header">
	<div class="container header-inner">

		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="site-logo">AMEX<span>machinery</span></span>
				<?php endif; ?>
			</a>
			<span class="site-badge">
				<?php esc_html_e( 'Distribuidor Autorizado Heli', 'amex-machinery' ); ?>
			</span>
		</div>

		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Menú principal', 'amex-machinery' ); ?>">
			<?php amex_primary_nav( false ); ?>
		</nav>

		<div class="header-actions">
			<a class="header-phone" href="tel:<?php echo esc_attr( amex_theme_telefono_href() ); ?>">
				<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
				<span><?php echo esc_html( amex_theme_telefono() ); ?></span>
			</a>

			<a class="btn btn--whatsapp header-whatsapp" href="https://wa.me/<?php echo esc_attr( amex_theme_telefono_whatsapp() ); ?>?text=<?php echo rawurlencode( 'Necesito más información sobre AMEX Machinery' ); ?>" target="_blank" rel="noopener">
				<?php esc_html_e( 'WhatsApp', 'amex-machinery' ); ?>
			</a>

			<button type="button" class="nav-toggle" aria-expanded="false" aria-controls="mobile-nav" aria-label="<?php esc_attr_e( 'Abrir menú', 'amex-machinery' ); ?>">
				<svg class="icon-open" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
				<svg class="icon-close" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
			</button>
		</div>

	</div>

	<div class="mobile-nav" id="mobile-nav">
		<div class="container">
			<nav aria-label="<?php esc_attr_e( 'Menú principal (móvil)', 'amex-machinery' ); ?>">
				<?php amex_primary_nav( true ); ?>
			</nav>

			<div class="mobile-nav-actions">
				<a class="header-phone" href="tel:<?php echo esc_attr( amex_theme_telefono_href() ); ?>">
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.9c0-.6.4-1 1-1H7.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					<span><?php echo esc_html( amex_theme_telefono() ); ?></span>
				</a>
				<a class="btn btn--whatsapp" href="https://wa.me/<?php echo esc_attr( amex_theme_telefono_whatsapp() ); ?>?text=<?php echo rawurlencode( 'Necesito más información sobre AMEX Machinery' ); ?>" target="_blank" rel="noopener">
					<?php esc_html_e( 'WhatsApp', 'amex-machinery' ); ?>
				</a>
			</div>
		</div>
	</div>
</header>

<main id="main-content">

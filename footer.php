<?php
/**
 * Footer — AMEX Machinery
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_telefono      = amex_theme_telefono();
$footer_telefono_href = amex_theme_telefono_href();
$footer_facebook      = amex_contact_field( 'facebook_url', 'https://www.facebook.com/amexmachinery/' );
$footer_instagram     = amex_contact_field( 'instagram_url', 'https://www.instagram.com/amexmachinery' );
$footer_linkedin      = amex_contact_field( 'linkedin_url', 'https://www.linkedin.com/company/amex-machinery/' );
$footer_marcas        = amex_get_terms_safe( 'pa_marca' );
$footer_servicios     = amex_get_service_pages();
?>
</main><!-- #main-content -->

<footer class="site-footer">
	<div class="container">

		<div class="footer-grid">

			<div class="footer-col footer-col--locations">
				<div class="footer-social">
					<a href="<?php echo esc_url( $footer_facebook ); ?>" target="_blank" rel="noopener" aria-label="Facebook">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M14 9h2V6h-2c-1.7 0-3 1.3-3 3v2H9v3h2v6h3v-6h2.2l.8-3H14V9.3c0-.2.1-.3.3-.3H14Z" fill="currentColor"/></svg>
					</a>
					<a href="<?php echo esc_url( $footer_instagram ); ?>" target="_blank" rel="noopener" aria-label="Instagram">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.6"/><circle cx="16.6" cy="7.4" r="1" fill="currentColor"/></svg>
					</a>
					<a href="<?php echo esc_url( $footer_linkedin ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.6"/><path d="M8 10.5V16M8 8v.01M12 16v-3.2c0-1 .8-1.8 1.8-1.8s1.8.8 1.8 1.8V16" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
					</a>
				</div>

				<div class="footer-direct-contact">
					<span class="footer-col-title" style="margin-bottom:6px;"><?php esc_html_e( 'Contacto Directo', 'amex-machinery' ); ?></span>
					<a href="tel:<?php echo esc_attr( $footer_telefono_href ); ?>"><?php echo esc_html( $footer_telefono ); ?></a>
				</div>
			</div>

			<div class="footer-col">
				<h3 class="footer-col-title"><?php esc_html_e( 'Nuestro Catálogo', 'amex-machinery' ); ?></h3>
				<ul>
					<li><a href="<?php echo esc_url( amex_catalog_condition_url( 'nuevo' ) ); ?>"><?php esc_html_e( 'Equipos nuevos', 'amex-machinery' ); ?></a></li>
					<li><a href="<?php echo esc_url( amex_catalog_condition_url( 'usado' ) ); ?>"><?php esc_html_e( 'Equipos usados', 'amex-machinery' ); ?></a></li>
					<?php foreach ( $footer_marcas as $marca ) : ?>
						<li>
							<a href="<?php echo esc_url( amex_catalog_marca_url( $marca->slug ) ); ?>">
								<?php
								printf(
									/* translators: %s: nombre de la marca */
									esc_html__( 'Equipos %s', 'amex-machinery' ),
									esc_html( $marca->name )
								);
								?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="footer-col">
				<h3 class="footer-col-title"><?php esc_html_e( 'Marcas', 'amex-machinery' ); ?></h3>
				<?php if ( ! amex_footer_nav( 'footer-marcas' ) ) : ?>
					<ul>
						<?php foreach ( $footer_marcas as $marca ) : ?>
							<li><a href="<?php echo esc_url( amex_catalog_marca_url( $marca->slug ) ); ?>"><?php echo esc_html( $marca->name ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php if ( has_nav_menu( 'footer-servicios' ) || $footer_servicios ) : ?>
				<div class="footer-col">
					<h3 class="footer-col-title"><?php esc_html_e( 'Servicios', 'amex-machinery' ); ?></h3>
					<?php if ( ! amex_footer_nav( 'footer-servicios' ) ) : ?>
						<ul>
							<?php foreach ( $footer_servicios as $servicio ) : ?>
								<li><a href="<?php echo esc_url( $servicio['url'] ); ?>"><?php echo esc_html( $servicio['titulo'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="footer-col">
				<h3 class="footer-col-title"><?php esc_html_e( 'Nosotros', 'amex-machinery' ); ?></h3>
				<ul>
					<li><a href="<?php echo esc_url( amex_contacto_page_id() ? get_permalink( amex_contacto_page_id() ) : '#' ); ?>"><?php esc_html_e( 'Contáctanos', 'amex-machinery' ); ?></a></li>
				</ul>
			</div>

		</div>

		<div class="footer-assoc">
			<p class="footer-assoc-title"><?php esc_html_e( 'Asociaciones a las que pertenecemos', 'amex-machinery' ); ?></p>
			<div class="footer-assoc-logos">
				<span>OSHA</span>
				<span>REPSE</span>
				<span>AMDM</span>
				<span>COPARMEX</span>
			</div>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Amex Machinery</p>
			<div class="footer-legal-links">
				<a href="#"><?php esc_html_e( 'Política de Privacidad', 'amex-machinery' ); ?></a>
				<a href="#"><?php esc_html_e( 'Términos y Condiciones', 'amex-machinery' ); ?></a>
				<a href="#"><?php esc_html_e( 'Aviso Legal', 'amex-machinery' ); ?></a>
			</div>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

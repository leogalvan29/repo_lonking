<?php
/**
 * Menú principal — fallback estático.
 *
 * Reproduce la estructura de navegación del sitio de referencia mientras
 * no exista un menú configurado en Apariencia > Menús. Las URLs son
 * placeholders (#) hasta que existan las páginas/taxonomías reales.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function amex_fallback_menu_items() {
	return array(
		array(
			'title'    => __( 'Equipos nuevos', 'amex-machinery' ),
			'url'      => '#',
			'children' => array(
				array( 'title' => __( 'Equipos de elevación', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Montacargas', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Equipos especializados', 'amex-machinery' ), 'url' => '#' ),
			),
		),
		array(
			'title'    => __( 'Marcas', 'amex-machinery' ),
			'url'      => '#',
			'children' => array(
				array( 'title' => 'Attached Solutions', 'url' => '#' ),
				array( 'title' => 'Combilift', 'url' => '#' ),
				array( 'title' => 'Deka', 'url' => '#' ),
				array( 'title' => 'Dingli', 'url' => '#' ),
				array( 'title' => 'Heli', 'url' => '#' ),
				array( 'title' => 'Mima', 'url' => '#' ),
				array( 'title' => 'Moffett', 'url' => '#' ),
			),
		),
		array(
			'title'    => __( 'Servicios', 'amex-machinery' ),
			'url'      => '#',
			'children' => array(
				array( 'title' => 'AMEX 360°', 'url' => '#' ),
				array( 'title' => __( 'Venta de Montacargas', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Renta de Montacargas', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Refacciones para Montacargas', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Servicio Técnico y Mantenimiento', 'amex-machinery' ), 'url' => '#' ),
				array( 'title' => __( 'Capacitación y Seguridad', 'amex-machinery' ), 'url' => '#' ),
			),
		),
		array(
			'title'    => __( 'Equipos usados', 'amex-machinery' ),
			'url'      => '#',
			'children' => array(),
		),
	);
}

function amex_render_fallback_nav( $mobile = false ) {
	$items       = amex_fallback_menu_items();
	$item_class  = $mobile ? 'mobile-menu-item' : 'menu-item';
	$sub_class   = $mobile ? 'mobile-sub-menu' : 'sub-menu';
	$toggle_attr = $mobile ? '' : ' class="nav-toggle-link"';
	?>
	<ul>
		<?php foreach ( $items as $item ) : ?>
			<?php $has_children = ! empty( $item['children'] ); ?>
			<li class="<?php echo esc_attr( $item_class ); ?><?php echo $has_children ? ' has-children' : ''; ?>">
				<?php if ( $has_children ) : ?>
					<button type="button"<?php echo $toggle_attr; ?> aria-expanded="false">
						<span><?php echo esc_html( $item['title'] ); ?></span>
						<?php echo amex_chevron_svg(); ?>
					</button>
					<ul class="<?php echo esc_attr( $sub_class ); ?>">
						<?php foreach ( $item['children'] as $child ) : ?>
							<li><a href="<?php echo esc_url( $child['url'] ); ?>"><?php echo esc_html( $child['title'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

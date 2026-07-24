<?php
/**
 * Walker de navegación custom: soporta 1 nivel de submenú (dropdown)
 * y renderiza markup distinto para desktop / mobile según se le indique.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Amex_Nav_Walker extends Walker_Nav_Menu {

	protected $mobile;

	public function __construct( $mobile = false ) {
		$this->mobile = $mobile;
	}

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$class = $this->mobile ? 'mobile-sub-menu' : 'sub-menu';
		$output .= '<ul class="' . esc_attr( $class ) . '">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$has_children = in_array( 'menu-item-has-children', $item->classes, true );

		if ( 0 === $depth ) {
			$item_class = $this->mobile ? 'mobile-menu-item' : 'menu-item';
			$output    .= '<li class="' . esc_attr( $item_class ) . ( $has_children ? ' has-children' : '' ) . '">';

			if ( $has_children ) {
				$link_class = $this->mobile ? '' : 'nav-toggle-link';
				$output    .= '<button type="button" class="' . esc_attr( $link_class ) . '" aria-expanded="false">';
				$output    .= '<span>' . esc_html( $item->title ) . '</span>';
				$output    .= amex_chevron_svg();
				$output    .= '</button>';
			} else {
				$output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
			}
		} else {
			$output .= '<li><a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/**
 * Ícono chevron reutilizado por el walker y los templates de nav.
 */
function amex_chevron_svg() {
	return '<svg class="chevron" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

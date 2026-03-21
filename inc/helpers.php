<?php

class Ntara_Nav_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {

        if ( $depth > 0 ) {
            return;
        }

        $item    = $data_object;
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $active  = in_array( 'current-menu-item', $classes, true ) ? ' aria-current="page"' : '';

        $output .= sprintf(
            '<a href="%s"%s>%s</a>',
            esc_url( $item->url ),
            $active,
            esc_html( $item->title )
        );
    }

    // Suppress list wrappers — we want bare <a> tags in a flex nav
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
}

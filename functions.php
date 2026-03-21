<?php 

require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/taxonomies.php';
require get_template_directory() . '/inc/meta.php';
require get_template_directory() . '/inc/helpers.php';

function ntara_store_enqueue_styles() {
    wp_enqueue_style(
        'ntara-store-theme',
        get_stylesheet_uri(),
        array(),
        filemtime(get_template_directory() . '/style.css'),
        'all'
    );

    wp_enqueue_style(
        'ntara-store-style',
        get_template_directory_uri() . '/assets/store.css',
        array(),
        filemtime(get_template_directory() . '/assets/store.css'),
        'all'
    );

    wp_enqueue_style('dashicons');

    wp_enqueue_script(
        'ntara-store-js',
        get_template_directory_uri() . '/assets/store.js',
        array(),
        filemtime(get_template_directory() . '/assets/store.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'ntara_store_enqueue_styles');
<?php 

function ntara_store_setup() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'custom-logo');
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ));
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ntara-store'),
        'footer_about'   => __('Footer About Menu', 'ntara-store'),
        'footer_service' => __('Footer Customer Service Menu', 'ntara-store'),
    ));
}
add_action('after_setup_theme', 'ntara_store_setup');

function ntara_allow_svg_uploads($mimes) {
    if (current_user_can('manage_options')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'ntara_allow_svg_uploads');

function ntara_fix_svg_display($response, $attachment, $meta) {
    if ($response['mime'] === 'image/svg+xml') {
        $response['sizes'] = [];
        $response['icon'] = $response['url'];
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'ntara_fix_svg_display', 10, 3);
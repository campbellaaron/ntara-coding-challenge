<?php 

function ntara_store_register_post_types() {
    $labels = [
        'name' => 'Products',
        'singular_name' => 'Product',
        'menu_name' => 'Products',
        'add_new' => 'Add New Product',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'new_item' => 'New Product',
        'view_item' => 'View Product',
        'search_items' => 'Search Products',
        'not_found' => 'No products found',
        'all_items' => 'All Products',
    ];

    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'rewrite' => array('slug' => 'shop'),
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-cart',
    );

    register_post_type('product', $args);
}

add_action('init', 'ntara_store_register_post_types');
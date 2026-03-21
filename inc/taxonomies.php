<?php 

function ntara_register_taxonomies() {
    $labels = array(
        'name' => 'Product Categories',
        'singular_name' => 'Product Category',
        'search_items' => 'Search Product Categories',
        'all_items' => 'All Product Categories',
        'parent_item' => 'Parent Product Category',
        'parent_item_colon' => 'Parent Product Category:',
        'edit_item' => 'Edit Product Category',
        'update_item' => 'Update Product Category',
        'add_new_item' => 'Add New Product Category',
        'new_item_name' => 'New Product Category Name',
        'menu_name' => 'Product Categories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-category'),
        'show_in_rest' => true,
    );

    register_taxonomy('product_category', array('product'), $args);
}
add_action('init', 'ntara_register_taxonomies');
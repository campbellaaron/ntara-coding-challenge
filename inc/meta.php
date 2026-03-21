<?php 

function ntara_add_product_meta_boxes() {
    add_meta_box(
        'ntara_product_details',
        'Product Price',
        'ntara_render_product_meta_box',
        'product',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'ntara_add_product_meta_boxes' );

function ntara_render_product_meta_box( $post ) {
    wp_nonce_field( 'ntara_save_product_meta', 'ntara_product_meta_nonce' );
    $price = get_post_meta( $post->ID, '_ntara_product_price', true );
    ?>
    <p>
        <label for="ntara_product_price">Price:</label>
        <input type="number" step="0.01" min="0" id="ntara_product_price" name="ntara_product_price" value="<?php echo esc_attr($price); ?>" />
    </p>
    <?php
}

function ntara_save_product_meta($post_id) {
    if (!isset( $_POST[ 'ntara_product_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ntara_product_meta_nonce' ], 'ntara_save_product_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST[ 'post_type' ] ) && 'product' === $_POST[ 'post_type' ] ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    if ( isset( $_POST[ 'ntara_product_price' ] ) ) {
        $price = isset( $_POST['ntara_product_price' ] ) ? floatval( $_POST[ 'ntara_product_price' ] ) : 0;
        update_post_meta( $post_id, '_ntara_product_price', $price );
    }
}
add_action( 'save_post_product', 'ntara_save_product_meta' );
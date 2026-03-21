<?php get_header(); ?>

<?php
$price       = get_post_meta( get_the_ID(), '_ntara_product_price', true );
$categories  = get_the_terms( get_the_ID(), 'product_category' );
?>

<div class="single-product-wrap">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Shop</a>
        <?php if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
            <span aria-hidden="true">&rsaquo;</span>
            <a href="<?php echo esc_url( add_query_arg( 'product_category', $categories[0]->slug, home_url( '/' ) ) ); ?>">
                <?php echo esc_html( $categories[0]->name ); ?>
            </a>
        <?php endif; ?>
        <span aria-hidden="true">&rsaquo;</span>
        <span><?php the_title(); ?></span>
    </nav>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single-product-layout">
        <div class="single-product-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/placeholder.jpg' ); ?>"
                     alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>
        </div>

        <div class="single-product-details">
            <h1 class="single-product-title"><?php the_title(); ?></h1>

            <?php if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
                <div class="single-product-cats">
                    <?php foreach ( $categories as $cat ) : ?>
                        <a href="<?php echo esc_url( add_query_arg( 'product_category', $cat->slug, home_url( '/' ) ) ); ?>"
                           class="product-cat-tag">
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ( $price ) : ?>
                <div class="single-product-price">
                    $<?php echo esc_html( number_format( (float) $price, 2 ) ); ?>
                </div>
            <?php endif; ?>

            <div class="single-product-description">
                <?php
                $content = get_the_content();
                if ( ! empty( $content ) ) :
                    the_content();
                else :
                ?>
                    <p>This product is a great addition to any collection. Crafted with quality materials and designed for everyday use, it offers both style and comfort. Available in a variety of styles to suit your needs.</p>
                    <p>Details and specifications are available upon request. Feel free to visit us in store or contact us for more information about this product.</p>
                <?php endif; ?>
            </div>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="product-button back-to-shop">
                &larr; Back to Shop
            </a>
        </div>
    </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

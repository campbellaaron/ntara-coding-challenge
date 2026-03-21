<?php get_header(); ?>

<!-- Front Page Template will be the same as the Archive template for the sake of the coding challenge -->

<?php
$paged = isset($_GET['pg']) ? max(1, absint($_GET['pg'])) : 1;
$sort = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : '';
$search = isset($_GET['product_search']) ? sanitize_text_field(wp_unslash($_GET['product_search'])) : '';
$product_category = isset($_GET['product_cat_filter']) ? sanitize_text_field(wp_unslash($_GET['product_cat_filter'])) : '';

$args = [
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => $paged,
];

if (!empty($search)) {
    $args['s'] = $search;
}

if (!empty($product_category)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'product_category',
            'field' => 'slug',
            'terms' => $product_category,
        ],
    ];
}

if ($sort === 'price_asc') {
    $args['meta_key'] = '_ntara_product_price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'ASC';
} elseif ($sort === 'price_desc') {
    $args['meta_key'] = '_ntara_product_price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'DESC';
} elseif ($sort === 'title_asc') {
    $args['orderby'] = 'title';
    $args['order'] = 'ASC';
} elseif ($sort === 'title_desc') {
    $args['orderby'] = 'title';
    $args['order'] = 'DESC';
}

$query = new WP_Query($args);
?>

<div class="store-grid-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <form method="GET" action="<?php echo esc_url(home_url('/')); ?>" class="store-search-form">
            <label for="store-search">Search</label>
            <div class="store-search-input-wrap">
                <input type="text" id="store-search" name="product_search" value="<?php echo esc_attr($search); ?>"
                    placeholder="search" />
                <button type="submit" class="store-search-button" aria-label="Search">
                    <span class="dashicons dashicons-search"></span>
                </button>
            </div>
            <?php if (!empty($sort)): ?>
                <input type="hidden" name="sort" value="<?php echo esc_attr($sort); ?>" />
            <?php endif; ?>
            <?php if (!empty($product_category)): ?>
                <input type="hidden" name="product_cat_filter" value="<?php echo esc_attr($product_category); ?>" />
            <?php endif; ?>
        </form>

        <h3>Menu</h3>
        <ul class="product-category-list">
            <?php
            $categories = get_terms([
                'taxonomy' => 'product_category',
                'hide_empty' => false,
            ]);

            if (!is_wp_error($categories) && !empty($categories)) {
                foreach ($categories as $category) {
                    $query_args = [
                        'product_cat_filter' => $category->slug,
                    ];

                    if (!empty($sort)) {
                        $query_args['sort'] = $sort;
                    }

                    if (!empty($search)) {
                        $query_args['product_search'] = $search;
                    }

                    $category_link = add_query_arg($query_args, home_url('/'));
                    $is_active = ($product_category === $category->slug) ? 'is-active' : '';

                    echo '<li><a class="' . esc_attr($is_active) . '" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>';
                }
            }
            ?>
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="view-all-categories <?php echo empty($product_category) ? 'is-active' : ''; ?>">
                    View All
                </a>
            </li>
        </ul>
    </aside>

    <!-- Product Grid -->
    <main class="store-main">
        <div class="store-topbar">
            <form method="GET" action="<?php echo esc_url(home_url('/')); ?>" class="store-sort-form">
                <label for="store-sort">Sort by:</label>
                <select name="sort" id="store-sort" onchange="this.form.submit()">
                    <option value="">Default</option>
                    <option value="price_asc" <?php selected($sort, 'price_asc'); ?>>Low-high price</option>
                    <option value="price_desc" <?php selected($sort, 'price_desc'); ?>>High-low price</option>
                    <option value="title_asc" <?php selected($sort, 'title_asc'); ?>>Title: A to Z</option>
                    <option value="title_desc" <?php selected($sort, 'title_desc'); ?>>Title: Z to A</option>
                </select>
                <?php if (!empty($search)): ?>
                    <input type="hidden" name="product_search" value="<?php echo esc_attr($search); ?>" />
                <?php endif; ?>
                <?php if (!empty($product_category)): ?>
                    <input type="hidden" name="product_cat_filter" value="<?php echo esc_attr($product_category); ?>" />
                <?php endif; ?>
            </form>
        </div>

        <p class="store-results-summary" aria-live="polite">
            Showing
            <?php echo esc_html($query->found_posts); ?> products
        </p>
        <div class="products-grid">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <?php $price = get_post_meta(get_the_ID(), '_ntara_product_price', true); ?>
                    <article class="product-card">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/placeholder.jpg'); ?>"
                                        alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-price">
                            $<?php echo esc_html(number_format((float) $price, 2)); ?>
                        </div>

                        <h2 class="product-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <a class="product-button" href="<?php the_permalink(); ?>">
                            View More Info
                        </a>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found for the current search or filter. Try another category or search term.</p>
            <?php endif; ?>
        </div>

        <?php
        $total_pages = (int) $query->max_num_pages;
        $current_page = max(1, $paged);

        $base_args = [];

        if (!empty($search)) {
            $base_args['product_search'] = $search;
        }

        if (!empty($product_category)) {
            $base_args['product_cat_filter'] = $product_category;
        }

        if (!empty($sort)) {
            $base_args['sort'] = $sort;
        }
        ?>

        <?php if ($total_pages > 1): ?>
            <nav class="pagination" aria-label="Products pagination">
                <?php if ($current_page > 1): ?>
                    <a class="pagination-prev"
                        href="<?php echo esc_url(add_query_arg(array_merge($base_args, ['pg' => $current_page - 1]), home_url('/'))); ?>">
                        &laquo; Previous
                    </a>
                <?php else: ?>
                    <span class="pagination-prev is-disabled">&laquo; Previous</span>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i === $current_page): ?>
                        <span class="page-numbers current"><?php echo esc_html($i); ?></span>
                    <?php else: ?>
                        <a class="page-numbers"
                            href="<?php echo esc_url(add_query_arg(array_merge($base_args, ['pg' => $i]), home_url('/'))); ?>">
                            <?php echo esc_html($i); ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a class="pagination-next"
                        href="<?php echo esc_url(add_query_arg(array_merge($base_args, ['pg' => $current_page + 1]), home_url('/'))); ?>">
                        Next &raquo;
                    </a>
                <?php else: ?>
                    <span class="pagination-next is-disabled">Next &raquo;</span>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </main>
</div>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
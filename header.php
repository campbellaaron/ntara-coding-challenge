<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="header-topbar">
            <div class="header-topbar-inner">
                <a href="<?php echo esc_url(home_url('/#')); ?>">Contact Us</a>
                <a href="<?php echo esc_url(home_url('/#')); ?>">Directions</a>
                <span>217-837-2790</span>
            </div>
        </div>

        <div class="header-main">
            <div class="header-main-inner">
                <div class="site-branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo-link"
                        aria-label="<?php bloginfo('name'); ?> Home">

                        <?php
                        $logo_id = get_theme_mod('custom_logo');
                        $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                        ?>

                        <?php if ($logo_url): ?>
                            <span class="site-logo-icon">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
                            </span>
                        <?php endif; ?>

                        <span class="site-logo-text">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/ntara--text-logo.svg'); ?>"
                                alt="<?php bloginfo('name'); ?>" />
                        </span>

                    </a>
                </div>

                <nav class="primary-nav" aria-label="Primary navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new Ntara_Nav_Walker(),
                        'fallback_cb' => false,
                    ));
                    ?>
                </nav>

                <div class="header-search">
                    <button type="button" class="header-search-toggle" aria-expanded="false"
                        aria-controls="header-search-panel">
                        <span class="header-search-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <span class="header-search-label">What can we help you find?</span>
                    </button>

                    <div class="header-search-panel" id="header-search-panel" hidden>
                        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header-search-form"
                            role="search">
                            <label class="screen-reader-text" for="header-search-input">Search products</label>
                            <input type="text" id="header-search-input" name="product_search"
                                value="<?php echo isset($_GET['product_search']) ? esc_attr(wp_unslash($_GET['product_search'])) : ''; ?>"
                                placeholder="Search products" class="header-search-input" />
                            <button type="submit" class="header-search-submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="page-content">
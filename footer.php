</div><!-- #page-content -->

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo-col">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link"
                aria-label="<?php bloginfo('name'); ?> Home">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/ntara-logo-blue.svg'); ?>"
                    alt="<?php bloginfo('name'); ?>" class="footer-logo-image" />
            </a>
        </div>

        <div class="footer-nav-col">
            <h4>About Us</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer_about',
                'container' => false,
                'menu_class' => 'footer-menu',
                'fallback_cb' => false,
            ));
            ?>
        </div>

        <div class="footer-nav-col">
            <h4>Customer Service</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer_service',
                'container' => false,
                'menu_class' => 'footer-menu',
                'fallback_cb' => false,
            ));
            ?>
        </div>

        <div class="footer-social-col">
            <h4>Follow Us</h4>
            <div class="footer-social-icons">
                <a href="https://facebook.com" aria-label="Facebook" class="social-icon" target="_blank"
                    rel="noopener noreferrer">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/facebook-logo.jpg'); ?>"
                        alt="Facebook" class="social-icon-image" />
                </a>

                <a href="https://twitter.com" aria-label="X / Twitter" class="social-icon" target="_blank"
                    rel="noopener noreferrer">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/x-logo.jpg'); ?>" alt="X"
                        class="social-icon-image" />
                </a>
            </div>
            <a href="<?php echo esc_url(home_url('/directions')); ?>" class="footer-directions-btn">Get Directions</a>
        </div>
    </div>

    <div class="footer-bottom">
        <span>&copy;<?php echo esc_html(date('Y')); ?> Ntara Partners, Inc.</span>
        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
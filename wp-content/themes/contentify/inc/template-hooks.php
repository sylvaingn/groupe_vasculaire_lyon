<?php
defined('ABSPATH') || exit;

// Header
add_action('contentify_parent_header_content', function () {
    ?>
    <div class="container">
        <a href="<?php echo esc_url(home_url()); ?>" class="site-logo">
            <img src="<?php echo esc_url(contentify_parent_get_custom_logo_url()); ?>" alt="">
        </a>
        <?php wp_nav_menu(['theme_location' => 'menu-primary']); ?>
    </div>
    <?php
});

// Footer
add_action('contentify_parent_footer_content', function () {
    ?>
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
    <?php
});

// Ressources externes dans le head
add_action('contentify_parent_before_wp_head', function () {
    // Font Awesome, Google Fonts, etc.
});
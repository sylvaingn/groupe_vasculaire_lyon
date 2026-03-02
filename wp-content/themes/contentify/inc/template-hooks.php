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
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
});

// TODO: Filtrage dynamique du champ posts_feed-posts selon posts_feed-post_type
// La solution AJAX dans Gutenberg est complexe, à implémenter avec plus de recherche
// Pour l'instant, le champ affiche tous les types de posts
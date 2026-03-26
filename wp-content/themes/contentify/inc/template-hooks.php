<?php
defined('ABSPATH') || exit;


add_action('contentify_parent_after_content_open', function () {
        echo '<div class="container">';
});

add_action('contentify_parent_before_content_closed', function () {
        echo '</div>';
});
// Header
add_action('contentify_parent_header_content', function () {
    $doctolib_link = get_field('doctolib_global_link', 'option');
    ?>
    <div class="container">
        <div class="masthead--wrapper">
            <a href="<?php echo esc_url(home_url()); ?>" class="site-logo">
                <img src="<?php echo esc_url(contentify_parent_get_custom_logo_url()); ?>" alt="">
            </a>
            <div class="masthead--nav">
                <?php wp_nav_menu(['theme_location' => 'menu-primary', 'container_class' => 'menu-primary-desktop--container', 'menu_class' => 'menu menu-primary-desktop']); ?>
                <?php if ($doctolib_link): ?>
                    <a href="<?php echo esc_url($doctolib_link); ?>" class="btn btn-primary" target="_blank"
                       rel="noopener">
                        <?php echo __('Rendez-vous sur Doctolib', TEXT_DOMAIN); ?>
                    </a>
                <?php endif; ?>
                <div class="container-burger">
                    <div class="burger" aria-label="Menu" aria-expanded="false">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
});

// Menu mobile (après le header)
add_action('contentify_parent_after_header', function () {
    ?>
    <nav class="menu-mobile" aria-hidden="true">
        <div class="container">
            <?php wp_nav_menu(['theme_location' => 'menu-primary', 'container' => false, 'menu_class' => 'menu menu-mobile__list']); ?>
        </div>
    </nav>
    <?php
});

// Footer
add_action('contentify_parent_footer_content', function () {
    $menus = [
            'menu-footer',
            'menu-footer-2'
    ];
    $social_instagram = get_field('social_instagram', 'option');
    $social_facebook = get_field('social_facebook', 'option');
    $social_linkedin = get_field('social_linkedin', 'option');
    $has_social = $social_instagram || $social_facebook || $social_linkedin;
    ?>
    <div class="container">
        <div class="footer--wrapper">
            <div class="footer__col footer__col--logo">
                <a href="<?php echo esc_url(home_url()); ?>" class="footer__logo">
                    <img src="<?php echo esc_url(contentify_parent_get_custom_logo_url()); ?>"
                         alt="<?php bloginfo('name'); ?>">
                </a>
                <?php if ($has_social): ?>
                    <div class="footer__social">
                        <?php if ($social_instagram): ?>
                            <a href="<?php echo esc_url($social_instagram); ?>" class="footer__social-link" target="_blank" rel="noopener" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($social_facebook): ?>
                            <a href="<?php echo esc_url($social_facebook); ?>" class="footer__social-link" target="_blank" rel="noopener" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($social_linkedin): ?>
                            <a href="<?php echo esc_url($social_linkedin); ?>" class="footer__social-link" target="_blank" rel="noopener" aria-label="LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php foreach ($menus as $menu):
                if (!has_nav_menu($menu)) {
                    continue;
                }
              
                $menu_object = wp_get_nav_menu_object(get_nav_menu_locations()[$menu] ?? 0);
                ?>
                <div class="footer__col footer__col--menu">
                    <div class="footer__title title"><?php echo esc_html($menu_object->name); ?></div>
                    <?php wp_nav_menu([
                            'theme_location' => $menu,
                            'container' => false,
                            'menu_class' => 'menu menu-footer',
                            'depth' => 1
                    ]); ?>
                </div>
            <?php endforeach; ?>

<!--            <div class="footer__col footer__col--newsletter">-->
<!--                <div class="footer__title title">--><?php //_e('Newsletter', TEXT_DOMAIN); ?><!--</div>-->
<!--                --><?php //echo do_shortcode('[contact-form-7 id="c966573"]'); ?>
<!--            </div>-->
        </div>
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
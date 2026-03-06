<?php

add_action('wp_enqueue_scripts', 'scripts_contentify');

function scripts_contentify()
{
    wp_enqueue_style('contentify-parent-style', get_template_directory_uri() . '/dist/styles.css', array(), wp_get_theme('contentify-parent')->get('Version'));
    wp_enqueue_style('contentify-style', DIST_URL . '/styles.css', array('contentify-parent-style'), time());
    wp_enqueue_script('contentify-script', DIST_URL . '/scripts.js', array('contentify-parent-gsap-setup', 'contentify-parent-swiper-setup'), time(), true);

    // Styles conditionnels pour les pages spécifiques
    if (is_singular('speciality')) {
        wp_enqueue_style('contentify-single-speciality', DIST_URL . '/single-speciality.css', array('contentify-style'), time());
    }

    if (is_page() && is_page_template('page.php')) {
        wp_enqueue_style('contentify-page', DIST_URL . '/page.css', array('contentify-style'), time());
    }

    if (is_home()) {
        wp_enqueue_style('contentify-home', DIST_URL . '/home.css', array('contentify-style'), time());
    }
}
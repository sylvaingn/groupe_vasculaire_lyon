<?php

add_action('wp_enqueue_scripts', 'scripts_contentify');

function scripts_contentify()
{
    wp_enqueue_style('contentify-parent-style', get_template_directory_uri() . '/dist/styles.css', array(), wp_get_theme('contentify-parent')->get('Version'));
    wp_enqueue_style('contentify-style', DIST_URL . '/styles.css', array('contentify-parent-style'), wp_get_theme()->get('Version'));
    wp_enqueue_script('contentify-script', DIST_URL . '/scripts.js', array('contentify-parent-gsap-setup', 'contentify-parent-swiper-setup'), wp_get_theme()->get('Version'), true);
}
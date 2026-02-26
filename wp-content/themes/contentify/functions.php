<?php
defined('ABSPATH') || exit;

// Text domain personnalisé
define('CONTENTIFY_PARENT_TEXT_DOMAIN', 'contentify');
define('TEXT_DOMAIN', 'contentify');

// Personnaliser les blocks
add_filter('contentify_parent_block_category_slug', fn() => 'contentify-blocks');
add_filter('contentify_parent_block_category_title', fn() => 'Blocs Contentify');
add_filter('contentify_parent_block_namespace', fn() => 'contentify');

// Charger les fichiers du thème enfant
require_once get_stylesheet_directory() . '/inc/template-hooks.php';
require_once get_stylesheet_directory() . '/inc/scripts-child.php';
<?php
defined('ABSPATH') || exit;

// Modifier le slug du CPT speciality
add_filter('register_post_type_args', function ($args, $post_type) {
    if ($post_type === 'speciality') {
        $args['rewrite'] = [
            'slug' => 'specialites',
            'with_front' => true,
        ];
    }
    return $args;
}, 10, 2);

<?php

$prefix = env('KEY_PREFIX', '');

return [

    /**
     *
     */
    "{$prefix}_service" => [

        'can_export' => true,
        'capability_type' => 'post',
        'exclude_from_search' => false,
        'has_archive' => 'services/all',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 5,
        'public' => true,
        'publicly_queryable' => false,
        'show_in_admin_bar' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => false,
        'show_ui' => true,
        'supports' => ['title', 'thumbnail', 'editor'],

        'description' => 'Services offered',

        'labels' => [
            'name' => 'Services',
            'singular_name' => 'Service',
        ],

        'rewrite' => [
            'slug' => 'services',
            'with_front' => true,
            'pages' => false,
            'feeds' => true
        ],

        'options' => [

            // 'sort_by_term' => [
            //     'taxonomy' => "{$prefix}_project_type",

            //     'submenu_page' => [
            //         'capability' => 'manage_options',
            //         'submenu_file' => "ba_sort_terms&taxonomy={$prefix}_project_type",
            //         'display' => false
            //     ],

            //     'term_row_action' => true
            // ]
        ]
    ],

    /**
     *
     */
    "{$prefix}_testimonial" => [

        'can_export' => true,
        'capability_type' => 'post',
        'exclude_from_search' => false,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-star-filled',
        'menu_position' => 5,
        'public' => true,
        'publicly_queryable' => false,
        'show_in_admin_bar' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => false,
        'show_ui' => true,
        'supports' => ['title', 'thumbnail'],

        'labels' => [
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial'
        ],

        'rewrite' => [
            'slug' => 'testimonials',
            'with_front' => true,
            'pages' => true,
            'feeds' => true
        ],

        'options' => [
            'somewhat_relatable_to' => ["{$prefix}_portfolio"]
        ]
    ]
];

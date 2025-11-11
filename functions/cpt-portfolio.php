<?php

function create_portfolio_cpt() {
    $labels = [
        'name' => 'Portfolio',
        'singular_name' => 'Projekt',
        'add_new_item' => 'Přidat nový projekt',
        'edit_item' => 'Upravit projekt',
        'all_items' => 'Všechny projekty',
        'menu_name' => 'Portfolio'
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'projekt'],
    ];

    register_post_type('portfolio', $args);
}
add_action('init', 'create_portfolio_cpt');

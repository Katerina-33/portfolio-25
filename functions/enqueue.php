<?php

function mytheme_enqueue_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());

    wp_enqueue_style(
        'mytheme-main',
        get_template_directory_uri() . '/assets/css/style.css',
        [],
        filemtime(get_template_directory() . '/assets/css/style.css')
    );

    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_script(
        'mytheme-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'mytheme-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'hero-js',
        get_template_directory_uri() . '/assets/js/hero.js',
        [],
        filemtime(get_template_directory() . '/assets/js/hero.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

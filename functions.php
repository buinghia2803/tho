
<?php

function nhm_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary' => 'Menu chính',
        'footer'  => 'Menu chân trang',
    ]);
}
add_action('after_setup_theme', 'nhm_theme_setup');


function nhm_enqueue_assets() {
    $css_file = get_theme_file_path('/assets/css/main.css');
    $js_file  = get_theme_file_path('/assets/js/main.js');

    wp_enqueue_style(
        'nhm-main-style',
        get_theme_file_uri('/assets/css/main.css'),
        [],
        file_exists($css_file) ? filemtime($css_file) : '1.0.0'
    );

    wp_enqueue_script(
        'nhm-main-script',
        get_theme_file_uri('/assets/js/main.js'),
        [],
        file_exists($js_file) ? filemtime($js_file) : '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'nhm_enqueue_assets');

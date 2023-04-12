<?php

add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');
function portfolio_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));
}

add_action('after_setup_theme', 'portfolio_add_theme_support');
function portfolio_add_theme_support() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'portfolio_register_menus');
function portfolio_register_menus() {
    register_nav_menu('main', 'Menu principal');
    register_nav_menu('footer', 'Pied de page');
}

add_action('widgets_init', 'portfolio_register_sidebars');
function portfolio_register_sidebars() {
    register_sidebar([
        'id' => 'footer',
        'name' => 'Pied de page',
        'before_widget' => '',
        'after_widget' => '',
    ]);
}

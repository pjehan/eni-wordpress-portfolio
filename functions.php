<?php

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load() {
    require_once('vendor/autoload.php');
    Carbon_Fields::boot();
}

add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');
function portfolio_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));
}

add_action('after_setup_theme', 'portfolio_add_theme_support');
function portfolio_add_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo', [
        'height' => 75,
        'flex-width' => true
    ]);
    add_theme_support('post-thumbnails');
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

add_action('init', 'portfolio_register_post_types');
function portfolio_register_post_types() {
    register_post_type('project', [
        'labels' => [
            'name' => 'Projets',
            'singular_name' => 'Projet',
            'menu_name' => 'Projets'
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'projets'],
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt']
    ]);

    register_taxonomy('technology', ['project'], [
        'label' => 'Technologies',
        'rewrite' => ['slug' => 'technologies'],
        'hierarchical' => false
    ]);
}

add_action('after_switch_theme', 'portfolio_rewrite_flush');
function portfolio_rewrite_flush() {
    portfolio_register_post_types();
    flush_rewrite_rules();
}

<?php

add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');
function portfolio_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));
}

add_action('after_setup_theme', 'portfolio_add_theme_support');
function portfolio_add_theme_support() {
    add_theme_support('title-tag');
}
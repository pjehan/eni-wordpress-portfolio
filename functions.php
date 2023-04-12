<?php

add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');
function portfolio_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));
}
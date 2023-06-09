<?php

use Carbon_Fields\Block;
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

    register_taxonomy('customer', ['project'], [
        'label' => 'Clients',
        'rewrite' => ['slug' => 'clients'],
        'hierarchical' => false
    ]);
}

add_action('after_switch_theme', 'portfolio_rewrite_flush');
function portfolio_rewrite_flush() {
    portfolio_register_post_types();
    flush_rewrite_rules();
}

add_action('carbon_fields_register_fields', 'portfolio_register_fields');
function portfolio_register_fields() {
    Container::make_post_meta('project-container', 'Données du projet')
        ->where('post_type', '=', 'project')
        ->add_fields([
            Field::make_date('date_start', 'Date de début')->set_required(),
            Field::make_date('date_end', 'Date de fin'),
            Field::make_text('url', 'URL')->set_attribute('type', 'url'),
            Field::make_media_gallery('gallery', 'Galerie')
        ]);

    Container::make_term_meta('technology-container', 'Données de la technologie')
        ->where('term_taxonomy', '=', 'technology')
        ->add_fields([
            Field::make_image('logo', 'Logo'),
            Field::make_text('percentage', 'Pourcentage')
                ->set_attribute('type', 'number')
                ->set_attribute('min', 0)
                ->set_attribute('max', 100)
        ]);

    Block::make('Liste des technologies')
        ->set_category('portfolio', 'Portfolio', 'star-filled')
        ->set_icon('reddit')
        ->add_fields([
            Field::make_select('columns', 'Nombre de colonnes')
                ->set_options([
                    'Une' => 1,
                    'Deux' => 2,
                    'Trois' => 3,
                    'Quatre' => 4,
                    'Cinq' => 5,
                    'Six' => 6
                ])
        ])
        ->set_render_callback(function($fields) {
            $technologies = get_terms(['taxonomy' => 'technology', 'hide_empty' => false]);
            ?>

            <section class="grid">
                <?php foreach ($technologies as $technology) : ?>
                    <?php $logo_id = carbon_get_term_meta($technology->term_id, 'logo'); ?>
                    <article>
                        <?= wp_get_attachment_image($logo_id, 'medium') ?>
                        <?= carbon_get_term_meta($technology->term_id, 'percentage') ?>
                        <?= $technology->name ?>
                    </article>
                <?php endforeach; ?>
            </section>

            <?php
        })
    ;

    Block::make('Liste des projets')
        ->set_category('portfolio', 'Portfolio', 'star-filled')
        ->set_icon('portfolio')
        ->add_fields([
            Field::make_text('nb_projects', 'Nombre de projets')
                ->set_attribute('type', 'number')
                ->set_default_value(3)
        ])
        ->set_render_callback(function($fields) {
            $nb_projects = $fields['nb_projects'];
            $query = new WP_Query([
                'post_type' => 'project',
                'posts_per_page' => $nb_projects
            ]);
            ?>

            <section class="grid">
                <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('template-parts/card', 'project'); ?>
                <?php endwhile; else : ?>
                    <p>Aucun projet à afficher</p>
                <?php endif; ?>
            </section>

            <?php
            wp_reset_postdata();
        })
    ;
}

<?php
$technology_id = get_queried_object_id();
$technology = get_term($technology_id);
$technology_logo_id = carbon_get_term_meta($technology_id, 'logo');

get_header();
?>

<main class="container">

    <h1>Liste des projets associés à la technologie : <?= $technology->name ?></h1>

    <?= wp_get_attachment_image($technology_logo_id, 'medium') ?>

    <section class="grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/card', 'project'); ?>
        <?php endwhile; else : ?>

        <?php endif; ?>
    </section>

</main>

<?php get_footer() ?>

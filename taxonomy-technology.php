<?php get_header() ?>

<main class="container">

    <h1>Liste des projets associés à la technologie : <?= get_term(get_queried_object_id())->name ?></h1>

    <section class="grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/card', 'project'); ?>
        <?php endwhile; else : ?>

        <?php endif; ?>
    </section>

</main>

<?php get_footer() ?>

<?php get_header() ?>

<main class="container">

    <section class="grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/card', 'project'); ?>
        <?php endwhile; else : ?>

        <?php endif; ?>
    </section>

</main>

<?php get_footer() ?>

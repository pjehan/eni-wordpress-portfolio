<?php get_header(); ?>

    <main class="container">

        <?php if (is_archive() || is_home()): ?>
            <section class="grid">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/card', get_post_type()); ?>
                <?php endwhile; else : ?>

                <?php endif; ?>
            </section>
        <?php else: ?>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1><?php the_title() ?></h1>
                <?php the_content() ?>
            <?php endwhile; else : ?>

            <?php endif; ?>
        <?php endif; ?>

</main>

<?php get_footer(); ?>
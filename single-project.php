<?php get_header(); ?>

<main>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="header-project" style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
            <div class="header-project-content">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>

        <div class="container">
            <?php the_content(); ?>
        </div>
    <?php endwhile; else : ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>

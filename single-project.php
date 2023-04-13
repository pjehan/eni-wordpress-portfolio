<?php get_header(); ?>

<main>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        $date_start = carbon_get_the_post_meta('date_start');
        $date_end = carbon_get_the_post_meta('date_end');
        ?>
        <header class="header-project" style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
            <div class="header-project-content">
                <h1><?php the_title(); ?></h1>
                <time datetime="<?= $date_start ?>">
                    <?= (new DateTime($date_start))->format('d/m/Y') ?>
                </time>
                <?php if ($date_end): ?>
                    <time datetime="<?= $date_end ?>">
                        <?= (new DateTime($date_end))->format('d/m/Y') ?>
                    </time>
                <?php endif; ?>
            </div>
        </header>

        <div class="container">
            <?php the_content(); ?>
        </div>
    <?php endwhile; else : ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>

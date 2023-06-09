<?php get_header(); ?>

<main>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php
        $date_start = carbon_get_the_post_meta('date_start');
        $date_end = carbon_get_the_post_meta('date_end');
        $url = carbon_get_the_post_meta('url');
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

                <?php if (!empty($url)): ?>
                    <a href="<?= $url ?>" target="_blank" class="btn btn-primary">
                        Voir le site
                    </a>
                <?php endif; ?>

            </div>
        </header>

        <div class="container">
            <?php the_content(); ?>

            <?php $gallery = carbon_get_the_post_meta('gallery'); ?>

            <?php foreach ($gallery as $image_id) : ?>
                <?= wp_get_attachment_image($image_id) ?>
            <?php endforeach; ?>

        </div>
    <?php endwhile; else : ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>

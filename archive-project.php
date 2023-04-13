<?php get_header() ?>

<main class="container">

    <section class="grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="card">
                <header>
                    <?php the_post_thumbnail() ?>
                </header>
                <main>
                    <h2><?php the_title() ?></h2>
                    <p><?php the_excerpt() ?></p>
                </main>
                <footer>
                    <a href="<?php the_permalink() ?>" class="btn btn-primary">
                        Voir plus
                    </a>
                </footer>
            </article>
        <?php endwhile; else : ?>

        <?php endif; ?>
    </section>

</main>

<?php get_footer() ?>

<article class="card">
    <header>
        <?php the_post_thumbnail('medium') ?>
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
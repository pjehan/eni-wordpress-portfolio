<article class="card">
    <header>
        <?php the_post_thumbnail('medium') ?>
    </header>
    <main>
        <h2><?php the_title() ?></h2>

        <?php //the_taxonomies(); ?>
        <?php $technologies = get_the_terms(get_the_ID(), 'technology'); ?>
        <?php if (is_array($technologies)): ?>
            <?php foreach ($technologies as $technology) : ?>
                <a href="<?= get_term_link($technology->term_id); ?>" class="btn btn-secondary btn-small">
                    <?= $technology->name ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

        <p><?php the_excerpt() ?></p>
    </main>
    <footer>
        <a href="<?php the_permalink() ?>" class="btn btn-primary">
            Voir plus
        </a>
    </footer>
</article>
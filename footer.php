
<footer class="site-footer">

    <div class="container">
        <?php dynamic_sidebar('footer'); ?>
    </div>

    <hr>

    <div class="container">
        <?php wp_nav_menu([ 'theme_location' => 'footer', 'container' => 'nav' ]); ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
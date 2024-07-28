<?php get_template_part('template-parts/lightbox') ?>
<?php get_template_part('template-parts/popup') ?>
<hr />
<footer>

    <?php wp_nav_menu([
        'theme_location' => 'footer',
    ]); ?>




</footer>


<?php wp_footer() ?>
<?php if (!is_home()): ?>
<script>

jQuery('input[name=ref]').val('<?php the_field('Reference'); ?>');
    
</script>
<?php endif; ?>
</body>

</html>
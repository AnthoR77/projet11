<?php get_header(); ?>
<div class="main single">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post">

                <div class="ref">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <p> RÉFÉRENCE : <?php the_field('Reference'); ?></p>
                    <p> CATÉGORIE : <?php the_terms(get_the_ID(), 'categorie'); ?> </p>
                    <p> FORMAT : <?php the_terms(get_the_ID(), 'format'); ?> </p>
                    <p> TYPE : <?php the_field('Type'); ?></p>
                    <p> ANNÉE : <?php the_date(); ?></p>
                    
                    <hr>
                </div>

                <div class="post-content">
                    <?php the_content(); ?>
                </div>

            </div>
         

            <div class="contact-slider">
                <div class="contact">
                    <p>Cette photo vous intéresse ?</p>
                    <a id="btn" class="btn-contact">Contact</a>
                </div>
                <div class="carrousel">
                    <div class="mini">


                        <?php
                        $previous = get_previous_post();
                        $next = get_next_post();
                        ?>


                        <?php if (get_previous_post()) { ?>
                            <img class="image-slider visible-slider" src="<?php echo get_the_post_thumbnail_url($previous) ?>" alt="précédente">
                            <img class="image-slider hidden-slider" src="<?php echo get_the_post_thumbnail_url($next) ?>" alt="suivante">

                        <?php } elseif (get_next_post()) { ?>
                            <img class="image-slider visible-slider" src="<?php echo get_the_post_thumbnail_url($next) ?>" alt="suivante">
                            <img class="image-slider hidden-slider" src="<?php echo get_the_post_thumbnail_url($previous) ?>" alt="précédente">
                        <?php } ?>

                        <div class="arrows">
                            <div>
                                <?php if (get_previous_post()) : ?>
                                    <a href="<?php echo get_the_permalink($previous) ?>">
                                        <img class="leftarrow" src="<?php echo get_stylesheet_directory_uri($previous) . '/assets/images/leftarrow.png' ?>">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if (get_next_post()) : ?>
                                    <a href="<?php echo get_the_permalink($next) ?>">
                                        <img class="rightarrow" src="<?php echo get_stylesheet_directory_uri($next) . '/assets/images/rightarrow.png' ?>">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
</div>
<hr>
<div id="vaa">
    <h3>VOUS AIMEREZ AUSSI</h3>

    <?php get_template_part('template-parts/photo-block') ?>
    

</div>

<?php endwhile; ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>
<?php get_header(); ?>
<div class="main single">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post">

                <div class="ref">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <p class="post-info"> RÉFÉRENCE : <?php the_field('Reference'); ?></p>
                    <p class="post-info"> CATÉGORIE : <?php the_terms(get_the_ID(), 'categorie'); ?> </p>
                    <p class="post-info"> FORMAT : <?php the_terms(get_the_ID(), 'format'); ?> </p>
                    <p class="post-info"> TYPE : <?php the_field('Type'); ?></p>
                    <p class="post-info"> ANNÉE : <?php the_date(); ?></p>

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
            </div>
            <hr>
            <div id="vaa">
                <h3>VOUS AIMEREZ AUSSI</h3>

                <div id="phoapp">

                    <?php
                    $cat = get_the_terms(get_the_ID(), 'categorie');
                    $query = new WP_Query([
                        'post__not_in' => [get_the_ID()],
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'tax_query' => [
                            [
                                'taxonomy' => 'categorie',
                                'field' => 'term_id',
                                'terms' => $cat[0]->term_id,
                            ]
                        ]
                    ]);
                    while ($query->have_posts()) : $query->the_post();
                    ?>

                        <?php the_content(); ?>

                    <?php endwhile;
                    wp_reset_postdata(); ?>


                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
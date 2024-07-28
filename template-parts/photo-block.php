<div id="phoappsingle">

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
     
    // Récupère l'URL de l'image
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    // Récupère la catégorie de l'image
    $image_cat = wp_get_post_terms(get_the_ID(), 'categorie')[0]->name;
    // Récupère la référence de l'image
    $image_ref = get_field('Reference');
    // Génère le code HTML de l'image avec l'overlay
    $image_html = '<div class="image-container"><img src="' . $image_url . '" alt="' . get_the_title() . '"><div class="overlay"><button id="plein" class="overlay-btn" data-lightbox="' . $image_url . '"><img  src="' . get_stylesheet_directory_uri() . '/assets/images/icone.svg" alt="Plein écran"></button><a id="overlay-icon" href="' . get_permalink() . '" class="overlay-link" target="_blank"><img  src="' . get_stylesheet_directory_uri() . '/assets/images/eye.svg" alt="Lien vers l\'article"></a><div class="overlay-content"><div class="overlay-text"><div class="overlay-ref">' . $image_ref . '</div><div class="overlay-cat">' . $image_cat . '</div></div></div></div></div>';
    echo $image_html;
    // Ajoute l'image à la galerie
    $photo_html[] = $image_html;
  endwhile;
            wp_reset_postdata(); ?>


    </div>
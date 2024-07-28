
<?php
add_theme_support( 'post-thumbnails' );

function register_my_menus() {
  register_nav_menus(
  array(
  'primary' => __( 'Primary Menu' ),
  'footer' => __( 'Menu Footer' ),
  )
  );
 }
 add_action( 'init', 'register_my_menus' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true );
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/ajax.js', array(), '1.0.0', true  );
 
    
}

// function theme_scripts() {
//   wp_deregister_script('jquery');
//   wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
//   wp_enqueue_script('jquery');
// }
// add_action('wp_enqueue_scripts', 'theme_scripts');



add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

function load_more_photos_callback() {
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = 8;
  $offset = ($page - 1) * $limit;

  $category = isset($_GET['category']) ? $_GET['category'] : '';
  $format = isset($_GET['format']) ? $_GET['format'] : '';
  $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'date';
  $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

  // Récupérer les photos en fonction des paramètres de filtre et de tri
  $args = array(
    'post_type' => 'photo',
    'posts_per_page' => $limit,
    'offset' => $offset,
    'orderby' => $orderby,
    'order' => $order
  );
  if (!empty($category)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'categorie',
        'field'    => 'slug',
        'terms'    => $category,
      ),
    );
  }
  if (!empty($format)) {
    $args['tax_query'][] = array(
      'taxonomy' => 'format',
      'field'    => 'slug',
      'terms'    => $format,
    );
  }
  $photos = new WP_Query($args);

  // Générer le HTML pour les photos avec l'overlay et le retourner sous forme de tableau JSON
  while ($photos->have_posts()) : $photos->the_post();
    // Récupère l'URL de l'image
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
    // Récupère la catégorie de l'image
    $image_cat = wp_get_post_terms(get_the_ID(), 'categorie')[0]->name;
    // Récupère la référence de l'image
    $image_ref = get_field('Reference');
    // Génère le code HTML de l'image avec l'overlay
    $image_html = '<div class="image-container" ><img src="' . $image_url . '" alt="' . get_the_title() . '"><div class="overlay"><button id="plein" class="overlay-btn" data-lightbox="' . $image_url . '" data-id="' . get_the_ID() . '"><img  src="' . get_stylesheet_directory_uri() . '/assets/images/icone.svg" alt="Plein écran"></button><a id="overlay-icon" href="' . get_permalink() . '" class="overlay-link" target="_blank"><img  src="' . get_stylesheet_directory_uri() . '/assets/images/eye.svg" alt="Lien vers l\'article"></a><div class="overlay-content"><div class="overlay-text"><div class="overlay-ref">' . $image_ref . '</div><div class="overlay-cat">' . $image_cat . '</div></div></div></div></div>';
    // Ajoute l'image à la galerie
    $photo_html[] = $image_html;
  endwhile;
  wp_reset_postdata();
  wp_send_json(array('photos' => $photo_html));
}
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos_callback');
add_action('wp_ajax_load_more_photos', 'load_more_photos_callback');

function enqueue_jquery() {
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function enqueue_custom_script() {
  wp_enqueue_script( 'lightbox-script', get_stylesheet_directory_uri() . '/assets/js/lightbox.js', array('jquery'), '1.0.0', true );
  
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_script' );

function add_acf_fields_to_rest_api() {
  register_rest_field( 'photo', 'acf', array(
    'get_callback' => function( $object, $field_name, $request ) {
      return get_fields( $object['id'] );
    }
  ) );
}
add_action( 'rest_api_init', 'add_acf_fields_to_rest_api' );


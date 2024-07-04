<?php
// add_action( 'after_setup_theme', 'register_my_menu' );
// function register_my_menu() {
//   register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
// }

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
}
    


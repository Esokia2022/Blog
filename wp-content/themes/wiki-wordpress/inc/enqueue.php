<?php

/*
==========================
  FRONT-END ENQUEUE FUNCTIONS
==========================
*/

function wiki_load_scripts(){
    //css
    wp_enqueue_style('fontOpenSans_css', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
    wp_enqueue_style('bootstrap_icon', get_stylesheet_directory_uri().'/assets/css/bootstrap-icons.css');
    wp_enqueue_style('main_style_css', get_stylesheet_directory_uri().'/assets/css/main.min.css');
    
    //js 
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri(). '/assets/js/dist/jquery.min.js', '1.0.0', true);
    wp_register_script('wiki_main_js', get_stylesheet_directory_uri(). '/assets/js/dist/script.min.js', array('jquery'), '1.0.0', true);
  
    wp_enqueue_script('jquery');
    wp_enqueue_script('wiki_main_js');
    wp_localize_script('wiki_main_js', 'ajaxurl', array(admin_url( 'admin-ajax.php' )) );
}

add_action('wp_enqueue_scripts','wiki_load_scripts', 20);
/*
==========================
  ADMIN ENQUEUE FUNCTIONS
==========================
*/

// function site_block_editor_styles() {
//     if(is_admin()){
//     add_theme_support( 'editor-styles' );
//     wp_enqueue_style( 'site-block-editor-styles', get_stylesheet_directory_uri().'/assets/dist/css/admin-style.css' , false, '1.0', 'all' );
// }

// }
// add_action( 'enqueue_block_editor_assets', 'site_block_editor_styles' );

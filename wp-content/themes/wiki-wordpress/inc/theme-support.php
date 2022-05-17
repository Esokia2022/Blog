<?php
/* Function custom_logo */
add_post_type_support( 'page', 'excerpt' );
function wiki_custom_logo_setup() {
    $defaults = array(
        // 'height'      => 100,
        // 'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
	add_theme_support( 'custom-logo', $defaults );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'wiki_custom_logo_setup' );

add_filter('comment_form_defaults', 'wiki_comment_form_defaults');
function wiki_comment_form_defaults($defaults){
    //print_r($defaults);
    $defaults['class_form'] = 'comment-form container';
    return $defaults;
}

if ( ! function_exists( 'truncate_txt' ) ) {
	function truncate_txt($excerpt = '', $charlength = 250) {
		$charlength++;
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '...';
		} else {
			echo $excerpt;
		}
	}
}

//search global<i class="bi bi-search"></i>
function get_form_search_global(){
    $output  = '<form role="search" method="get" action="'.home_url( '/' ).'">';
    $output .= '<div class="search-forms">';
    $output .= '<input autocomplete="off" type="text" class="search-form-input" placeholder="Rechercher" value="'. get_search_query().'" name="s" title="Search" />';
    $output .= '<button type="submit" class="button_search btn btn-outline icon-awesome-search" id="searchsubmit" />';
    $output .= '<i class="bi bi-search"></i>';
    $output .= '</button>';
    $output .= '</div>';
    $output .= '</form>';
    return $output;
}








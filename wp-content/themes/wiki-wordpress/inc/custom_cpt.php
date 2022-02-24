<?php 

add_action( 'init', 'renommer_projets_divi' );
function renommer_projets_divi() {
	/* Renommer le custom post type */
  register_post_type( 'project',
      array( 
          'labels' => array(
            'name' => __( 'Monuments', 'gpg' ),
            'singular_name' => __( 'Monument', 'gpg' ),
            "all_items" => __( "Tous les Monuments", "gpg" ),
						"add_new" => __( "Ajouter", "gpg" ),
						"add_new_item" => __( "Ajouter un nouveau monument", "gpg" ),
						"edit_item" => __( "Modifier le Monument", "gpg" ),
						"new_item" => __( "Nouveau Monument", "gpg" ),
						"view_item" => __( "Voire le Monument", "gpg" ),
						"view_items" => __( "Voire les Monument", "gpg" ),
						"search_items" => __( "rechercher des Monument", "gpg" ),
						"not_found" => __( "Aucune Monument trouvé", "gpg" ),
						"not_found_in_trash" => __( "Aucune Monument trouvé dans la corbeille", "gpg" ),
						"parent" => __( "Parent Monument:", "gpg" ),
						"featured_image" => __( "Featured image for this Monument", "gpg" ),
						"set_featured_image" => __( "Set featured image for this Monument", "gpg" ),
						"remove_featured_image" => __( "Remove featured image for this Monument", "gpg" ),
						"use_featured_image" => __( "Use as featured image for this Monument", "gpg" ),
						"archives" => __( "Monument archives", "gpg" ),
						"insert_into_item" => __( "Insert into Monument", "gpg" ),
						"uploaded_to_this_item" => __( "Upload to this Monument", "gpg" ),
						"filter_items_list" => __( "Filter Monument list", "gpg" ),
						"items_list_navigation" => __( "Monument list navigation", "gpg" ),
						"items_list" => __( "Monument list", "gpg" ),
						"attributes" => __( "Monument attributes", "gpg" ),
						"name_admin_bar" => __( "Monument", "gpg" ),
						"item_published" => __( "Monument published", "gpg" ),
						"item_published_privately" => __( "Monument published privately.", "gpg" ),
						"item_reverted_to_draft" => __( "Monument reverted to draft.", "gpg" ),
						"item_scheduled" => __( "Monument scheduled", "gpg" ),
						"item_updated" => __( "Monument updated.", "gpg" ),
						"parent_item_colon" => __( "Parent Monument:", "gpg" ),

      ),
      'has_archive' => true,
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true, // Disponible dans l'API
      'rewrite' => array( 'slug' => 'monument', 'with_front' => false ),
      'supports' => array(),
      'menu_icon' => 'dashicons-category',
      "description" => "",
			"publicly_queryable" => true,
			"show_ui" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail", "excerpt", "author" ]
  ));

	/* Renommer la catégorie */
  register_taxonomy( 'project_category', array( 'project' ),
    array(
      'labels' => array(
        'name' => _x( 'Nuance', 'Nuance', 'gpg' ),
    ),
      'hierarchical' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
  ) );

	/* Renommer les étiquettes */
  /*register_taxonomy( 'project_tag', array( 'project' ),
    array(
      'labels' => array(
        'name' => _x( 'Étiquettes', 'Étiquettes', 'gpg' ),
    ),
      'hierarchical' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
  ) );*/
}

function cptui_register_my_taxes_gamme() {

	/**
	 * Taxonomy: Gammes.
	 */

	$labels = [
		"name" => __( "Gammes", "gpg" ),
		"singular_name" => __( "Gamme", "gpg" ),
	];

	
	$args = [
		"label" => __( "Gammes", "gpg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'gamme', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "gamme",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "gamme", [ "project" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_gamme' );

function cptui_register_my_taxes_style() {

	/**
	 * Taxonomy: Style.
	 */

	$labels = [
		"name" => __( "Style", "gpg" ),
		"singular_name" => __( "Style", "gpg" ),
	];

	
	$args = [
		"label" => __( "Style", "gpg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'style', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "style",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "style", [ "project" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_style' );

function cptui_register_my_taxes_couleur() {

	/**
	 * Taxonomy: Couleur.
	 */

	$labels = [
		"name" => __( "Couleur", "gpg" ),
		"singular_name" => __( "Couleur", "gpg" ),
	];

	
	$args = [
		"label" => __( "Couleur", "gpg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'couleur', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "couleur",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "couleur", [ "project" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_couleur' );

function cptui_register_my_taxes_religion() {

	/**
	 * Taxonomy: Religion.
	 */

	$labels = [
		"name" => __( "Religion", "gpg" ),
		"singular_name" => __( "Religion", "gpg" ),
	];

	
	$args = [
		"label" => __( "Religion", "gpg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'religion', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "religion",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "religion", [ "project" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_religion' );

function cptui_register_my_taxes_type() {

	/**
	 * Taxonomy: Type.
	 */

	$labels = [
		"name" => __( "Type", "gpg" ),
		"singular_name" => __( "Type", "gpg" ),
	];

	
	$args = [
		"label" => __( "Type", "gpg" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => true,
		"rest_base" => "type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "type", [ "project" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_type' );



//add metabox 
add_action('add_meta_boxes','gpg_add_meta_box');

//save_custom_link
add_action('save_post','save_custom_link' );

// add metabox
function gpg_add_meta_box(){
add_meta_box('link_custom','lien de personalisation','link_custom_en_callback','project','side');
}


// callback email
function link_custom_en_callback($post){
  wp_nonce_field('save_custom_link','custom_link_meta_box_nonce');
  
  $value = get_post_meta( $post->ID, '_custom_link_en_value_key', true );
  
  echo '<label for="custom_link_field">Ajouter le lien : </label>';
  echo '<input type="text" id="custom_link_field" name="custom_link_field" value="'. esc_attr($value).'" size="25" />';
}


//save post
//email
function save_custom_link( $post_id){

  if( ! isset($_POST['custom_link_meta_box_nonce']) ){
    return;
  }

  if( ! wp_verify_nonce( $_POST['custom_link_meta_box_nonce'], 'save_custom_link') ){
    return;
  }

  if( defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE ){
    return;
  }

  if( ! current_user_can( 'edit_post',$post_id ) ){
    return;
  }

  if (! isset( $_POST['custom_link_field'])){
    return;
  }

  $my_data = sanitize_text_field( $_POST['custom_link_field'] );

  update_post_meta( $post_id,'_custom_link_en_value_key', $my_data);
}

/*add_filter( 'views_edit-project', '__return_empty_array', 99 );*/

foreach( array('project' ) as $hook )
    add_filter( "views_edit-$hook", 'modified_views_post',99 );

function modified_views_post( $views ) 
{
    $views['all'] = str_replace( 'All ', 'Tous', $views['all'] );

    if( isset( $views['publish'] ) )
        $views['publish'] = str_replace( 'Published ', 'Publié ', $views['publish'] );

    if( isset( $views['future'] ) )
        $views['future'] = str_replace( 'Scheduled ', 'En attente ', $views['future'] );

    if( isset( $views['draft'] ) )
        $views['draft'] = str_replace( 'Drafts ', 'En progression', $views['draft'] );

    if( isset( $views['trash'] ) )
        $views['trash'] = str_replace( 'Trash ', 'corbeille', $views['trash'] );

    return $views;
}
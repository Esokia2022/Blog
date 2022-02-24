<?php

function add_acf_menu_pages(){
    acf_add_options_page(array(
    	'page_title' 	=> 'Footer options',
		'menu_title'	=> 'Footer options',
		'menu_slug' 	=> 'option',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'capability' => 'manage_options',
        'position' => 61.1,
        'redirect' => true,
        'icon_url' => 'dashicons-admin-customizer',
        'update_button' => 'Save options',
        'updated_message' => 'Options saved',
    ));

}

add_action('acf/init', 'add_acf_menu_pages');
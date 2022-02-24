<?php


function capitaine_rewrite_url() {
    
    add_rewrite_tag( '%form_style%','([^&]+)');
    add_rewrite_tag( '%form_couleur%','([^&]+)');
    add_rewrite_tag( '%form_religion%' ,'([^&]+)');
    add_rewrite_tag( '%form_type%','([^&]+)');
    add_rewrite_tag( '%form_granit%','([^&]+)');
    add_rewrite_tag( '%form_prix%' ,'([^&]+)');
    
    add_rewrite_rule(
      'catalogue/([^/]+)/([^/]+)/([^/]+)/([^/]+)/([^/]+)/([^/]+)',
      'index.php?pagename=catalogue&form_style=$matches[1]&form_couleur=$matches[2]&form_religion=$matches[3]&form_type=$matches[4]&form_granit=$matches[5]&form_prix=$matches[6]',
      'top'
    );
}
add_action( 'init', 'capitaine_rewrite_url' );
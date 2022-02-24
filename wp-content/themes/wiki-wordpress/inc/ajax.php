<?php

//filter post by cat
add_action('wp_ajax_nopriv_delete_subject_wiki','delete_subject_wiki');
add_action('wp_ajax_delete_subject_wiki','delete_subject_wiki');

function delete_subject_wiki(){
$subject_id = $_POST["post_id"];
wp_delete_post($subject_id);
echo 'success';
die;
}

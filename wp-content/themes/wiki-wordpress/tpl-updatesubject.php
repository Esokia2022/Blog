<?php
    /**
     *  Template Name: modifier-un-sujet
     */
if(isset($_GET['id'])): 
    $id = $_GET['id'];
    //echo $id;
    $post = get_post($id);
    // echo '<pre>';
    // print_r($post);
    // echo '</pre>';
    $term_list = wp_get_post_terms($id, 'category');
    // echo '<pre>';
    // print_r($term_list);
    // echo '</pre>';
    $term_per_post = array_map(function($term){
        return $term->term_id;
    }, $term_list);
endif;



$error = false;
$success = false;
$commentaire = 'closed';
if(!empty($_POST)){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // die();
    if(isset($_POST['commentaire'])){
        $commentaire = 'open';
    }

    if(!empty($_POST['titre'])){
        $args = array(
            'ID' => $_POST['subjectId'],
            'post_title'    => $_POST['titre'],
            'post_content'  => $_POST['description'],
            'comment_status'=> $commentaire
        );
        $post_id = wp_update_post($args);

        $cat_ids = array_map(function($catalogue){
            return (int) $catalogue;
        }, $_POST['categorie']);
        $term_taxonomy_ids = wp_set_object_terms( $post_id, $cat_ids, 'category' );

        if(!is_wp_error($term_taxonomy_ids)){
            $success = "insertion post reussie";
        }else{
            $error = $term_taxonomy_ids->get_error_message();
        }
    }
}
?>




<?php get_header(); ?>

<div class="body-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if($error) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if($success): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="subjectId" value="<?php echo $post->ID ?>" />

                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : $post->post_title; ?>"  required/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <?php 
                            $content   = isset($post->post_content) ? $post->post_content : '';
                            $editor_id = 'description';
                            wp_editor( $content, $editor_id );
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="catalogue">Catégorie</label>
                        <select multiple class="form-control" id="categorie" name="categorie[]" required>
                            <?php
                                /*$uncategorized_name = get_term_by( 'slug', 'non-classe', 'category' );
                                $arguments = array('exclude' => array($uncategorized_name->term_id));*/
                                $category = get_terms( array('taxonomy' => 'category', 'hide_empty' => false) ); 
                            ?>
                            <?php foreach($category as $category_item): ?>
                                    <option value="<?php echo $category_item->term_id; ?>" <?php echo (in_array($category_item->term_id, $term_per_post))? 'selected':'' ?>><?php echo $category_item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-check">
                        <input type="checkbox" name="commentaire" class="form-check-input" id="commentaire" value="1" <?php echo ($post->comment_status === 'open')? 'checked':''; ?>>
                        <label class="form-check-label" for="commentaire">Autoriser les commentaires</label>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

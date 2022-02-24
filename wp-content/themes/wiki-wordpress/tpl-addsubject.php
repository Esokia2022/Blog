<?php
    /**
     *  Template Name: ajouter-un-sujet
     */
?>
<?php 
    //session_start(); 
    if(isset($_GET['id'])): 
        $id = $_GET['id'];
        //echo $id;
        $user = get_user_by('ID', $id);
        $current_slug = add_query_arg( array(), $wp->request );
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
                'post_title'    => $_POST['titre'],
                'post_type'     => 'post',
                'post_content'  => $_POST['description'],
                'post_status'   => 'publish',
                'post_author'   => $id,
                'comment_status'=> $commentaire
            );
            $post_id = wp_insert_post($args);

            $cat_ids = array_map(function($catalogue){
                return (int) $catalogue;
            }, $_POST['categorie']);
            $term_taxonomy_ids = wp_set_object_terms( $post_id, $cat_ids, 'category' );

            if(!is_wp_error($term_taxonomy_ids)){
                $success = "insertion post reussie";
                $_POST = array();
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
        <div class="col-12 mt-4 mb-4">
            
            <ul class="dashboard-menu">
                <li><a href="<?php echo bloginfo('url') ?>/profil" class="btn <?php echo ($current_slug == 'profil') ? 'active': '' ?>">Mon profl</a></li>
                <li><a href="<?php echo bloginfo('url') ?>/edit-profil?id=<?php echo $user->ID ?>" class="btn <?php echo ($current_slug == 'edit-profil') ? 'active': '' ?>">Modifier mon profil</a></li>
                <li><a href="<?php echo bloginfo('url') ?>/edit-password?id=<?php echo $user->ID ?>" class="btn <?php echo ($current_slug == 'edit-password') ? 'active': '' ?>">Changer mot de passe</a></li>
                <li><a href="<?php echo bloginfo('url') ?>/mes-sujets?id=<?php echo $user->ID ?>" class="btn <?php echo ($current_slug == 'mes-sujets') ? 'active': '' ?>">Mes sujets</a></li>
                <li><a href="<?php echo bloginfo('url') ?>/ajouter-un-sujet?id=<?php echo $user->ID ?>" class="btn <?php echo ($current_slug == 'ajouter-un-sujet') ? 'active': '' ?>">Ajouter un sujet</a></li>

            </ul>
            <h2 class="title-h2">Ajouter un sujet :</h2>
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

            
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data" class="form-add-subject">
                <div class="form-group">
                    <label for="titre">Titre :</label>
                    <input type="text" name="titre" id="titre" class="form-control" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : ''; ?>"  required/>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <?php 
                        $content   = '';
                        $editor_id = 'description';
                        wp_editor( $content, $editor_id );
                    ?>
                </div>

                <div class="form-group">
                    <label for="catalogue">Catégorie :</label>
                    <select multiple class="form-control" id="categorie" name="categorie[]" required>
                        <?php
                            /*$uncategorized_name = get_term_by( 'slug', 'non-classe', 'category' );
                            $arguments = array('exclude' => array($uncategorized_name->term_id));*/
                            $category = get_terms( array('taxonomy' => 'category', 'hide_empty' => false) ); 
                        ?>
                        <?php foreach($category as $category_item): ?>
                                <option value="<?php echo $category_item->term_id; ?>"><?php echo $category_item->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="commentaire" class="form-check-input" id="commentaire" value="1">
                    <label class="form-check-label" for="commentaire">Autoriser les commentaires</label>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </div>
            </form>

        </div>
    </div>
</div>   
</div>
<?php get_footer(); ?>


<?php
    /**
     *  Template Name: mes-sujets
     */
?>
<?php
    //session_start();
?>
<?php 
    $user = wp_get_current_user();
    // print_r($user);
    // die()
    if($user->ID == 0){
        header('location:'.site_url().'/login');
    }
    $_GET['id'] = $user->ID;
    //echo 'ici la session :'. $_GET['id'];
    $current_slug = add_query_arg( array(), $wp->request );
?>
<?php get_header(); ?>
 <!-- <pre>
<?php //print_r($user); ?>
</pre>  -->
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
            <h2 class="title-h2">Mes sujets</h2>
                <div id="message">
                </div>
                <?php 
                    $args = array(
                        'post_type' => 'post',
                        'author' => $user->ID, 
                        'posts_per_page' => -1,
                    ) ;
                    $listSubject =  get_posts( $args );
                    // echo "<pre>";
                    // print_r($listSubject);
                    // echo "</pre>";

                    if($listSubject):
                ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><strong>Titre</strong></th>
                                <th><strong>Catégorie</strong></th>
                                <th><strong>Commentaire autorisé</strong></th>
                                <th colspan="3">Actions</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($listSubject as $subject): ?>
                        <tr>
                            <td><?php echo $subject->post_title ?></td>
                            <td>
                                <?php 
                                    //Récupèrer les termes d'une publication.
                                    $term_list = wp_get_post_terms($subject->ID, 'category');
                                    // echo '<pre>';
                                    // print_r($term_list);
                                    // echo '</pre>';
                                    $nbterm = count($term_list);
                                    $i=0;
                                ?>
                                <?php foreach($term_list as $term): ?>
                                    <?php 
                                        echo $term->name; 
                                        $i++;
                                        echo ($i === $nbterm) ? '' : ', ';
                                    ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <?php echo ($subject->comment_status === 'open') ? 'Oui' : 'Non' ?>
                            </td>
                            <td><a href="<?php echo get_permalink($subject->ID) ?>" style="color:blue">Voir</a></td>
                            <td><a href="<?php echo bloginfo('url') ?>/modifier-un-sujet?id=<?php echo $subject->ID ?>" style="color:green">Modifier</a></td>
                            <td><a href="#" style="color:red" class="delete-subject" data-post-id="<?php echo $subject->ID;  ?>">Supprimer</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
        </div>
    </div>
</div>  
</div> 
<?php get_footer(); ?>


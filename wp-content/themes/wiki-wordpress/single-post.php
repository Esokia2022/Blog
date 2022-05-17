<?php get_header(); ?>
<?php 
    if( have_posts() ):				
        while( have_posts() ): the_post(); 
?>
    
    <div class="single-post-wrapper" style="margin-top:50px; margin-bottom:50px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title-post"><?php the_title(); ?></h2>
                    <div class="description">
                        <?php the_content(); ?>
                    </div>
                    <div class="commentaire-wrappers">
                        <?php comments_template();  ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php 
	endwhile;			
endif;
?>
<?php get_footer(); ?>

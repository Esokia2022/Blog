<?php

/**
 * Display the post content in "generic" or "standard" format.
 * This will be use in the loop and full page display.
 * 
 * @package bootstrap-basic4
 */


$Bsb4Design = new \BootstrapBasic4\Bsb4Design();
?>

<div class="container-fluid page-container article_container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-header">
            <?php if ('post' == get_post_type()) { ?>
                <span class="cat-article"><?php the_category(); ?></span>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } //endif; 
            ?>
            <div class="entry-date">
                    <?php gpg_posted(); ?>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <div class="search-img  full-width"><?php the_post_thumbnail('img_article',array('class' => 'full-width', 'alt' => get_the_title())); ?></div>
            <?php endif; ?>
        </div><!-- .entry-header -->
        <?php if (is_search()) { // Only display Excerpts for Search 
        ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
                <div class="clearfix"></div>
            </div><!-- .entry-summary -->
        <?php } else { ?>
            <div class="entry-content">
                <?php the_content($Bsb4Design->continueReading(true)); ?>
                <div class="clearfix"></div>
                <?php
                /**
                 * This wp_link_pages option adapt to use bootstrap pagination style.
                 */
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic4') . ' <ul class="pagination">',
                    'after'  => '</ul></div>',
                    'separator' => ''
                ));
                ?>
            </div><!-- .entry-content -->
            <!-- <div class="author_post">
                <?php
                //the_author();
                ?>
            </div> -->

        <?php } //endif; 
        ?>

    </article><!-- #post-## -->
</div>
<?php unset($Bsb4Design); ?>
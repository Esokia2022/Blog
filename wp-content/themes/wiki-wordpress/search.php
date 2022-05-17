<?php
/** 
 * The search template.
 * Custome
 * Use for display author archive, category, custom post archive, custom taxonomy archive, tag, date archive.<br>
 * These archive can override by each archive file name such as category will be override by category.php.<br>
 * To learn more, please read on this link. https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
$months = array(
    "01" => "Janvier",
    "02" => "Février",
    "03" => "Mars",
    "04" => "Avril",
    "05" => "Mai",
    "06" => "Juin",
    "07" => "Juillet",
    "08" => "Août",
    "09" => "Semptembre",
    "10" => "Octobre",
    "11" => "Novembre",
    "12" => "Decembre"
);
get_header(); ?> 
<div class="body-content-wrapper">
	<div class="container">
		<div class="row">
            <div class="col-12">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="page-search">
                        <div class="page-title-subtitle">
                            <h1 class="header_title">Résultats de la recherche sur : <?php the_search_query(); ?></h1>
                        </div>

                        <?php if (have_posts()) { ?> 
                        <div class="content_liste_article">
                            <?php
                                while (have_posts()) {
                                    the_post();
                                    get_template_part('template-parts/posts/content','search');
                                } 
                                wp_reset_query();
                            ?>
                            <div class="pagination-wrapper">
                                <?php the_posts_pagination(); ?>
                            </div>
                        </div>
                        <?php
                        } else {
                            get_template_part('no-results');  
                        }
                        ?> 
                    </div>
                </article>
            </div>
		</div>
	</div>
</div>
<?php get_footer();?>
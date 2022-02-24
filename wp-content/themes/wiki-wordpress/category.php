<?php 
get_header(); 
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
?>

<div class="body-content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-9">
                <?php if (have_posts()) : ?>
                    <div class="post-listing" style="padding:50px 0;">
                        <?php while(have_posts()) : the_post();?>
                            <div class="post-item" style="margin-bottom:30px">
                                <h3 class="post-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="card-date-terms">
                                        <span class="card-date">Publié le <?php echo get_the_date('d').' '. $months[(string)get_the_date('m')].' '.get_the_date('Y') ?></span> par <span><?php the_author() ?></span>
                                    </div>
                                    <div class="post-item-description">
                                        <?php truncate_txt(get_the_content()); ?>
                                    </div>
                                    <div class="post-item-category">
                                        Publié dans <span class="card-terms"><?php the_terms(get_the_ID(), 'category'); ?></span>
                                    </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <div class="pagination-wrapper" style="margin-bottom:25px">
                    <?php the_posts_pagination(); ?>
                </div>
			</div>
            <div class="col-3 post-category">
            <h4>Categories</h4>
            <?php 
                //$category = get_terms(['taxonomy' => 'category']);
                $curTerm = $wp_query->queried_object;
                $category = get_terms( array( 'category')); 
            ?>
            <ul class="nav nav-pills">
                <?php foreach($category as $category_item): ?>

                    <?php
                        $classes = array();
                        if ( $category_item->name == $curTerm->name ) {
                            $classes[] = 'active';
                        }
                    ?>

                    <li class="nav-item <?php echo implode( ' ', $classes ) ?>">
                        <a href="<?php echo get_term_link($category_item) ?>" class="nav-link"><?php echo $category_item->name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            </div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
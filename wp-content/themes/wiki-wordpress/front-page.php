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
    $sticky = get_option('sticky_posts');
?>
<div class="body-content-wrapper">
    <section class="hp-recente-post">
        <div class="container">   
            <?php
                $recentPosts = new WP_Query();
                $args = array(
                    'post__in' => $sticky,
                    'orderby' => 'date',
                    'is_paged'          => false,
                    'showposts' => 3,
                    'caller_get_posts' => 3,
                );
                $recentPosts->query($args);
            ?>
            <?php if ($recentPosts->have_posts()) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="title-h2">A la une</div>
                    </div>
                </div>
                <div class="row row-recente-post">
                    <?php while($recentPosts->have_posts()) : $recentPosts->the_post();?>
                        <div class="col-sm-4 recente-post-item">
                            <div class="card" style="width: 100%">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <div class="card-date-terms">
                                        <span class="card-date">Publié le <?php echo get_the_date('d').' '. $months[(string)get_the_date('m')].' '.get_the_date('Y') ?></span> - <span class="card-terms"><?php the_terms(get_the_ID(), 'category'); ?></span>
                                    </div>
                                    <p class="card-text">
                                        <?php truncate_txt(get_the_content(), 100); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="hp-recente-post">
        <div class="container">   
            <?php
                $args = array(
                        'is_paged'          => false,
                        'post_type'         => 'post',
                        'posts_per_page'    => 3,
                        'post_status'       => 'publish',
                        'order'             => 'DESC',
                        'suppress_filters'  => true,
                        'post__not_in'      => $sticky
                );
                $loop = new WP_Query($args);
            ?>
            <?php if ($loop->have_posts()) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="title-h2">Post récent</div>
                    </div>
                </div>
                <div class="row row-recente-post">
                    <?php while($loop->have_posts()) : $loop->the_post();?>
                        <div class="col-sm-4 recente-post-item">
                            <div class="card" style="width: 100%">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <div class="card-date-terms">
                                        <span class="card-date">Publié le <?php echo get_the_date('d').' '. $months[(string)get_the_date('m')].' '.get_the_date('Y') ?></span> - <span class="card-terms"><?php the_terms(get_the_ID(), 'category'); ?></span>
                                    </div>
                                    <p class="card-text">
                                        <?php truncate_txt(get_the_content(), 100); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php get_footer();?> 
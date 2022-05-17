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



 

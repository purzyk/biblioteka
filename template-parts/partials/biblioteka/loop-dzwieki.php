<?php

$the_query = new WP_Query(array(
	'post_type' => 'dzwieki',
	'posts_per_page' => 1,
	'orderby' => 'date',
	'order' => 'DESC'
));

$a = 0;
if ( $the_query->have_posts() ) : ?>
<div class="blogi_carousel">
	
	<?php $a=0; while ( $the_query->have_posts() ) : $the_query->the_post(); $a++;
    
    $categories = get_terms('dzwieki-kategorie'); 
    $term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array( "fields" => "all" ));
    $terms = get_the_terms($post->ID, 'autor');
    ?>
		
<?php /*
    <article class="row custom-type-1">

        <div class="col-md-6">
            <a class="post-url" href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'blog' ); ?> </a>
        </div>

        <div class="col-md-6">
        <span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
        <h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>

        <?php      
        if ($terms)
        {
            foreach($terms as $term)
            {
            ?>
                <span class="imie"><?php echo the_field('imie', $term); ?> <span class="nazwisko"><?php echo the_field('nazwisko', $term); ?></span></span>
            <?php
            }
        } 
        ?>
        </div>
    </article>
	*/ ?>
	    <article class="col-md-11 col-md-offset-1 custom-type-1">
           
        <a href="<?php the_permalink();?>">
            <?php get_template_part( 'template-parts/img', 'small' ); ?>
        </a>
        
        <span class="category lato-font center"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
        
        <h4 class="center"><a class="post-url" href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>
        <?php
        
        if($terms)
        {
            foreach( $terms as $term )
            {
            ?>
            
            <span class="imie center"><?php echo the_field('imie', $term);?> <span class="nazwisko center"><?php echo the_field('nazwisko', $term);?></span></span>
            
            <?php
            }
        }
        ?>
        <a href="<?php the_permalink();?>"> <?php the_excerpt(); ?> </a>
        <span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
        
    </article>
    <div class="clearfix"></div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>
<?php endif; ?>
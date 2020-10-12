<?php
$featured_posts = get_field('dzwieki');

if( $featured_posts ): ?>
<div class="col-md-11 col-md-offset-1 custom-type-1">
<div class="js-dzwieki">
	
<?php foreach( $featured_posts as $post ): 
    setup_postdata($post); 
    
    $categories = get_terms('dzwieki-kategorie'); 
    $term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array( "fields" => "all" ));
    $terms = get_the_terms($post->ID, 'autor');
    ?>		

	    <article>
           
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
    <?php endforeach; ?>
    <?php wp_reset_postdata(); ?>
</div>
</div>
<?php endif; ?>
<script>
$('.js-dzwieki').slick({
    infinite: true,
    dots: false,
});
</script>
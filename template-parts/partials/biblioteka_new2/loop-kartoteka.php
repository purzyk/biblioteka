<?php
$featured_posts = get_field('kartoteka_25');
if( $featured_posts ): ?>
<div class="col-md-11 col-md-offset-1 custom-type-1">
<div class="row js-kartoteka">
    <?php
    foreach( $featured_posts as $post ):
        setup_postdata($post); 
//    $term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all")); 
    $terms = get_the_terms( $post->ID , 'autor' );
    ?>

    <article >
           
        <a href="<?php the_permalink();?>">
            <?php get_template_part( 'template-parts/img', 'small' ); ?>
        </a>    
        
        <h4><a class="post-url" href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>

        <a href="<?php the_permalink();?>"> <?php the_excerpt(); ?> </a>
        <span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
        
    </article>
    <?php  endforeach; ?>
    <?php wp_reset_postdata(); ?>
</div>
</div>
<?php endif; ?>
<script>
$('.js-kartoteka').slick({
    infinite: true,
    dots: false,
});
</script>
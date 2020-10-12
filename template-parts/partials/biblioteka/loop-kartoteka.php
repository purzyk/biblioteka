<?php
$the_query = new WP_Query(array(
	'post_type' => 'recenzje',
	'posts_per_page' => 1
));

if ( $the_query->have_posts() ) : ?>
<div class="row">
    <?php
    while ( $the_query->have_posts() ) : $the_query->the_post();
    $term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all")); 
    $terms = get_the_terms( $post->ID , 'autor' );
    ?>

    <article class="col-md-11 col-md-offset-1 custom-type-1">
           
        <a href="<?php the_permalink();?>">
            <?php get_template_part( 'template-parts/img', 'small' ); ?>
        </a>
        
        <span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
        
        <h4><a class="post-url" href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>
        <?php
        
        if($terms)
        {
            foreach( $terms as $term )
            {
            ?>
            
            <span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
            
            <?php
            }
        }
        ?>
        <a href="<?php the_permalink();?>"> <?php the_excerpt(); ?> </a>
        <span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
        
    </article>
    <div class="clear"></div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>
<?php endif; ?>
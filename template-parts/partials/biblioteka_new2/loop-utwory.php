<?php
$featured_posts = get_field('utwory');
$i = 0;
if( $featured_posts ): ?>
<div class="row">
<?php ++$i; foreach( $featured_posts as $post ): 
    setup_postdata($post); 
    ?>

    <article class="col-md-6 custom-type-1">
    
        <?php 
        $term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
        $categories = get_terms('utwory-kategorie');?>

        <a class="post-url" href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?> </a>
        
        <span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
        
        <h4 class="white"><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>
        
        <?php
        $terms = get_the_terms( $post->ID , 'autor' );
        if($terms)
        {
            foreach( $terms as $term )
            {
            ?>
                <span class="white imie"><?php echo the_field('imie', $term);?> <span class="white nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
            <?php
            }
        }
        ?>
        <a href="<?php the_permalink();?>"> <?php the_excerpt(); ?> </a>
        <span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
    </article>
    <?php if ( $i == 2 ) : ?>
    <div class="clearfix"></div>
    <?php endif; ?>
    <?php endforeach; ?>

    <?php wp_reset_postdata(); ?>
</div>
<?php endif; ?>
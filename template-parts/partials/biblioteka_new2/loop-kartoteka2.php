<?php
$featured_posts = get_field('kartoteka_25');

if( $featured_posts ): ?>
<div class="row kartoteka25">
    <!-- Wrapper for slides -->
        <div class="js-wywiady">
           
        <?php foreach( $featured_posts as $post ): 
 setup_postdata($post); 
            
                $term_list = wp_get_post_terms($post->ID, 'kartoteka_25-kategorie', array("fields" => "all"));
            
            
            ?>
            <div class="item <?php echo $active; ?>">
                <article <?php post_class(); ?>>
                    
                    <?php if ( has_post_thumbnail() ) {
the_post_thumbnail('bl_kartoteka');
} else { ?>
<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-950x430.jpg" alt="<?php the_title(); ?>" />
<?php } ?>
                        <div class="reveal">
                            <div class="reveal_outer">
                                <div class="reveal_inner">
                                <a href="<?php echo get_term_link($term_list[0]->term_id); ?>"> <span class="category"><?php echo $term_list[0]->name; ?></span></a>
                                    <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    
                </article>
            </div>
            <?php  endforeach; ?>
        <?php wp_reset_postdata(); ?>
        
        </div>
</div>
<?php endif; ?>
<script>
$('.js-wywiady').slick({
    infinite: true,
    dots: false,
});
</script>
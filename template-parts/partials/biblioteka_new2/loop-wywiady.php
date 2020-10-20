<?php
$featured_posts = get_field('wywiady');

if( $featured_posts ): ?>
<div class="row">
    <!-- Wrapper for slides -->
        <div class="js-wywiadyOld">
           
        <?php foreach( $featured_posts as $post ): 
 setup_postdata($post); 
            $categories = get_terms('wywiady-kategorie');
            $term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array( "fields" => "all" ));
            ?>
            <div class="item <?php echo $active; ?>">
                <article <?php post_class(); ?>>
                    <a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'large' ); ?>
                        <div class="reveal">
                            <div class="reveal_outer">
                                <div class="reveal_inner">
                                    <span class="category"><?php echo $term_list[0]->name; ?></span>
                                    <h4><?php the_title(); ?></h4>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
            <?php  endforeach; ?>
        <?php wp_reset_postdata(); ?>
        
        </div>
</div>
<?php endif; ?>
<script>
$('.js-wywiadyOld').slick({
    infinite: true,
    dots: false,
});
</script>
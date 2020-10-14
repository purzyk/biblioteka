<?php
$featured_posts = get_field('kartoteka_25');

if( $featured_posts ): ?>
<div class="row">
    <!-- Wrapper for slides -->
        <div class="js-wywiady">
           
        <?php foreach( $featured_posts as $post ): 
 setup_postdata($post); 
            if ($post->post_type == "wywiady") {
                $term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "recenzje") {
                $term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "debaty") {
                $term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "felietony") {
                $term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "dzwieki") {
                $term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "nagrania") {
                $term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
            } 
            if ($post->post_type == "zdjecia") {
                $term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
            }
            if ($post->post_type == "utwory") {
                $term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
            }
            
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
$('.js-wywiady').slick({
    infinite: true,
    dots: false,
});
</script>
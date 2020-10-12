<?php
$featured_posts = get_field('cykle');

if( $featured_posts ): ?>


    <div class="js-cykle">
        
        <?php $i=0; foreach( $featured_posts as $post ):
        setup_postdata($post); 
        $categories = get_terms('felietony-kategorie'); 
        $term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array( "fields" => "all" ));
        $tags = wp_get_post_terms($post->ID, 'cykle-nazwy');
        $terms = get_the_terms($post->ID, 'autor');
        ?>
        <div class="item">
            <article class="row custom-type-1">

                <div class="col-md-6">
                    <a class="post-url" href="<?php the_permalink(); ?>"><?php get_template_part('template-parts/img', 'small'); ?></a>  
                </div>

                <div class="col-md-5">   
                    <h4>
                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                    </h4>
                    <a href="<?php the_permalink(); ?>"> <?php the_excerpt(); ?> </a>
                    <span class="wiecej"><a href="<?php the_permalink(); ?>">WIĘCEJ</a></span>
                </div>    

            </article>
        </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    </div>  

<?php endif; ?>
<script>
$('.js-cykle').slick({
    infinite: true,
    dots: false,
});
</script>
<?php
$featured_posts = get_field('debaty');

if( $featured_posts ): ?>


    <div class="js-debaty">
       
        <?php 
        
        foreach( $featured_posts as $post ): 
            setup_postdata($post); 
        $categories = get_terms('debaty-kategorie'); 
        $term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array( "fields" => "all" ));
        $tags = wp_get_post_terms($post->ID, 'debaty-glosy-kategorie');
        $terms = get_the_terms($post->ID, 'autor');
        $col_md_5 = ( count($featured_posts) == 1 ) ? 'col-md-6' : 'col-md-5';
        ?>
        <div class="item <?php echo $active; ?>">
            <article class="row custom-type-1">

                <div class="col-md-6">
                    <a class="post-url" href="<?php the_permalink(); ?>"><?php get_template_part('template-parts/img', 'small'); ?></a>  
                </div>

                <div class="<?php echo $col_md_5; ?>">
                    <span class="kategoria_debaty">
                        <a href="https://www.biuroliterackie.pl/biblioteka/debaty/<?php echo $tags[0]->slug; ?>"><?php echo $tags[0]->name; ?></a>
                    </span>

                    <h4>
                        <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                    </h4>

                    <span class="debaty_span">

                    <span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>

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
                    </span>
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
$('.js-debaty').slick({
    infinite: true,
    dots: false,
});
</script>
<?php
$the_query = new WP_Query( array( 
    'post_type' => 'debaty',
    'posts_per_page' => 20,
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_key' => 'glos',
    'meta_value' => 'debata'
));

if ( $the_query->have_posts() ) : ?>
<h6><span>Nasze debaty</span></h6>

<div class="typ_small">
    <div class="archwiumtop_carousell">
        <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
        $terms = get_the_terms($post->ID, 'autor');
        ?>

        <article>
            <a href="<?php the_permalink();?>">
                <?php get_template_part( 'template-parts/img', 'small' ); ?>

                <div class="reveal"> 
                    <h4><?php echo get_the_title(); ?></h4>
                    
                    <?php      
                    if ($terms)
                    {
                        foreach($terms as $term)
                        {
                        ?>
                            <h5><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></h5>
                        <?php
                        }
                    } 
                    ?>
                    
                </div>
            </a>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>
<?php endif; ?>
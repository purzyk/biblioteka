<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => 'debaty','posts_per_page' => 1) ), 'post_date' );

$the_query = new WP_Query(array(
	'post_type' => 'debaty',
	'orderby' => 'date',
	'order' => 'DESC',
    'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    ),
));

if ($the_query->have_posts()) : ?>

<div id="carousel-debaty" class="carousel-biblioteka carousel slide" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner" role="listbox">
       
        <?php 
        $i = 0; while ($the_query->have_posts()) : $the_query->the_post();
        $active = ($i == 0) ? 'active' : ""; 
        $categories = get_terms('debaty-kategorie'); 
        $term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array( "fields" => "all" ));
        $tags = wp_get_post_terms($post->ID, 'debaty-glosy-kategorie');
        $terms = get_the_terms($post->ID, 'autor');
        $col_md_5 = ( count($the_query) == 1 ) ? 'col-md-6' : 'col-md-5';
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
        <?php ++$i; endwhile; ?>
        <?php wp_reset_postdata(); ?>

    </div>
    
    <?php if ( $the_query->post_count > 1 ) : ?>
    <!-- Controls -->
    <a class="right carousel-control" href="#carousel-debaty" role="button" data-slide="next">
        <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/next_2.png" />
    </a>
    <?php endif; ?>
    
</div>
<?php endif; ?>
<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => 'wywiady','posts_per_page' => 1) ), 'post_date' );

$the_query = new WP_Query(array(
	'post_type' => 'wywiady',
    'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    ),
));

//if (is_user_logged_in())
//{
//    var_dump($the_query);
//}

if ( $the_query->have_posts() ) : ?>
<div class="row">
    <div id="carousel-wywiady" class="carousel-biblioteka col-xs-12 carousel slide" data-ride="carousel" data-interval="10000">
        <?php /**
        <!-- Indicators -->
        <ol class="carousel-indicators biblioteka-carousel-indicators carousel-indicators-numbers">
            <?php
            $i = 0;
            while ($the_query->have_posts()) : $the_query->the_post();
            $active = ($i == 0) ? 'class="active"' : ""; ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php echo $active; ?>><?php echo $i+1; ?></li>
            <?php ++$i; endwhile; wp_reset_postdata(); ?>
        </ol>
        */ ?>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
           
        <?php $i = 0; while ($the_query->have_posts()) : $the_query->the_post();
            $active = ($i == 0) ? 'active' : ""; 
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
        <?php ++$i; endwhile; ?>
        <?php wp_reset_postdata(); ?>
        
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-wywiady" role="button" data-slide="prev">
            <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/prev_2.png" />
        </a>
        <a class="right carousel-control" href="#carousel-wywiady" role="button" data-slide="next">
            <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/next_2.png" />
        </a>
    </div>
</div>
<?php endif; ?>
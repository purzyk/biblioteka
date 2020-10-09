<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => 'nagrania','posts_per_page' => 1) ), 'post_date' );

$the_query = new WP_Query(array(
	'post_type' => 'nagrania',
	'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    ),
));

$total = $the_query->post_count;
?>

<?php if ( $the_query->have_posts() ) : ?>
<div id="carousel-nagrania" class="carousel-biblioteka col-xs-12 carousel slide" data-ride="carousel">

    <div class="carousel-inner" role="listbox">

        <?php $i = 0; while ($the_query->have_posts()) : $the_query->the_post();
            $active = ($i == 0) ? 'active' : ""; 
            $term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array( "fields" => "all" ));
            $terms = get_the_terms($post->ID, 'autor');
            ?>
            <div class="item <?php echo $active; ?>">
                <article class="row custom-type-1">
                    <?php get_template_part( 'template-parts/img', 'large' ); ?>
                    <div class="reveal rec_nagr">
                        <div class="inner_black">
                            <div class="black_tran">
                                <div class="aaa">                                   
                                    <span class="category">
                                        <a class="cat_lin" href="<?php echo get_term_link($term_list[0]->term_id); ?>"><b><?php echo $term_list[0]->name; ?></b></a>
                                    </span>
                                    <h4><a class="post-url" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>

                                    <?php if($terms): foreach( $terms as $term ) : ?>
                                    <span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article> 
            </div>
        <?php ++$i; endwhile; ?>
        <?php wp_reset_postdata(); ?>

    </div>

    <?php if ( $total > 1 ) : ?>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-nagrania" role="button" data-slide="prev">
        <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/prev_2.png" />
    </a>
    <a class="right carousel-control" href="#carousel-nagrania" role="button" data-slide="next">
        <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/next_2.png" />
    </a>
    <?php endif; ?>

</div>
<?php endif; ?>
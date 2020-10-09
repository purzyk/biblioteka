<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => 'zdjecia','posts_per_page' => 1) ), 'post_date' );

$post_ids = wp_list_pluck( get_posts( array(
    'post_type' => 'zdjecia',
    'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    )
)), 'ID' );

//echo $post_ids[0];

if ( !empty($post_ids) ) : ?>
<div id="carousel-zdjecia" class="row carousel-biblioteka carousel slide" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner" role="listbox">
    
    <?php
    $i = 0; foreach ( array_chunk($post_ids, 2) as $two_posts ) :
    $active = ($i == 0) ? 'active' : ""; ?>
    <div class="item <?php echo $active; ?>">
        <?php
        $the_query = new WP_Query( array( 'post_type' => 'zdjecia', 'post__in' => $two_posts ) );
        while ($the_query->have_posts()) : $the_query->the_post();

        $term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array( "fields" => "all" ));
        $terms = get_the_terms($post->ID, 'autor'); ?>
            <article class="col-md-6 custom-type-1">

                <a href="<?php echo get_the_permalink(); ?>">
                    <?php get_template_part( 'template-parts/img', 'small' ); ?>
                </a>

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
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php ++$i; endforeach; ?>
    </div>
    
    <?php if ( count($post_ids) > 2 ) : ?>
    <!-- Controls -->
    <a class="right carousel-control" href="#carousel-zdjecia" role="button" data-slide="next">
        <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/next_2.png" />
    </a>
    <?php endif; ?>
    
</div>
<?php endif; ?>
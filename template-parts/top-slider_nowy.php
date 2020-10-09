<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),'posts_per_page' => 1) ), 'post_date' );

$the_query = new WP_Query(array(
	'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
    'orderby' => 'date',
    'order' => 'desc',
	'posts_per_page' => -1,
    'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    ),
));

if ( $the_query->have_posts() ) : ?>
<section class="biblioteka-top">
    <div class="row">
        <div id="carousel-top" class="carousel-biblioteka col-xs-12 carousel slide" data-ride="carousel" data-interval="20000">
        
        <div class="carousel-inner" role="listbox">
           
            <?php
            $i = 0; while ( $the_query->have_posts() ) : $the_query->the_post();
            
            $active = ($i == 0) ? 'active' : ""; 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'bl_1645x600' );
            $terms = get_the_terms( $post->ID , 'autor' );
            
            ?>
            <div class="item <?php echo $active; ?>">
                <article>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo $image[0]; ?>">
                    </a>
                    
                    <div class="info">
                        <div class="cat"><span>
                            <?php 
                            if ($post->post_type == "wywiady") {
                                $term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
                                echo 'wywiady';
                            }
                            if ($post->post_type == "recenzje") {
                                $term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
                                echo 'recenzje';
                            }
                            if ($post->post_type == "debaty") {
                                $term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
                                echo 'debaty';
                            }
                            if ($post->post_type == "felietony") {
                                $term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
                                echo 'cykle';
                            }
                            if ($post->post_type == "dzwieki") {
                                $term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
                                echo 'dźwięki';
                            }
                            if ($post->post_type == "nagrania") {
                                $term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
                                echo 'nagrania';
                            }
                            if ($post->post_type == "zdjecia") {
                                $term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
                                echo 'zdjęcia';
                            }
                            if ($post->post_type == "utwory") {
                                $term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
                                echo 'utwory';
                            }
                            ?>
                            </span></div>
                        
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title();?></a>
                        <?php if($terms) : ?>
                            <span class="imie">
                            <?php foreach( $terms as $term ) : ?>
                                <?php echo the_field('imie', $term);?> <?php echo the_field('nazwisko', $term);?>
                            <?php endforeach; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                </article>
            </div>
            <?php ++$i; endwhile; wp_reset_postdata(); ?>
        </div>
        
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-top" role="button" data-slide="prev">
            <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/prev_2.png" />
        </a>
        <a class="right carousel-control" href="#carousel-top" role="button" data-slide="next">
            <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/next_2.png" />
        </a>
        
        </div>
    </div>
</section>
<?php endif; ?>
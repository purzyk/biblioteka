<?php
$queried_object = get_queried_object();

$args_1 = array(
    'post_type'  => 'ksiazki_lista',
	'posts_per_page'=> 1,
    'meta_key' => 'views',
	'orderby' => 'meta_value_num',
	'order' => 'DESC'
);

$args_9 = array(
    'post_type'  => 'ksiazki_lista',
	'posts_per_page'=> 9,
    'offset' => 1,
    'meta_key' => 'views',
	'orderby' => 'meta_value_num',
	'order' => 'DESC'
);

if ( is_tax( 'ksiazki_litera' ) || is_tax( 'ksiazki_serie' ) || is_tax( 'ksiazki_lista_kategorie' ) )
{
    $args_1['tax_query'] = array(
        array(
            'taxonomy' => $queried_object->taxonomy,
            'field'    => 'term_id',
            'terms'    => $queried_object->term_id
        )
    );
    $args_9['tax_query'] = array(
        array(
            'taxonomy' => $queried_object->taxonomy,
            'field'    => 'term_id',
            'terms'    => $queried_object->term_id
        )
    );
}
    
$top_1 = new WP_Query( $args_1 );
$top_9 = new WP_Query( $args_9 ); ?>

<?php if ( $top_1->have_posts() ) : ?>
<div class="ksiazki_lista-popularne row">
    <div class="col-xs-12">
        <?php // TOP 1
            while ( $top_1->have_posts() ) : $top_1->the_post();

            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_ksiazka2');
            $image_url = $image_url[0]; 

            $imie = get_field('imie');
            $nazwisko = get_field('nazwisko');
            ?>

            <div class="top-1 col-xs-12 col-md-3">
                <h3 class="lato-font"><?php _e( 'najpopularniejsze', 'biblioteka' ); ?></h3>
                <a href="<?php the_permalink(); ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                </a>
                <a class="playfair-display" href="<?php the_permalink(); ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                   <div class="imie"><?php echo $imie ? $imie : ""; ?> <?php echo $nazwisko ? mb_strtoupper($nazwisko, 'UTF-8') : ""; ?></div>
                   <div class="tytul"><?php the_title(); ?></div> 
                </a>
            </div>

        <?php 
            endwhile;
            wp_reset_postdata();
        ?>
        
        <?php // TOP 9 ?>
        <?php if ( $top_9->have_posts() ) : ?>
            <div class="col-xs-12 col-md-9 top-9">
                <?php
                $i = 1;
                while ( $top_9->have_posts() ) : $top_9->the_post();
                
                $imie = get_field('imie');
                $nazwisko = get_field('nazwisko');
                $border = $i > 3 ? "border-top" : "";
                
                ?>
                <style>
                    .ksiazki_lista-popularne .top-9 > div > .b-<?php echo $i+1; ?>:before {
                        content: "<?php echo $i+1; ?>";
                    }
                </style>
                <div class="col-xs-7 col-xs-offset-3 col-sm-4 col-sm-offset-0">
                    <a class="b-<?php echo $i+1; ?> playfair-display <?php echo $border; ?>" href="<?php the_permalink(); ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                        <div><?php echo $imie ? $imie : ""; ?> <?php echo $nazwisko ? mb_strtoupper($nazwisko, 'UTF-8') : ""; ?></div>
                        <div><?php the_title(); ?></div> 
                    </a>
                </div>
                
                <?php if ( $i % 3 == 0 ) : ?>
                    <div class="clearfix"></div>
                <?php endif; ?>
                    
                <?php 
                ++$i; endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>
<?php endif; ?>
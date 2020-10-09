<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_wywiady = 0;
// arguments
$args = array(
'post_type' => 'wywiady',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_wywiady ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_wywiady>0){?><a href="https://www.biuroliterackie.pl/biblioteka/wywiady/?autor=<?php echo $serach_term_slug; ?>">WYWIADY <span>(<?php echo $count_wywiady; ?>)</a><?php } else {?> WYWIADY <span>(0) <?php } ?></span> </span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_recenzje = 0;
// arguments
$args = array(
'post_type' => 'recenzje',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_recenzje ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_recenzje>0){?><a href="https://www.biuroliterackie.pl/biblioteka/recenzje/?autor=<?php echo $serach_term_slug; ?>">RECENZJE <span>(<?php echo $count_recenzje; ?>)</a><?php } else {?> RECENZJE <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_ksiazki = 0;
// arguments
$args = array(
'post_type' => 'ksiazki',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_ksiazki ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_ksiazki>0){?><a href="https://www.biuroliterackie.pl/biblioteka/ksiazki/?autor=<?php echo $serach_term_slug; ?>">KSIĄŻKI <span>(<?php echo $count_ksiazki; ?>)</a><?php } else {?> KSIĄŻKI <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_utwory = 0;
// arguments
$args = array(
'post_type' => 'utwory',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_utwory ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_utwory>0){?><a href="https://www.biuroliterackie.pl/biblioteka/utwory/?autor=<?php echo $serach_term_slug; ?>">UTWORY <span>(<?php echo $count_utwory; ?>)</a><?php } else {?> UTWORY <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_debaty = 0;
// arguments
$args = array(
'post_type' => 'debaty',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_debaty ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_debaty>0){?><a href="https://www.biuroliterackie.pl/biblioteka/debaty/?autor=<?php echo $serach_term_slug; ?>">DEBATY <span>(<?php echo $count_debaty; ?>)</a><?php } else {?> DEBATY <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_felietony = 0;
// arguments
$args = array(
'post_type' => 'felietony',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_felietony ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_felietony>0){?><a href="https://www.biuroliterackie.pl/biblioteka/cykle/?autor=<?php echo $serach_term_slug; ?>">CYKLE <span>(<?php echo $count_felietony; ?>)</a><?php } else {?> CYKLE <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_dzwieki = 0;
// arguments
$args = array(
'post_type' => 'dzwieki',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_dzwieki ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_dzwieki>0){?><a href="https://www.biuroliterackie.pl/biblioteka/dzwieki/?autor=<?php echo $serach_term_slug; ?>">DŻWIĘKI <span>(<?php echo $count_dzwieki; ?>)</a><?php } else {?> DŻWIĘKI <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_nagrania = 0;
// arguments
$args = array(
'post_type' => 'nagrania',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_nagrania ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_nagrania>0){?><a href="https://www.biuroliterackie.pl/biblioteka/nagrania/?autor=<?php echo $serach_term_slug; ?>">NAGRANIA <span>(<?php echo $count_nagrania; ?>)</a><?php } else {?> NAGRANIA <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
<?php 
global $wp_query; $serach_term = $wp_query->get_queried_object()->term_id; $serach_term_slug = $wp_query->get_queried_object()->slug;
$count_zdjecia = 0;
// arguments
$args = array(
'post_type' => 'zdjecia',
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $serach_term
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();
 $count_zdjecia ++;
?>
<?php
endwhile;
endif;
// Reset Post Data
?>
<span class="counter"><?php if ($count_zdjecia>0){?><a href="https://www.biuroliterackie.pl/biblioteka/zdjecia/?autor=<?php echo $serach_term_slug; ?>">ZDJĘCIA <span>(<?php echo $count_zdjecia; ?>)</a><?php } else {?> ZDJĘCIA <span>(0) <?php } ?></span></span>
<?php
wp_reset_postdata();
?>
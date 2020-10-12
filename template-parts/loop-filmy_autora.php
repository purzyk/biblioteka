
<?php

// The Query
$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
$count_wywiady = 0;
// arguments
$args = array(
'post_type' => 'nagrania',
'post_status' => 'publish',
'orderby' => 'date',
'order' => 'desc',
'posts_per_page' => -1, // you may edit this number
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $custom_taxterms
    )
),
'post__not_in' => array ($post->ID),
);
$related_items = new WP_Query( $args );


// The Loop
if ($related_items->have_posts()) {
	echo '<div class="teksty_autora">';
	
	while ( $related_items->have_posts() ) {
		echo '<article class="typ_1">';
		$related_items->the_post();
		$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		$categories = get_terms('nagrania-kategorie');?>
		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?> </a><?php
		echo '<h4>' . get_the_title() . '</h4>';?>
		<span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
		<?php
		$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}
		the_excerpt(); ?>
			<span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
		<?php
		echo '</article>';
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
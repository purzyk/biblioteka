<?php

// The Query
$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
$count_wywiady = 0;
// arguments
$args = array(
	'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
'order' => 'desc',
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
if ( $related_items->have_posts() ) {
	echo '<div class="teksty">';
	
	while ( $related_items->have_posts() ) {
		echo '<article class="typ_1">';
		$related_items->the_post();
		 ?>
		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?> </a><?php
		echo '<h4>' . get_the_title() . '</h4>';
		if ($post->post_type == "wywiady") {
$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">wywiady / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">recenzje / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">debaty / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">felietony / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">dzwieki / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">nagrania / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">zdjecia / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">utwory / <b>'.$term_list[0]->name.'</b></a></span>';
} ?>
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
<h6><span>ostatnio w bibliotece</span></h6>
<?php

// The Query
$the_query = new WP_Query( array( 
    'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
    'orderby '=> 'date',
    'order' => 'DESC',
    'posts_per_page' => 10
));

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="typ_small"><div class="archwiumtop_carousell">';
	
	while ( $the_query->have_posts() ) { 
$the_query->the_post();
		?>

		<article><a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'small' ); ?>
		<div class="reveal"> <?php
$categories = get_terms('recenzje-kategorie');?>
<span class="category">
	<?php 
 if ($post->post_type == "wywiady") {
$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
		echo '<span class="category">wywiady</span>';
}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<span class="category">recenzje</span>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<span class="category">debaty</span>';
}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<span class="category">felietony</span>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<span class="category">dzwieki</span>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category">nagrania</span>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<span class="category">zdjecia</span>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<span class="category">utwory</span>';
}
?>
</span>

		<?php
		echo '<h4>' . get_the_title() . '</h4>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<h5><span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span></h5>
		<?php

	}
}
		echo '</div></article>';
	}
	
} 
echo '</div></div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
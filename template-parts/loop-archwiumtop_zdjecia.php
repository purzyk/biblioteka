<h6><span>najnowsze fotogalerie</span></h6>

<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'zdjecia', 'posts_per_page' => '10',
	'orderby'=> date,
'order'=>DESC) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="typ_small"><div class="archwiumtop_carousell">';
	
	while ( $the_query->have_posts() ) { 
$the_query->the_post();
		?>

		<article><a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'small' ); ?>
		<div class="reveal"> <?php
$categories = get_terms('zdjecia-kategorie');
echo '<span class="category">'.esc_html( $categories[0]->name ).'</span>';
		
		echo '<h4>' . get_the_title() . '</h4>';
		$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) { ?>
		<?php foreach( $terms as $term ) {?>
		<span class="name_gora"><?php echo the_field('imie', $term);?> <span class="big"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}
		echo '</div></a></article>';
	}
	
} 
echo '</div></div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
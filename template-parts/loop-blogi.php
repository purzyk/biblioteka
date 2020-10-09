<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'blogi', 'orderby' => 'date','order' => 'DESC','posts_per_page' => '16' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="blogi_carousel">';
	$a=0;
	while ( $the_query->have_posts() ) {
		$a++;

echo '<article class="typ_1">';

		

		$the_query->the_post();
		$categories = get_terms('debaty-kategorie');?>
	
<?php echo '<div class="blog_left">'; ?>
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('bl_blog');?> </a></div><?php
		echo '<div class="blog_right">';
		echo '<span class="category"><b>blogi pisarzy</b></span>';
		echo '<h4>' . get_the_title() . '</h4>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}
		echo '</div>';
		
	echo '</article>';

		
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
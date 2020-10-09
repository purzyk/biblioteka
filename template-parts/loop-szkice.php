<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'szkice', 'posts_per_page' => '9' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div>';
	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
		$the_query->the_post();
		$categories = get_terms('szkice-kategorie'); ?>
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('bl_small');?> </a><?php
		echo '<span class="category"><a href="'.site_url().'/'.esc_html( $categories[0]->slug ).'"><b>'.esc_html( $categories[0]->name ).'</b></a></span>';
		echo '<h4>' . get_the_title() . '</h4>';
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
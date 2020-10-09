<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'recytacje', 'posts_per_page' => '6' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="recytacje_content">';
	
	while ( $the_query->have_posts() ) {
$the_query->the_post();
	 ?>
		<article class="typ_1"><a href="<?php the_permalink();?>">
		<?php $categories = get_terms('recytacje-kategorie');
		the_post_thumbnail('bl_small');
		echo '<div class="reveal rec_nagr"><div class="inner_black"><div class="black_tran"><div class="aaa">';
		echo '<span class="category"><b>'.esc_html( $categories[0]->name ).'</b></span>';
		echo '<h4>' . get_the_title() . '</h4>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
} ?>
		</div></div></div></div></a></article> <?php
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
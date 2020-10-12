<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'zdjecia', 'posts_per_page' => '9' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="teksty_autora">';
	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
		$the_query->the_post();
		$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		$categories = get_terms('zdjecia-kategorie');?>
		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?> </a>
		<span class="category lato-font"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
		<?php echo '<h4>' . get_the_title() . '</h4>';
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
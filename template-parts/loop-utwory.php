<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'utwory', 'posts_per_page' => '6' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="utwory_left">';
	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
		$the_query->the_post();
		$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		$categories = get_terms('utwory-kategorie');?>

		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?> </a><?php
		echo '<span class="category"><a href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';?>
<h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4> <?php
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}?>
		<a href="<?php the_permalink();?>"> <?php 	the_excerpt(); ?> </a>
			<span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
		<?php
		echo '</article>';
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>

<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'dzwieki', 'orderby' => 'date','order' => 'DESC','posts_per_page' => '6' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="blogi_carousel">';
	$a=0;
	while ( $the_query->have_posts() ) {
		$a++;

echo '<article class="typ_1">';

		

		$the_query->the_post();
		$categories = get_terms('dzwieki-kategorie');?>
		<?php $term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all")); ?>

	
<?php echo '<div class="blog_left">'; ?>
		<a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'blog' ); ?> </a></div><?php
		echo '<div class="blog_right">';
		$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<span class="category"><a href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
		?> <h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4> <?php
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
<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'wywiady', 'posts_per_page' => '1' ) );

// The Loop
if ( $the_query->have_posts() ) {
	
	while ( $the_query->have_posts() ) { 
	$the_query->the_post();?>
		<article class="typ_large"><a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'large' ); ?>
		<div class="reveal">
		<div class="reveal_outer">
		<div class="reveal_inner">
		<?php $categories = get_terms('wywiady-kategorie');
		$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
			echo '<span class="category">'.$term_list[0]->name.'</span>'; ?>
			<h4><?php the_title(); ?></h4>
			<?php the_excerpt(); ?>
			</div>
			</div>
		</div>
		<?php
		echo '</a></article>';
	}
	
} 
/* Restore original Post Data */
wp_reset_postdata();
?>
<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'wywiady', 'posts_per_page' => '2', 'offset' => '1') );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="typ_small">';
	
	while ( $the_query->have_posts() ) { 
$the_query->the_post();
		?>

		<article><a href="<?php the_permalink();?>">
		<?php get_template_part( 'template-parts/img', 'small' ); ?>
		<div class="reveal"> <?php
$categories = get_terms('wywiady-kategorie');
		$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
echo '<span class="category">'.$term_list[0]->name.'</span>';
echo '<h4>' . get_the_title() . '</h4>';
		 the_excerpt(); ?>
		<?php 
		echo '</div></a></article>';
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
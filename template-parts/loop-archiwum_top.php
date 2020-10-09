<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'rozmowy', 'posts_per_page' => '1' ) );

// The Loop
if ( $the_query->have_posts() ) {
	
	while ( $the_query->have_posts() ) { 
	$the_query->the_post();?>
		<article class="typ_large"><a href="<?php the_permalink();?>"> <?php
		
		
		the_post_thumbnail('bl_large');?>
		<div class="reveal">
			<span class="category"><b>rozmowy</b></span>
			<h4><?php the_title(); ?></h4>
			<h5>Z Imię NAZWISKO rozmawiała Imię NAZWISKO</h5>
			<span class="imie">imię <span class="nazwisko">nazwisko</span></span>
			<?php the_excerpt(); ?>
		</div>
		<?
		echo '</a></article>';
	}
	
} 
/* Restore original Post Data */
wp_reset_postdata();
?>
<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'rozmowy', 'posts_per_page' => '2', 'offset' => '1') );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="typ_small">';
	
	while ( $the_query->have_posts() ) { 
$the_query->the_post();
		?>

		<article><a href="<?php the_permalink();?>"> <?php
		
		
		the_post_thumbnail('bl_small');?>
		<div class="reveal"> <?php
$categories = get_terms('rozmowy-kategorie');
echo '<span class="category"><b>'.esc_html( $categories[0]->name ).'</b></span>';
		echo '<h5>Z Imię NAZWISKO rozmawiała Imię NAZWISKO</h5>';
		echo '<h4>' . get_the_title() . '</h4>';
		echo '</div></a></article>';
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
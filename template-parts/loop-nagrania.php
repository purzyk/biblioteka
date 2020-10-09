<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'nagrania', 'posts_per_page' => '4' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="utwory_left">';
	
	while ( $the_query->have_posts() ) { $the_query->the_post();?>
	<article class="typ_1"><a href="<?php the_permalink();?>">
		<?php $categories = get_terms('nagrania-kategorie');?>
		<?php get_template_part( 'template-parts/img', 'small' ); ?>
		<?php
		echo '<div class="reveal rec_nagr"><div class="inner_black"><div class="black_tran"><div class="aaa">';
		$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
		echo '<h4><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h4>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}?>
		</div></div></div></div></a></article> <?php
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
<?php /*

// The Query
$the_query = new WP_Query( array( 'post_type' => 'nagrania', 'posts_per_page' => '4', 'offset' => '4' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="utwory_right">';
	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
		$the_query->the_post();
		$categories = get_terms('nagrania-kategorie');
		get_template_part( 'template-parts/img', 'small' ); ?>
		<div class="rest">
		<?php
		$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
		echo '<h4><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h4>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}
		?>
		</div>

		<?php echo '</article>';
	}
	
} 
echo '</div>';
/* Restore original Post Data */

wp_reset_postdata();

?>
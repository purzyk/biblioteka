<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'ksiazki', 'posts_per_page' => '2' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="ksiazki_carousel">';

	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
			echo '<div class="ksiazki_left">';
		$the_query->the_post();
		$categories = get_terms('ksiazki-kategorie');?>
			<div class="premiera_ksiazki">
				<span class="premiera">
					Premiera
				</span>
				<span class="ksiazki_data">
					<?php the_field('data_premiery'); ?>
				</span>

			</div>
			<div class="title_ksiazki">
			<?php /* $term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
echo '<span class="category"><a href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>'; */?>
<?php
$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?><span class="nazwisko"> <?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}

?>		
<h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4> 
</div>

		
		<a href="<?php the_permalink();?>"> <?php 	the_excerpt(); ?> </a>
		<span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
		<?php
		echo '</div>';
		echo '<div class="ksiazki_right">'; ?>
		<a href="<?php the_permalink();?>"> <?php get_template_part( 'template-parts/img', 'ksiazka' ); ?> </a> <?php
		echo '</div>';
		echo '</article>';
	}
	
} 
echo '</div>';

/* Restore original Post Data */
wp_reset_postdata();
?>
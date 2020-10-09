<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'debaty', 'posts_per_page' => '3','orderby' => 'date','order' => 'DESC' ) );



// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="debaty_carousel">';
	
	while ( $the_query->have_posts() ) {
		echo '<article class="typ_1">';
		$the_query->the_post();
		$categories = get_terms('debaty-kategorie');?>
		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'small' ); ?></a><?php
		$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all")); ?>
<span class="kategoria_debaty">

<?php
$tags = wp_get_post_terms($post->ID, 'debaty-glosy-kategorie');
?>
<a href="https://www.biuroliterackie.pl/biblioteka/debaty/<?php echo $tags[0]->slug;?>">
<?php
		echo $tags[0]->name;
		?>
		</a>
		</span>
<?php
		
		?> <h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4> <span class="debaty_span"><?php echo '<span class="category"><a href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span></span>
		<?php

	}
} ?>
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
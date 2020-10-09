<?php

// The Query
$the_query = new WP_Query( array( 'post_type' => 'felietony', 'posts_per_page' => '3' ) );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div class="recytacje_content felietony_cont">';
	
	while ( $the_query->have_posts() ) {
$the_query->the_post();
	 ?>
		<article class="typ_1">
		<?php $categories = get_terms('felietony-kategorie');
		$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all")); ?>
		<?php get_template_part( 'template-parts/img', 'small' ); ?>
		<?php
		echo '<div class="reveal rec_nagr"><div class="inner_black"><div class="black_tran"><div class="aaa">'; ?>

		<span class="kategoria_debaty">
<a class="link_cykle" href="#"><?php
$tags = wp_get_post_terms($post->ID, 'cykle-nazwy');
		echo $tags[0]->name;
		?>
		</a>
		</span>
		<a class="link_cykl_h4" href="<?php the_permalink();?>">
		<?php
		echo '<h4>' . get_the_title() . '</h4></a>';
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<span class="debaty_span"><?php echo '<a class="cat_cykl" href="https://www.biuroliterackie.pl/biblioteka/cykle-kategorie/'.$term_list[0]->slug.'"><span class="category"><b>'.$term_list[0]->name.'</b></span></a>'; ?><span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span></span>
		<?php

	}
} ?>
		</div></div></div></div></article> <?php
	}
	
} 
echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
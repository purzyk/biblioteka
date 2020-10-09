<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package biblioteka
*/
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
			<section class="single_left">
<h1>
<?php
$tags = wp_get_post_terms($post->ID, 'cykle-nazwy');?>
	
	<?php echo $tags[0]->name;?>
</h1>
		
<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) {?>
	<h4 class="title_autor"><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></h4>
	<p><?php echo $tags[0]->description;?></p>
	<?php

}
}
?>

<?php
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) { ?>

	<?php
		foreach( $terms as $term ) {?>
		<?php if( get_field('nazwisko', $term) ): ?>
		<?php
		$image = get_field('zdjecie', $term);
		$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

		if( $image ) {	
			echo wp_get_attachment_image( $image, $size );
						}?>

							<h6><?php echo the_field('imie', $term);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span>
							</h6>
							<p class="o_autorze_bio"><?php echo $term->description;?></p>


						<?php endif; ?>
						<?php
	
					} 
				}
?>
</section>
<section class="single_right">
		<?php while ( have_posts() ) : the_post(); ?>
			<article>
<span class="date"><?php the_time('d/m/Y'); ?></span>
<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4><?php the_excerpt(); ?>
<span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
	</article>
			

	<?php endwhile; // End of the loop. ?>

		</section>
		<section class="single_right">
				<?php $cur_page = intval(get_query_var('paged')); if ($cur_page == 0) {$cur_page=1;} ;  ?>
<div class="pagination_links"><div class="pagination"><span><?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?>
<span><?php echo $cur_page; ?>/<span><?php echo $wp_query->max_num_pages;?>
<?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?></span></div></div>
</section>
</section>

</section>


	

			</div>
		</section>

</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
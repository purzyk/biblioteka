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
		<?php while ( have_posts() ) : the_post(); ?>
			<section class="single_left">
				<?php $categories = get_terms('blogi-kategorie');
				$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all")); ?>
			<span class="category"><?php the_time('d/m/y'); ?> </span>

				<?php get_template_part( 'template-parts/single', 'cykle' ); ?>
			</div>
		</section>
	<?php endwhile; // End of the loop. ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
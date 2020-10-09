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
				<?php $categories = get_terms('nagrania-kategorie');
				$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
				echo '<span class="category">nagrania / <b>'.$term_list[0]->name.'</b></span>';
				?>
				<?php get_template_part( 'template-parts/single', 'nagrania' ); ?>
			</div>
		</section>
	<?php endwhile; // End of the loop. ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
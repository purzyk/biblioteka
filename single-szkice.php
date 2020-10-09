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
				<?php $categories = get_terms('szkice-kategorie');
				echo '<span class="category">szkice / <b>'.esc_html( $categories[0]->name ).'</b></span>';
				?>
				<?php get_template_part( 'template-parts/single', 'all' ); ?>
			</div>
		</section>
	<?php endwhile; // End of the loop. ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
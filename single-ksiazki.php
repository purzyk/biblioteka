<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package biblioteka
*/
get_header();
if( isset($_GET["new"]) )
{
	get_template_part( 'template-parts/ksiazka', 'nowy' );
}
else
{
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<section class="single_left">
				<?php $categories = get_terms('ksiazki-kategorie');
				$term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
				echo '<span class="category">książki / <b>'.$term_list[0]->name.'</b></span>';
				?>
				<?php get_template_part( 'template-parts/single', 'all' ); ?>
			</div>
		</section>
	<?php endwhile; // End of the loop. ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php
}
get_footer(); ?>
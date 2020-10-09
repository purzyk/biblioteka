<?php
/**
 * Template Name:Kartoteka
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header(); ?>
<div class="right_bck">

</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="archive_left">
					<div class="sidebar">
								<?php get_template_part( 'template-parts/sidebar', 'archive' ); ?>


					</div>
			</section>

			<section class="archive_right">


<?php get_template_part( 'template-parts/kartoteka', 'autorzy' ); ?>
			</section>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>


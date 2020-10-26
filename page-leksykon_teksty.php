<?php
/**
 * Template Name: Leksykon Teksty
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header('loader'); ?>
<div class="right_bck">

</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="archive_left">
					<div class="sidebar">
								<?php get_template_part( 'template-parts/sidebar', 'archive' ); ?>


					</div>
			</section>

			<section class="archive_right disable">

<?php get_template_part( 'template-parts/leksykon', 'indeks' ); ?>
			</section>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>


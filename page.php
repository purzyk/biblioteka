<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header('biuletyn_single'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="container-fluid">
			<div class="wrap-dbs">
				<!-- NAWIGACJA -->
				<div class="navigation-btns lato-font">
					<div class="left">
						<a href="<?php echo get_home_url(); ?>">
						<span><?php _e( 'powrót do strony głównej', 'biblioteka' ); ?></span></a>
					</div>
				</div>

				<div class="biuletyn___post-content">

                    <h4 class="biuletyn_title"><?php the_title(); ?></h4>

					<?php the_content();?>
				</div>

			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
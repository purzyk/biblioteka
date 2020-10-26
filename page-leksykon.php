<?php
/**
 * Template Name: Leksykon
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

			<section class="top_articles">
				<?php get_template_part( 'template-parts/loop', 'archwiumtop' ); ?>
				<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
						show: {
							"740px": 3,
							"980px": 3
						},
						pagination: false
					});
				</script>
			</section>
<div class="archive_breadcrumbs wybierz">
<p>Wybierz czy chcesz skorzystać z Indeksu autorów czy też Indeksu tekstów. </p>
<a href="https://www.biuroliterackie.pl/leksykon/indeks-autorow/">INDEKS AUTORÓW</a>
<a href="https://www.biuroliterackie.pl/leksykon/indeks-tekstow/">INDEKS TEKSTÓW</a>
</div>

			</section>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>


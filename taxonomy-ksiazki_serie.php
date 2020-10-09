<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */


get_header('main');
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="biuletyn">
			
			<figure class="logo__biuletyn">
                <a href="<?php echo get_post_type_archive_link('ksiazki_lista'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ksiazki_logo.png" />
                </a>
			</figure>
			
			<div>
				<h3 class="biuletyn__title"><?php echo get_taxonomy( get_queried_object()->taxonomy )->description; ?></h3>
			</div>
			
			<div>
				<?php wp_nav_menu( array('menu' => 'ksiazki_lista', 'before' => '<span class="red">/</span>', )); ?>
			</div>
			
			<?php echo bl_my_search_form('ksiazki_lista', 'serie', get_queried_object()->slug ); ?>
						
			<?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_serie' ); ?>
			
			<?php get_template_part( 'template-parts/loop', 'ksiazki_lista' ); ?>
			
			<?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_popular' ); ?>
			
			<?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_dystrybucja' ); ?>
			
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<script type="text/javascript">
	$(".master_slider_slider").carousel({
		show: {
		"740px" : 1,
		"980px" : 1
		},
		pagination: false
	});
</script>

<?php get_footer(); ?>
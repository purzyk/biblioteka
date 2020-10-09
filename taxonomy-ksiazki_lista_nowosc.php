<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */
get_header('main');

$biuletyn_title = 'Nakładem Biura Literackiego opublikowanych zostało już ponad pół tysiąca książek. W niniejszym katalogu prezentujemy każdą z nich. Wszystkie dostępne jeszcze tytuły można nabyć w księgarni internetowej poezjem.pl.';

if ( is_tax( 'ksiazki_lista_nowosc', 'zapowiedzi' ) )
{
    $biuletyn_title = 'Książki, które przygotowywane są do publikacji. Sprawdź datę premiery!';
}
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
				<h3 class="biuletyn__title"><?php echo $biuletyn_title; ?></h3>
			</div>
			
			<div>
				<?php wp_nav_menu( array('menu' => 'ksiazki_lista', 'before' => '<span class="red">/</span>', )); ?>
			</div>
			
			<?php get_template_part( 'template-parts/partials/module', 'ksiazki_lista_search' ); ?>
			
			<?php // get_template_part( 'template-parts/loop', 'ksiazki_lista_nowosc' ); ?>
			<?php get_template_part( 'template-parts/loop', 'ksiazki_lista' ); ?>
			
			<?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_dystrybucja' ); ?>
			
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<script type="text/javascript">
	jQuery(".master_slider_slider").carousel({
		show: {
		"740px" : 1,
		"980px" : 1
		},
		pagination: false
	});
</script>

<?php get_footer(); ?>

<?php
/**
* Szablon do wyświetlania pojedynczej litery z kategorii AUTORZY-LITERA
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('main'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="autorzy">
			<figure class="logo__biuletyn">
				<a href="<?php echo get_post_type_archive_link('autorzy_lista'); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/autorzy_logo.png" />
				</a>
			</figure>
			
			<div>
				<h3 class="biuletyn__title">Strony autorów, którzy wydali niedawno w Biurze Literackim nową książkę lub przygotowują dla nas publikację.</h3>
			</div>
			
			<div>
				<?php wp_nav_menu( array('menu' => 'autorzy', 'before' => '<span class="lato-font red">/</span>', )); ?>
			</div>
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form role="search" method="get" class="col-md-12 lato-font search-form search-form-autorzy" action="<?php echo home_url( '/' ); ?>">
						<input type="search" placeholder="SZUKAJ" value="" name="s" title="Szukaj:" />
						<input type="hidden" name="post_type" value="autorzy_lista" />
						<input type="submit" value="Search" />
					</form>
				</div>
			</div>
			
			<?php
			$terms = get_terms( 'autorzy_litera' );

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
			{
			?>
			<div class="row">
			<div class="col-md-12 autorzy-litera lato-font">
				<ul>
					<?php
					foreach ( $terms as $term ) :
					$active = "";
					$curr_term = get_queried_object()->term_id;
					$term_id = $term->term_id;
					if ( $curr_term === $term_id )
					{
						$active = "class='active'";
					}
					?>
					<li>
						<a <?= $active ?> href="<?= esc_url( get_term_link( $term ) ) ?>"><?= $term->name ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			</div>
			<?php
			}
			?>
			
			<?php get_template_part( 'template-parts/loop', 'autorzy_lista' ); ?>

		</section>
	</main> <!-- #main -->
</div> <!-- #primary -->

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
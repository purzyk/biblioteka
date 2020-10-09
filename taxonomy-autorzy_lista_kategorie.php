<?php
/**
* The template for displaying archive pages.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/

$archive_desc = "Strony autorów, którzy wydali niedawno w Biurze Literackim nową książkę lub przygotowują dla nas publikację.";

if ( !empty(term_description()) )
{
    $archive_desc = term_description();
}


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
				<h3 class="biuletyn__title"><?php echo $archive_desc; ?></h3>
			</div>

			<div>
				<?php wp_nav_menu( array('menu' => 'autorzy', 'before' => '<span class="red">/</span>', )); ?>
			</div>

            <?php echo bl_my_search_form('autorzy_lista'); ?>

			<?php
			$terms = get_terms( 'autorzy_litera' );

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
			{
				?>
				<div class="row">
					<div class="col-md-12 autorzy-litera lato-font">
						<ul>
							<?php
							$curr_term_url = get_term_link( get_queried_object()->term_id );
							foreach ( $terms as $term ) :
								$url = $curr_term_url;
								$url .= "?";
								$url .= $term->taxonomy;
								$url .= "=";
								$url .= $term->slug;

								$active = "";
                                $curr_term = "";
                                $term_id = $term->slug;
                                if ( !empty($wp_query->query["autorzy_litera"]) )
                                {
                                    $curr_term = $wp_query->query["autorzy_litera"];
                                    if ( $curr_term === $term_id )
                                    {
                                        $active = "class='active'";
                                    }
                                }
								?>
								<li>
									<a <?= $active ?> href="<?= $url ?>"><?= $term->name ?></a>
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

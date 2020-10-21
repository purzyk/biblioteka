<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					<div class="right">
						<?php next_post_link( '%link', '<span>następny news</span>' ); ?>
					</div>
				</div>

				<div class="biuletyn___post-content">
				
					<?php $term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all")); ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<h4 class="biuletyn_title"><?php the_title(); ?></h4>
					<div class="biuletyn__data">
						<span class="data_data"><?php the_time('d/m/Y');?></span>
						<?php if ( !empty($term_list) ) : ?>
						<span class="data_cat">
						    <a href="<?php echo get_term_link($term_list[0]->term_id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>">
						        <?php echo $term_list[0]->name; ?>
                            </a>
                        </span>
                        <?php endif; ?>
					</div>

					<?php the_content();?>
					
				</div><!--.biuletyn___post-content-->

                
                
				<div class="under_content">
				

                    <?php // INNE WIADOMOŚCI Z KATEGORII
                        get_template_part( 'template-parts/partials/biuletyn/module', 'wiadomosci_z_kategorii' ); ?>
				
				</div><!--.under_content-->

				<?php // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
				if (has_term(array('zapowiedzi', 'premiery'), 'biuletyn_kategorie')) {
					get_template_part( 'template-parts/partials/biuletyn/module', 'materialy'  );
				}
					?>
                
                
				<?php endwhile; // End of the loop. ?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

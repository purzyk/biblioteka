<?php
/**
* Szablon dla strony https://www.biuroliterackie.pl/biblioteka/biuletyn_kategorie/{taxonomy_term}/
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/


get_header('main'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="biuletyn">
			<figure class="logo__biuletyn">
			  <a href="<?php echo get_post_type_archive_link( 'biuletyn' ); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/biuletyn_logo.png" />
				</a>
			</figure>
			<div>
				<h3 class="biuletyn__title">Codzienne wiadomości z Biura Literackiego, premiery i zapowiedzi, a także zapowiedzi i relacje z wydarzeń.</h3>
			</div>
			<div>
				<?php wp_nav_menu( array('menu' => 'biuletyn', 'before' => '<span class="red">/</span>', )); ?>
			</div>

			<?php
			$term =	$wp_query->queried_object;
			$slug = $term->slug;?>
			<?php
			// set up our archive arguments
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$archive_args = array(
				'post_type' => array('biuletyn', 'ksiazki_lista'),    // get only posts
					'paged' => $paged,
					'tax_query' => array(
						array(
						'taxonomy' => 'biuletyn_kategorie',
						'field' => 'slug',
						'terms' => $slug ,
						)
					),
					'posts_per_page'=> 12   // this will display all posts on one page
			);

			// new instance of WP_Quert
			$archive_query = new WP_Query( $archive_args );
			$count=0;
			?>

			<div class="biuletyn-dbs">
				<?php while ( $archive_query->have_posts() ) : $archive_query->the_post(); // run the custom loop ?>
				<?php $count++;?>
				<?php /* if($count==4){
				?>
				<section class="biuletyn_ksiazki">
				<h2 class="biuletyn_subtitle"><span>książki</span></h2>
				<?php get_template_part( 'template-parts/biuletyn', 'ksiazki' ); ?>
				</section>
				<?php
				}
				?>
				<?php if($count==6){
				?>
				<section class="biuletyn_autorzy">

				<h2 class="biuletyn_subtitle"><span>autorzy</span></h2>
				</section>
				<?php
				}
				?>
				<?php if($count==9){
				?>
				<section class="biuletyn_wydarzenia">
				<h2 class="biuletyn_subtitle"><span>wydarzenia</span></h2>

				</section>
				<?php
				}
				*/	?>
				<?php
				$classes = array(
					'row',
					'row-eq-height',
				);
				?>
				<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
					<?php
					$term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all"));
					$push_class = '';
					$pull_class = '';
					if ( ($count % 2) == 0)
					{
						$push_class = 'col-md-push-6 ';
						$pull_class = 'col-md-pull-6 ';
					}
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'large');
					$image_url = $image_url[0];
					if ( empty($image_url) )
					{
						$image_url = get_template_directory_uri().'/img/placeholder.png';
					}
					?>
					<figure class="<?php echo $push_class; ?>col-xs-12 col-sm-12 col-md-6">
						<a href="<?php echo the_permalink(); ?>">
							<img src="<?php echo $image_url; ?>" />
						</a>
					</figure>
					<div class="<?php echo $pull_class; ?>biuletyn__article-dbs col-xs-12 col-sm-12 col-md-6">
						<h4 class="biuletyn__title-dbs"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="biuletyn__data-dbs lato-font">
							<span class="data_data-dbs"><?php the_time('d/m/Y');?></span>
							<span class="data_cat-dbs"><?php echo $term_list[0]->name ?></span>
						</div>
						<span class="biuletyn_excerpt-dbs playfair-display">
							<?php the_excerpt();?>
						</span>
						<span class="biuletyn_wiecej-dbs lato-font">
							<a href="<?php echo the_permalink(); ?>">WIĘCEJ</a>
						</span>
					</div>
				</article>
                    
				<?php endwhile; // end the custom loop ?>
			</div>

			<?php $cur_page = intval(get_query_var('paged')); if ($cur_page == 0) {$cur_page=1;} ;  ?>
			<div class="pagination_links">
				<div class="pagination">
					<span>
						<?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?>
					</span>
					<span>
						<?php echo $cur_page; ?>/<span><?php echo $wp_query->max_num_pages;?>
						<?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?>
					</span>
				</div>
			</div>
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

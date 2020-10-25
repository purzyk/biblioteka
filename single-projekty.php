<?php
/**
 * 
 * The template for displaying all single posts for PROJEKTY.
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
						<?php next_post_link( '%link', '<span>następny projekt</span>' ); ?>
					</div>
				</div>

				<div class="biuletyn___post-content">
					<?php $term_list = wp_get_post_terms($post->ID, 'projekty_kategorie', array("fields" => "all")); ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<h4 class="biuletyn_title"><?php the_title(); ?></h4>

					<?php the_content();?>
				</div>


				<?php // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
				$book = get_the_terms( $post->ID, 'ksiazka' );

				if ( !empty($book) ) :
				$book_id = $book[0]->term_id;
				$about_book_args = array(
					'posts_per_page'=> -1,
					'post_type' => array( 'wywiady', 'recenzje', 'ksiazki', 'utwory', 'debaty', 'felietony', 'dzwieki', 'nagrania', 'zdjecia' ),
					'tax_query' => array(
						array(
							'taxonomy' => 'ksiazka',
							'field'    => 'term_id',
							'terms'    => $book_id
						),
					),
				);
				$about_book_query = new WP_Query( $about_book_args );
				$typ_postu = array();
				$typ_postu['wywiady']['taxonomy'] = 'wywiady-kategorie';
				$typ_postu['recenzje']['taxonomy'] = 'recenzje-kategorie';
				$typ_postu['ksiazki']['taxonomy'] = 'ksiazki-kategorie';
				$typ_postu['utwory']['taxonomy'] = 'utwory-kategorie';
				$typ_postu['debaty']['taxonomy'] = 'debaty-kategorie';
				$typ_postu['felietony']['taxonomy'] = 'felietony-kategorie';
				$typ_postu['dzwieki']['taxonomy'] = 'dzwieki-kategorie';
				$typ_postu['nagrania']['taxonomy'] = 'nagrania-kategorie';
				$typ_postu['zdjecia']['taxonomy'] = 'zdjecia-kategorie';
				foreach ( $about_book_args['post_type'] as $t )
				{
					switch ($t) {
						case "ksiazki":
							$typ_postu[$t]['nazwa'] = 'książki';
							break;
						case "felietony":
							$typ_postu[$t]['nazwa'] = 'cykle';
							break;
						case "dzwieki":
							$typ_postu[$t]['nazwa'] = 'dźwięki';
							break;
						case "zdjecia":
							$typ_postu[$t]['nazwa'] = 'zdjęcia';
							break;
						default:
						$typ_postu[$t]['nazwa'] = $t;
						break;
					}
				}
				if( $about_book_query->have_posts() )
				{
					while( $about_book_query->have_posts() ) : $about_book_query->the_post();
					//$term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all"));
						foreach ( $typ_postu as $typ => $t)
						{
							if ( $typ == $post->post_type)
							{
								$typ_postu[$post->post_type]['status'] = 1;
								$typ_postu[$post->post_type]['ID'][$post->ID] = $post->ID;
							}
						}
					endwhile;
					wp_reset_postdata();
				?>
			
				<script type="text/javascript">
				jQuery(function() {
					jQuery(".ui-tabs-anchor").click(function(evt) {
						jQuery(".post-o-ksiazce").carousel("reset");
						evt.preventDefault();
					})
				});
				jQuery(".post-o-ksiazce").carousel({
					show: {
						"740px" : 2,
						"1163px" : 3
					},
					pagination: false
				});
				jQuery( "#materialy-o-ksiazce" ).tabs();
				</script>
				<?php } //if( $about_book_query->have_posts() )	?>
				<?php endif; ?>
				<?php // end TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE ?>

				<?php
				// KSIĄŻKI
				get_template_part( 'template-parts/partials/biuletyn/module', 'wiadomosci_z_kategorii' ); ?>
				

				<?php
				// PROJEKTY
					get_template_part( 'template-parts/partials/biuletyn/module', 'projekty' );
				// end PROJEKTY ?>

				<?php endwhile; // End of the loop. ?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

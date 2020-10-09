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

				<div class="under_content">
				
                    <?php // POBIERZ INFORMACJE O KSIĄŻCE Z CPT KSIĄŻKI-LISTA
                        get_template_part( 'template-parts/partials/biuletyn/module', 'book_info' ); ?>

                    <?php // KSIĄŻKI Z SERII POEZJA W POEZJEM.PL
                        if ( is_single(153939) || is_single(153940) )
                        {
                           get_template_part( 'template-parts/partials/biuletyn/module', 'seria_poezjem' );
                        } 
                    ?>  
                        

                    <?php // RELACJE Z WYDARZEŃ
                        get_template_part( 'template-parts/partials/biuletyn/module', 'relacje_z_wydarzen' ); ?>

				</div><!-- under_content -->

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
				<section id="biueletyn__materialy-o-ksiazce">
					<h2 class="biuletyn_subtitle"><span class="lato-font"><?php _e( 'teksty i materiały o książce w bibliotece', 'biblioteka' ); ?></span></h2>
					<div id="materialy-o-ksiazce">
						<ul class="lato-font kategorie">
						<?php foreach ( $typ_postu as $typ => $t) : ?>
							<?php if ( !empty($t['status']) && $t['status'] == 1 ) : ?>
							<li>
								<a class="transition-300-ease" href="#<?php echo urlencode( mb_strtolower($typ,'UTF-8') ); ?>">
									<?php echo $t['nazwa']; ?>
								</a>
							</li>
							<?php else : ?>
							<li style="color: #d0d0d0"><?php echo $t['nazwa']; ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
						</ul>

						<?php foreach ( $typ_postu as $typ => $t) : ?>
							<?php if ( !empty($t['status']) && $t['status'] == 1 ) : ?>
								<div id="<?php echo urlencode( mb_strtolower($typ,'UTF-8') ); ?>">
									<ul class="post-o-ksiazce">
									<?php
									$i=0;
									foreach ( $t['ID'] as $id ) :
									if($i==6) break;
									$image_id = get_post_thumbnail_id($id);
									$image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_autor');
									$image_url = $image_url[0];
									if ( empty($image_url) )
									{
										$image_url = "//placeholdit.imgix.net/~text?txtsize=36&txt=381×212&w=381&h=212";
									}
									$excerpt = strip_tags( apply_filters('the_excerpt', get_post_field('post_excerpt', $id)), '<em>' );
									$kategoria = wp_get_post_terms($id, $t['taxonomy'], array("fields" => "all"));
									?>
										<li>
											<a href="<?php echo get_permalink($id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>">
												<img src="<?php echo $image_url; ?>" width="381" height="212" />
											</a>
											<?php if ( !empty($kategoria[0]) ) : ?>
											<span class="lato-font kategoria">
												<a class="transition-300-ease" href="<?php echo get_term_link($kategoria[0]->term_id); ?>" target="_blank"><?php echo $kategoria[0]->name; ?></a>
											</span>
											<?php else : ?>
											<span class="lato-font kategoria"><br /></span>
											<?php endif; ?>
											<a class="tungsten-semibold transition-300-ease title" href="<?php echo get_permalink($id); ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank"><?php echo get_the_title($id); ?></a>
											<span class="playfair-display excerpt"><?php echo $excerpt; ?></span>
											<span class="lato-font wiecej-button">
												<a class="transition-300-ease" href="<?php echo get_permalink($id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>"><?php _e( 'więcej', 'biblioteka' ); ?></a>
											</span>
										</li>
									<?php $i++; endforeach; ?>
									</ul>
								</div>
							<?php endif; // if ( $t['status'] == 1 ) ?>
						<?php endforeach; //foreach ( $typ_postu as $typ => $t) ?>
					</div>
				</section>
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
					get_template_part( 'template-parts/partials/module', 'ksiazki_lista' );
				// end KSIĄŻKI ?>

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

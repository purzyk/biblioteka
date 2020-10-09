<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package biblioteka
 */

get_header('biuletyn_single');

$autorzy = array();

if( have_rows('autorzy_r') )
{
    while ( have_rows('autorzy_r') )
    {
        the_row();
        
        $autorzy_args = array(
            'post_type' => 'autorzy_lista',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'imie',
                    'value'   => get_sub_field('imie'),
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'nazwisko',
                    'value'   => get_sub_field('nazwisko'),
                    'compare' => 'LIKE'
                )
            )
        );
            
        $autorzy_array = new WP_Query( $autorzy_args );

        if (isset($autorzy_array->post->ID))
        {
            $autorzy[] = '<a href="'.get_permalink($autorzy_array->post->ID).'" target="_blank">'.get_sub_field('imie').' '.get_sub_field('nazwisko').'</a>';
        }
        else
        {
            $autorzy[] = get_sub_field('imie').' '.get_sub_field('nazwisko');
        }     
    }
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="content" class="site-content">
			<div class="wrapper">
            
			    <!-- NAWIGACJA -->
                <div class="navigation-btns lato-font">
                    <div class="left">
                        <a href="<?php echo get_post_type_archive_link('ksiazki_lista'); ?>"> <span><?php _e( 'powrót do strony głównej', 'biblioteka' ); ?></span></a>
                    </div>
                    <div class="right">
                        <?php next_post_link( '%link', '<span>następna książka</span>', TRUE, ' ', 'ksiazki_lista_kategorie' ); ?>
                    </div>
                </div>
			
				<?php $term_list = wp_get_post_terms($post->ID, 'ksiazki_lista_kategorie', array("fields" => "all")); ?>
				<?php while ( have_posts() ) : the_post(); ?>
				
				<h4 class="biuletyn_title"><?php the_title(); ?></h4>
				
				<div class="biuletyn__data">
				
					<span class="data_data"><?php the_time('d/m/Y'); ?></span>
					
					<?php if ( !empty($term_list) ) : ?>
					<span class="data_cat">
                        <a href="<?php echo get_term_link($term_list[0]->term_id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>">
                            <?php echo $term_list[0]->name; ?>
                        </a>
                    </span>
                    <?php endif; ?>
                    
				</div>
				
                <div class="ksiazka-excerpt"><?php the_content();?></div>

                <?php endwhile; // End of the loop. ?>
                
				<div class="pod_ksiazka">
				
					<div class="row book-cover">
					<?php
					$image_id = get_post_thumbnail_id();  
					$image_url = wp_get_attachment_image_src($image_id,'medium'); 
					$image_url = ( !empty($image_url[0]) ) ? $image_url[0] : "//placeholdit.imgix.net/~text?txtsize=21&txt=225%C3%97300&w=225&h=300";
					
					$galeria = get_field('galeria');
					$link_do_poezjem = get_field('link_do_poezjem');
					?>
						<div class="col-md-4">
							<img src="<?php echo $image_url; ?>" class="img-responsive" />
							<?php if ($link_do_poezjem) : ?>
							<div class="row btn-dbs">
								<a href="<?php echo $link_do_poezjem; ?>" target="_blank" title="Zamów <?php the_title(); ?>">
									<span class="col-md-2">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									</span>
									<span class="col-md-6 col-md-offset-2 obejrzyj-galerie tungsten-medium">
										<?php _e( 'zamów książkę', 'biblioteka' ); ?>
									</span>
								</a>
							</div>
							<?php endif; //$link_do_poezjem ?>
						</div>
						<?php if( $galeria ): ?>
							<div class="col-md-7 col-md-offset-1 galeria-ksiazki">
								<a href="<?php echo $galeria[0]['url']; ?>" class="gallery-item" title="<?php the_title(); ?>">
									<img src="<?php echo $galeria[0]['sizes']['medium_large']; ?>" alt="<?php echo $galeria[0]['alt']; ?>" />
									<div class="row btn-dbs">
										<span class="col-md-2">
											<i class="fa fa-camera" aria-hidden="true"></i>
										</span>
										<span class="col-md-6 col-md-offset-2 obejrzyj-galerie tungsten-medium">
											<?php _e( 'obejrzyj galerię książki', 'biblioteka' ); ?>
										</span>
									</div>
								</a>
								<?php
								foreach( $galeria as $k => $image ): 
								if ($k < 1) continue; ?>
								<a style="display:none;" href="<?php echo $image['url']; ?>" class="gallery-item" title="<?php the_title(); ?>">
									<img style="display:none;" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
								</a>
								<?php endforeach; //$galeria as $k => $image ?>
							</div>
							<script>
							jQuery('.gallery-item').magnificPopup({
							  type: 'image',
							  gallery:{
								enabled:true,
								tPrev: 'Poprzedni (Strzałka w lewo)', // title for left button
								tNext: 'Następny (Strzałka w prawo)', // title for right button
								tCounter: '<span class="mfp-counter">%curr% z %total%</span>' // markup of counter
							  }
							});
							</script>
						<?php endif; //$galeria ?>
					</div>
					
					<div class="row info-fields">
					    <?php
						/** WYDAWCA **/
						if( !empty($autorzy) ):	?>
						<div class="info_field">
							<div class="info_field_left"><?php _e( 'Autor', 'biblioteka' ); ?></div>
							<div class="info_field_right"><?php echo implode(", ", $autorzy); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** WYDAWCA **/
						if( get_field('wydawca') ):	?>
						<div class="info_field">
							<div class="info_field_left"><?php _e( 'Wydawca', 'biblioteka' ); ?></div>
							<div class="info_field_right"><?php the_field('wydawca'); ?></div>
						</div>
						<?php endif; 
						
						/** MIEJSCE **/
						if( get_field('miejsce') ): ?>
						<div class="info_field">
							<div class="info_field_left">Miejsce</div>
							<div class="info_field_right"><?php the_field('miejsce'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** WYDANIE **/
						if( get_field('wydanie') ): ?>
						<div class="info_field">
							<div class="info_field_left">Wydanie</div>
							<div class="info_field_right"><?php the_field('wydanie'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** DATA WYDANIA **/
						if( get_field('data') ): ?>
						<div class="info_field">
							<div class="info_field_left">Data wydania</div>
							<div class="info_field_right"><?php the_field('data'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** GATUNEK **/
						if( get_field('bli_gatunek') ): ?>
						<div class="info_field">
							<div class="info_field_left">Gatunek</div>
							<div class="info_field_right"><?php the_field('bli_gatunek'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** SERIA **/
						if( get_field('seria') ): ?>
						<div class="info_field">
							<div class="info_field_left">Seria</div>
							<div class="info_field_right"><?php the_field('seria'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** ILOŚĆ STRON **/
						if( get_field('strony') ): ?>
						<div class="info_field">
							<div class="info_field_left">Ilość stron</div>
							<div class="info_field_right"><?php the_field('strony'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** FORMAT **/
						if( get_field('format') ): ?>
						<div class="info_field">
							<div class="info_field_left">Format</div>
							<div class="info_field_right"><?php the_field('format'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** OPRAWA **/
						if( get_field('oprawa') ): ?>
						<div class="info_field">
							<div class="info_field_left">Oprawa</div>
							<div class="info_field_right"><?php the_field('oprawa'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** PAPIER **/
						if( get_field('papier') ): ?>
						<div class="info_field">
							<div class="info_field_left">Papier</div>
							<div class="info_field_right"><?php the_field('papier'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** PROJEKT OKŁADKI **/
						if( get_field('autor_okladki') ): ?>
						<div class="info_field">
							<div class="info_field_left">Projekt okładki</div>
							<div class="info_field_right"><?php the_field('autor_okladki'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** PROJEKT OPRACOWANIA GRAFICZNEGO **/
						if( get_field('autor_opracowanie') ): ?>
						<div class="info_field">
							<div class="info_field_left">Projekt opracowania graficznego</div>
							<div class="info_field_right"><?php the_field('autor_opracowanie'); ?></div>
						</div>
						<?php endif; ?>
						<?php
						/** ISBN **/
						if( get_field('isbn') ): ?>
						<div class="info_field">
							<div class="info_field_left">ISBN</div>
							<div class="info_field_right"><?php the_field('isbn'); ?></div>
						</div>
						<?php endif; ?>
					</div>
					
					<div style="clear: both;"></div>
					
					<?php
					$spis_tresci = get_field('spis_tresci');
					if ($spis_tresci) :
					?>
					<div class="row spis-tresci lato-font">
						<div class="col-md-12">
							<a data-toggle="collapse" data-target="#spis-tresci"><?php _e( 'spis treści', 'biblioteka' ); ?></a>
							<div id="spis-tresci" class="collapse in">
								<?php echo $spis_tresci; ?>
							</div>
						</div>
					</div>
					<?php endif; //spis_tresci ?>
					
					<?php if( have_rows('reviews') ) : ?>
					<div class="row opinie-o-ksiazce lato-font">
                        <div class="col-md-12">
                            <a data-toggle="collapse" data-target="#opinie-o-ksiazce"><?php _e( 'opinie o książce', 'biblioteka' ); ?></a>
                            <div id="opinie-o-ksiazce" class="collapse in">
                                <?php
                                while ( have_rows('reviews') ) : the_row();
                                $tresc = get_sub_field('tresc');
                                $autor = get_sub_field('autor');
                                ?>
                                <div class="col-md-12">
                                    <div class="tresc">
                                    <?php echo $tresc; ?>
                                    </div>
                                    <p class="autor"><?php echo $autor; ?></p>
                                </div>
                                <?php endwhile; //have_rows('reviews' ?>
                            </div>
                        </div>
					</div>
					<?php endif; //have_rows('reviews') ?>
					
					
				</div><!-- .pod_ksiazka -->
			</div><!-- .wrapper -->
			
            <?php
            // INNE KSIĄŻKI AUTORA
            get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'more_books' );
            // end INNE KSIĄŻKI AUTORA ?>
            
            <?php
            // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
            get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_materialy' );
            // end TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE ?>
			
		</div><!-- #content -->
</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

<?php
/**
* The template for displaying archive pages.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('main');

$count = 0;

?>

<div id="primary" class="content-area">
   
    <main id="main-dbs" class="site-main" role="main">
    
        <section class="autorzy">

            <figure class="logo__biuletyn">
				<a href="<?php echo get_post_type_archive_link('autorzy_lista'); ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/autorzy_logo.png" />
				</a>
			</figure>
            
            <div>
				<h3 class="biuletyn__title">
				Strony autorów, którzy wydali niedawno w Biurze Literackim nową książkę lub przygotowują dla nas publikację.
				</h3>
			</div>
            
            <div>
				<?php wp_nav_menu( array('menu' => 'autorzy', 'before' => '<span class="lato-font red">/</span>', )); ?>
			</div>
            
            <div class="row">
               
                <div class="col-md-8 col-md-offset-2" style="text-align: center;display: block;">
                    <div style="display: inline-block;width: 556px;">
                        <form role="search" method="get" class="col-md-12 lato-font search-form search-form-autorzy" action="<?php echo home_url( '/' ); ?>">
                            <input type="search" placeholder="SZUKAJ" value="<?php the_search_query(); ?>" name="s" title="Szukaj:" />
                            <input type="hidden" name="post_type" value="autorzy_lista" />
                            <input type="submit" value="Search" />
                        </form>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div style="display:block;">
                        <div class="dropdown dropdown-search-autorzy dropdown-search">
                            <button class="lato-font btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">wybierz
                            <span class="caret-dbs"></span></button>
                            
                            <ul class="lato-font dropdown-menu">
                                <?php 
                                $reset_query = array('paged','orderby','order' );
                                if ( !empty($_GET['autorzy_lista_kategorie']) ) : ?>
                                <li><a href="<?php echo remove_query_arg( array('paged','autorzy_lista_kategorie','orderby','order' ) ); ?>">pokaż wszystko</a></li>
                                <?php endif; ?>
                                   
                                <li><a href="<?php echo add_query_arg( 'autorzy_lista_kategorie', 'nasi-autorzy', remove_query_arg( $reset_query ) ); ?>">nasi pisarze</a></li>
                                <li><a href="<?php echo add_query_arg( 'autorzy_lista_kategorie', 'leksykon-tworcow', remove_query_arg( $reset_query ) ); ?>">leksykon twórców</a></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
			$terms = get_terms( 'autorzy_litera' );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
			?>
			<div class="row">
			<div class="col-md-12 autorzy-litera lato-font">
				<ul>
					<?php
					foreach ( $terms as $term ) : ?>
					<li>
						<a href="<?= esc_url( get_term_link( $term ) ) ?>"><?= $term->name ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			</div>
			<?php endif; ?>

            <div id="autorzy__lista" class="autorzy__lista_div row">
            <?php 
                while ( have_posts() ) : the_post();
                ++$count;
                
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id,'bl_autor');
                $image_url = $image_url[0];
                if ( empty($image_url) )
                {
                    $image_url = get_template_directory_uri().'/img/placeholders/autor-placeholder-300x300.jpg';
                }
                ?>
                
                <article id="article_<?php echo $count; ?>" class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                    <a href="<?php the_permalink();?>">
                        <figure>
                            <img src="<?= $image_url ?>" alt="" />
                        </figure>
                        
                        <span class="lato-font red">&#47;</span>
                        
                        <span class="playfair-display autorzy_lista_imie"><?php the_field('imie');?></span>
                        <span class="playfair-display autorzy_lista_nazwisko"><?php the_field('nazwisko');?></span>
                    </a>
                </article>
                
                <?php
                endwhile; // end
                wp_reset_query(); ?>
            </div>

            <?php // PAGINATION
                get_template_part( 'template-parts/partials/custom', 'pagination' ); ?>

        </section>
    
    </main>
    <!-- #main -->
    
</div>
<!-- #primary -->

<script type="text/javascript">
  $(".master_slider_slider").carousel({
    show: {
      "740px" : 1,
      "980px" : 1
    }
    ,
    pagination: false
});
</script>

<?php get_footer(); ?>

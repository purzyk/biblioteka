<div id="primary" class="content-area autorzy__leksykon">
    <main id="main" class="site-main" role="main">
        <div id="container-fluid">
            <div class="wrap-dbs">
                <!-- NAWIGACJA -->
                <div class="navigation-btns lato-font">
                    <div class="left">
                        <a href="<?php echo get_home_url(); ?>"> <span><?php _e( 'powrót do strony głównej', 'biblioteka' ); ?></span></a>
                    </div>
                    <div class="right">
                        <?php next_post_link( '%link', '<span>następny autor</span>', TRUE, ' ', 'autorzy_lista_kategorie' ); ?>
                    </div>
                </div>
                <div class="biuletyn___post-content">
                    <?php
                    while ( have_posts() ) : the_post();
            
                    $term_list = wp_get_post_terms($post->ID, 'projekty_kategorie', array("fields" => "all"));
                    
                    // SET UP FIELDS
                    $imie = get_field('imie');
                    $nazwisko = get_field('nazwisko');
                    $nazwisko = mb_strtoupper($nazwisko, 'UTF-8');
                    
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id,'bl_autor');
                    $image_url = $image_url[0];
                    if ( empty($image_url) )
                    {
                        $image_url = get_template_directory_uri().'/img/placeholders/autor-placeholder-300x300.jpg';
                    }
                    ?>
                    <div class="row">
                    <div class="col-md-3 left-side">
                        <img src="<?= $image_url ?>" alt="<?php the_title(); ?>" />
                    </div>
                    
                    <div class="col-md-9 right-side">
                       
                        <figure class="playfair-display autor__title">
                            <span><img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/red-slash.png" alt=""></span>
                            <?php echo $imie; ?> <?php echo $nazwisko; ?>
                        </figure>
                                                
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3 left-side">
                        
                    </div>
                    
                    <div class="col-md-9 right-side">                       
                        <div class="playfair-display biogram">
                          <?php echo strip_tags( get_the_content(), '<em>' ); ?>
                        </div>
                        
                        <div class="col-xs-12 bibliografia-list">
                          <?php get_template_part( 'template-parts/partials/autorzy_lista/leksykon', 'page_bibliografia' ); ?>
                        </div>
                        
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 teksty-autora">
                              <?php get_template_part( 'template-parts/partials/autorzy_lista/leksykon', 'module_materialy' ); ?>
                        </div>
                    </div>
                    
                    <?php get_template_part( 'template-parts/partials/autorzy_lista/al', 'module_poezjem' ); ?>
                    
                </div>
                <div class="under_content"> </div>
                <!-- under_content -->
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    <!-- #main -->
</div>
<!-- #primary -->
<?php get_footer(); ?>

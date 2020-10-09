<?php
/*
* 
* POBIERZ INFORMACJE O KSIĄŻCE Z CPT KSIĄŻKI-LISTA
* 
* single-biuletyn.php
* single-projekty.php
* 
*/

$ksiazki = get_the_terms( $post->ID, 'ksiazka' );

if ( !empty( $ksiazki ) )
{
    // get the first term
    $ksiazka = array_shift( $ksiazki );
    
    $book_args = array(
        'post_type'  => 'ksiazki_lista',
        'title' => $ksiazka->name,
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'ksiazki_wydawca',
                'field'    => 'slug',
                'terms'    => 'biuro-literackie',
            ),
        ),
    );
    
    $book_query = new WP_Query( $book_args );
    
    if ( $book_query->have_posts() ) : ?>
    
        <?php while ( $book_query->have_posts() ) : $book_query->the_post();
        // Okładka
        $book_img_id = get_post_thumbnail_id($post->ID);
        $book_img_url = wp_get_attachment_image_src($book_img_id,'medium');
        $book_img_url = ( !empty($book_img_url) ) ? $book_img_url[0] : NULL;
        
        $book_galeria = get_field('galeria');
        $link_do_poezjem = get_field('link_do_poezjem');            
        ?>
           
            <div class="row book-cover">
                <div class="col-md-4">
                    <img src="<?php echo $book_img_url; ?>" class="img-responsive" />
                    <?php if ($link_do_poezjem) : ?>
                    <div class="row btn-dbs">
                        <a href="<?php echo $link_do_poezjem; ?>" target="_blank" title="Zamów <?php echo wp_strip_all_tags(get_the_title()); ?>">
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
                <?php if( $book_galeria ): ?>
                <div class="col-md-7 col-md-offset-1 galeria-ksiazki">
                    <a href="<?php echo $book_galeria[0]['url']; ?>" class="gallery-item" title="<?php echo wp_strip_all_tags(get_the_title()); ?>">
                        <img src="<?php echo $book_galeria[0]['sizes']['medium_large']; ?>" alt="<?php echo $book_galeria[0]['alt']; ?>" />
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
                    foreach( $book_galeria as $k => $image ):
                    if ($k < 1) continue; ?>
                    <a style="display:none;" href="<?php echo $image['url']; ?>" class="gallery-item" title="<?php echo wp_strip_all_tags(get_the_title()); ?>">
                        <img style="display:none;" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
                    </a>
                    <?php endforeach; //$book_galeria as $k => $image ?>
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
                <?php endif; //$book_galeria ?>
            </div>
            
        <?php endwhile; ?>
        
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php } // end BOOK INFO FROM KSIAZKI-LISTA ?>
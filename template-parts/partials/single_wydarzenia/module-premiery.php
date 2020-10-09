<?php
//======================================================================
//  MODUŁ PREMIERY
//======================================================================

//-----------------------------------------------------
//  W tym module się wyświetlają książki, które mają 
//  premierę podczas danego wydarzenia.
//-----------------------------------------------------

// ZBIERA WSZYSTKIE KSIĄŻKI Z ACF DO TABLICY
$premiery = array();
                   
if( have_rows('dzien') )
{
    while ( have_rows('dzien') )
    {
        the_row();
        
        // SPRAWDŹ DZIEŃ
        $data_url = $_GET['dzien'];
		$data_dbs = get_sub_field('data_dbs', false, false);
		$data_dbs = new DateTime($data_dbs);
		$data_obecna = $data_dbs->format('jm');	       
        
        // ZBIERZ KSIĄŻKI DLA WYBRANEGO DNIA
        if ( $data_url === $data_obecna )
        {
            if( have_rows('wydarzenie') )
            {
                while ( have_rows('wydarzenie') )
                {
                    the_row();
                    /** GODZINA WYDARZENIA **/
					$godz_url = $_GET['godz'];
					$godz_curr = get_sub_field('godz');
					$godz_curr = filter_var( $godz_curr, FILTER_SANITIZE_NUMBER_INT);
					/** TYTUŁ WYDARZENIA **/
					$tytul_url = $_GET['program'];
					$tytul_url = str_replace("\\","",$tytul_url);
					$tytul_curr = get_sub_field('nazwa_wydarzenia');
					$tytul_curr = mb_strtolower($tytul_curr,'UTF-8');
                    
                    if ( $godz_url == $godz_curr && $tytul_url == $tytul_curr && get_sub_field('premiery') )
					{
                        $premiery[] = get_sub_field('premiery');
                    }
                }
            }
        }
        // ZBIERZ WSZYSTKIE KSIĄŻKI Z FESTIWALU
        elseif ( empty($_GET) )
        {
            if( have_rows('wydarzenie') )
            {
                while ( have_rows('wydarzenie') )
                {
                    the_row();

                    if ( get_sub_field('premiery') )
					{
                        $premiery[] = get_sub_field('premiery');
                    }
                }
            }
        }
    }
}

$premiery = array_map("unserialize", array_unique(array_map("serialize", $premiery)));

$books_ids = array();
$single_book = false;
$single_book_class = 'class="wydarzenia__premiery"';
foreach ($premiery as $bookId => $bookData)
{
    foreach ($bookData as $singleId)
    {
        $books_ids[] = $singleId;
    }
}
if ( count($books_ids) == 1 )
{
    $single_book = true;
    $single_book_class = 'class="wydarzenia__single-book"';
}

if( !empty($premiery) ) : ?>
<section id="wydarzenia__premiery" <?php echo $single_book_class; ?> style="margin-top: 60px;">
    <div class="wrap-dbs">
        <h3 class="wydarzenia__title">
        <a href="<?php echo get_permalink(); ?>?premiery"><?php _e( 'premiery', 'biblioteka' ); ?></a></h3>
        <div id="premiery">
            <div>
                <ul class="ksiazki">
                    <?php
                    /** PREMIERY WYDARZENIA **/
                    foreach ( $premiery as $itemz => $p )
                    {
                        if (is_array($p))
                        {
                            foreach ( $p as $k )
                            {
                                $ksiazka_info = get_post( $k );
                                $link = get_permalink( $k );
                                $tytul = $ksiazka_info->post_title;
                                $autor = get_field('autorzy_r_0_imie', $k);
                                $autor .= ' ';
                                $autor .= mb_strtoupper(get_field('autorzy_r_0_nazwisko', $k), 'UTF-8');
                                $image_id = get_post_thumbnail_id( $k);
                                $image_url = wp_get_attachment_image_src($image_id,'bl_ksiazka_okladka');
                                $image_url = $image_url[0];
                                ?>
                                <li>
                                    <a class="single-ksiazka" href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                                        <div class="pictureContainer">
                                            <img src="<?php echo $image_url; ?>" width="300" />
                                        </div>
                                        <div>
                                        <div class="playfair-display autor"><?php echo $autor; ?></div>
                                        <div class="playfair-display tytul"><?php echo $tytul; ?></div>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            } //$p as $k
                        } //is_array($p)
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php if ( $single_book == FALSE ) : ?>
    <script type="text/javascript">
        $(".ksiazki").carousel({
            show: {
                "200px" : 1,
                "992px" : 5
            },
            pagination: false
        });
    </script>
    <?php endif; ?>
</section>
<?php endif; //!empty($wydarzenie['premiery']) ?>
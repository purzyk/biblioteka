<style>
.wydarzenia__jeden-uczestnik #uczesnicy ul {
text-align: center;
}
.wydarzenia__jeden-uczestnik #uczestnik {
text-align: center;
}
.wydarzenia__jeden-uczestnik #uczestnik a {
    display: inline-block;
}
</style>
<?php /** UCZESTINCY **/
$i = 1;
$one_uczestnik = false;
if ( count(get_field('uczestnicy')) == 1 )
{	while ( have_rows('uczestnicy') )
    {	the_row();
        if ( count(get_sub_field('uczestnik_repeater')) == 1 )
            
        {	$one_uczestnik = true; }
    }
}


if( have_rows('uczestnicy') ) :
?>
<section id="wydarzenia__uczestnicy">
    <div class="wrap-dbs">
        <h3 class="wydarzenia__title"><?php _e( 'uczestnicy', 'biblioteka' ); ?></h3>
        <div id="uczesnicy">
            <ul>
                <?php
                while ( have_rows('uczestnicy') ) : the_row();
                $kategoria = get_sub_field('kategoria');
                ?>
                <li>
                    <a href="#<?php echo urlencode( mb_strtolower($kategoria,'UTF-8') ); ?>">
                    <?php echo $kategoria; ?>
                    </a>
                </li>
                <?php
                endwhile;
                ?>
            </ul>

            <?php /** OSOBY **/
            while ( have_rows('uczestnicy') ) : the_row();
            $osoby = "osoby";
            if ( count(get_sub_field('uczestnik_repeater')) == 1 )
            {
                $osoby = "osoba";
            }
            $kategoria = get_sub_field('kategoria');
            ?>
            <div id="<?php echo urlencode( mb_strtolower($kategoria,'UTF-8') ); ?>">
                <?php if( have_rows('uczestnik_repeater') ): ?>
                <ul class="<?php echo $osoby; ?>">
                    <?php
                    while ( have_rows('uczestnik_repeater') ) : the_row();
                    
                    $baner = get_sub_field('baner');
                    $zdjecie = get_sub_field('zdjecie');
                    $zdjecie_url = "//placeholdit.imgix.net/~text?txtsize=33&txt=300%C3%97300&w=300&h=300";
                    $imie = get_sub_field('imie');
                    $nazwisko = get_sub_field('nazwisko');
                    $nazwisko_span = '';
                    $nazwisko_url = '';
                    $biogram = get_sub_field('biogram');
                    
                    if ( $osoby == "osoba" )
                    {
                        if ( $baner )
                        {
                            $zdjecie_url = $baner['sizes']['bl_wydarzenia'];
                        }
                        elseif( $zdjecie )
                        {
                            $zdjecie_url = $zdjecie['sizes']['bl_autor'];
                        }
                    }
                    else
                    {
                        if( $zdjecie )
                        {
                            $zdjecie_url = $zdjecie['sizes']['bl_autor'];
                        }
                    }
                    
                    if ($nazwisko)
                    {
                        $nazwisko_span .= '<span class="lato-font nazwisko">'. $nazwisko .'</span>';
                        $nazwisko_url = '+'.$nazwisko;
                    }
                    
                    ?>
                    <li>
                        <a class="single-uczestnik" href="?uczestnik=<?php echo urlencode( mb_strtolower($imie.$nazwisko_url,'UTF-8') ); ?>#uczestnik" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                            <img src="<?php echo $zdjecie_url; ?>" alt="" />
                            <span class="lato-font imie"><?php echo $imie; ?></span>
                            <?php echo $nazwisko_span; ?>
                        </a>
                    </li>
                    <?php
                    $i++;
                    endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script type="text/javascript">
        $(".osoby").carousel({
            show: {
                "740px" : 2,
                "980px" : 4
            },
            pagination: false
        });
    </script>
    <script>
        $(function() {
            $( "#uczesnicy" ).tabs();
        });
    </script>
</section>
<?php endif; ?>

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
$classes = array(
    'row',
    'row-eq-height',
);

$biuletyn_title = 'Nakładem Biura Literackiego opublikowanych zostało już ponad pół tysiąca książek. W niniejszym katalogu prezentujemy każdą z nich. Wszystkie dostępne jeszcze tytuły można nabyć w księgarni internetowej poezjem.pl.';

if ( get_query_var('taxonomy') == 'gatunki' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_lista_kategorie' )->description;
}
elseif ( get_query_var('taxonomy') == 'serie' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_serie' )->description;
}
elseif ( get_query_var('taxonomy') == 'tytuly' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_litera' )->description;
}
?>

<div id="primary" class="content-area">

    <main id="main-dbs" class="site-main" role="main">

        <section class="biuletyn">

            <figure class="logo__biuletyn">
                <a href="<?php echo get_post_type_archive_link('ksiazki_lista'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ksiazki_logo.png" />
                </a>
            </figure>

            <div>
                <h3 class="biuletyn__title"><?php echo $biuletyn_title; ?></h3>
            </div>

            <div>
                <?php wp_nav_menu( array('menu' => 'ksiazki_lista', 'before' => '<span class="red">/</span>', )); ?>
            </div>

            <?php //SEARCH FORM
            $gatunki_query = isset( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : NULL;
            $term_query = NULL;
            if ( get_query_var('gatunek') )
            {
                $term_query = get_query_var('gatunek');
            }
            elseif ( get_query_var('seria') )
            {
                $term_query = get_query_var('seria');
            }
            
            echo bl_my_search_form('ksiazki_lista', $gatunki_query, $term_query ); ?>
            
            
            <?php //MENU DLA KATEGORII
            if ( isset($_GET["taxonomy"]) && trim($_GET["taxonomy"]) == 'gatunki' )
            {
                get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_gatunki' );
            }
            elseif ( isset($_GET["taxonomy"]) && trim($_GET["taxonomy"]) == 'serie' )
            {
                get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_serie' );
            }
            ?>
            
            <?php get_template_part( 'template-parts/loop', 'ksiazki_lista' ); ?>
        
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

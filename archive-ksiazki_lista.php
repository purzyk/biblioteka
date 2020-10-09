<?php
/**
* The template for displaying archive pages.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/


get_header('main'); 

$view_var = get_query_var('view');

$biuletyn_title = 'Nakładem Biura Literackiego opublikowanych zostało już ponad pół tysiąca książek. W niniejszym katalogu prezentujemy każdą z nich. Wszystkie dostępne jeszcze tytuły można nabyć w księgarni internetowej poezjem.pl.';
$biuletyn_search = bl_my_search_form('ksiazki_lista');

if ( $view_var == 'gatunki' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_lista_kategorie' )->description;
    $biuletyn_search = bl_my_search_form('ksiazki_lista', 'gatunki');
}
elseif ( $view_var == 'serie' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_serie' )->description;
    $biuletyn_search = bl_my_search_form('ksiazki_lista', 'serie');
}
elseif ( $view_var == 'tytuly' )
{
    $biuletyn_title = get_taxonomy( 'ksiazki_litera' )->description;
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
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
            
            <?php echo $biuletyn_search; ?>
            
            <?php
            if ( $view_var == 'gatunki' )
            {
                get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_gatunki' );
            }
            elseif ( $view_var == 'serie' )
            {
                get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_serie' );
            }
            elseif ( $view_var == 'tytuly' )
            {
                get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'menu_tytuly' );
            }
            ?>
            

            <?php get_template_part( 'template-parts/loop', 'ksiazki_lista' ); ?>

            <?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_popular' ); ?>

            <?php get_template_part( 'template-parts/partials/ksiazki_lista/kl', 'module_dystrybucja' ); ?>

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
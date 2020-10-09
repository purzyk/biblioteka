<?php
/**
* The template for displaying archive pages for Projekty.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('main');

$show = get_query_var('show');
if ( $show == 'archiwum' || $show == 'upcoming' )
{
    $active_url = "#menu-item-160320";
    
    if ($show == 'upcoming')
    {
        $active_url = "#menu-item-160321";
    }
    
    echo "<style>$active_url a { font-weight: bold !important; }</style>";
}
?>

<div id="primary" class="content-area">
    <main id="main-dbs" class="site-main" role="main">
        <section class="biuletyn">

            <figure class="logo__biuletyn">
                <a href="<?php echo get_post_type_archive_link('projekty'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/projekty_logo.png" />
                </a>
            </figure>

            <div>
                <h3 class="biuletyn__title">Konkursy, działania edukacyjne i programach literackie</h3>
            </div>

            <div>
                <?php wp_nav_menu( array('menu' => 'projekty', 'before' => '<span class="red">/</span>', )); ?>
            </div>
            
            <?php echo bl_my_search_form('projekty'); ?>
            
            <?php get_template_part( 'template-parts/loop', 'projekty' ); ?>

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

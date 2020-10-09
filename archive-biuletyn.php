<?php
/**
* Template Name: Biuletyn Archive
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('main'); ?>

<div id="primary" class="content-area">
    <main id="main-dbs" class="site-main" role="main">
        <section class="biuletyn">

            <figure class="logo__biuletyn">
                <a href="<?php echo get_post_type_archive_link('biuletyn'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/biuletyn_logo.png" />
                </a>
            </figure>

            <div>
                <h3 class="biuletyn__title">Codzienne wiadomości z Biura Literackiego, premiery i zapowiedzi, a także relacje z wydarzeń.</h3>
            </div>

            <div>
                <?php wp_nav_menu( array('menu' => 'biuletyn', 'before' => '<span class="red">/</span>', )); ?>
            </div>
            
            <?php echo bl_my_search_form('biuletyn'); ?>

            <?php get_template_part( 'template-parts/loop', 'biuletyn' ); ?>

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

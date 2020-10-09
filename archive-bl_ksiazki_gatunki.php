<?php
/**
* The template for displaying archive pages.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/


get_header('primary'); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="biuletyn">

            <figure class="logo__biuletyn">
                <a href="<?php echo get_post_type_archive_link('ksiazki_lista'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ksiazki_logo.png" />
                </a>
            </figure>

            <div>
                <h3 class="biuletyn__title">Nakładem Biura Literackiego opublikowanych zostało już ponad pół tysiąca książek. W niniejszym katalogu prezentujemy każdą z nich. Wszystkie dostępne jeszcze tytuły można nabyć w księgarni internetowej poezjem.pl.</h3>
            </div>

            <div>
                <?php wp_nav_menu( array('menu' => 'ksiazki_lista', 'before' => '<span class="red">/</span>', )); ?>
            </div>

            <?php
            /* GATUNKI */
            $gatunki = array('epika','dramat','liryka','esej','przeklady','wywiady','monografie');
            ?>
            <ul class="ksiazki-litsa__gatunki row">
                <?php
                foreach ( $gatunki as $gatunek ) :
                $g = get_term_by('slug', $gatunek, 'ksiazki_lista_kategorie');
                ?>
                <li class="playfair-display col-xs-6 col-sm-3 col-lg-3 col-lg-offset-0">
                    <a href="<?php echo get_term_link($g->term_id); ?>" title=""><?php echo $g->name; ?></a>
                    <div><?php echo $g->description; ?></div>
                </li>
                <?php endforeach; //close foreach ?>
            </ul>
            <?php /* GATUNKI */ ?>

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
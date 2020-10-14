<?php
/**
* Template Name: Biblioteka
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('main'); ?>

<div id="primary" class="content-area bibliotekaTheme">
	<main id="main" class="site-main" role="main">

        <?php
        $template_dir = 'template-parts/partials/biblioteka/loop';
        ?>
        <div class="row" style="margin-top:70px">
            <div class="col-md-8">

                <section class="rozmowy">
                    <h2><span><a href="<?php echo get_post_type_archive_link('wywiady'); ?>">wywiady</a></span></h2>
                    <h3>Wywiady o książkach, wierszach i pisaniu</h3>
                    <?php get_template_part( $template_dir, 'wywiady' ); ?>
                </section>

                <section class="utwory">
                    <h2><span><a href="<?php echo get_post_type_archive_link('utwory'); ?>">utwory</a></span></h2>
                    <h3>Premierowe dzieła, tłumaczenia i zapowiedzi książek</h3>
                    <?php get_template_part( $template_dir, 'utwory' ); ?>
                </section>

                <section class="recytacje">
                    <h2><span><a href="<?php echo get_post_type_archive_link('felietony'); ?>">cykle</a></span></h2>
                    <h3>autonomiczne terytoria w bibliotece</h3>

                    <?php get_template_part( $template_dir, 'cykle' ); ?>
                </section>

            </div>
            <div class="col-md-4 first-separator">

                <section class="recenzje">
                    <h2><span><a href="<?php echo get_post_type_archive_link('recenzje'); ?>">recenzje</a></span></h2>
                    <h3>TEKSTY KRYTYCZNE, KOMENTARZE I OPINIE</h3>
                    <?php get_template_part( $template_dir, 'recenzje' ); ?>
                </section>     

            </div>
        </div>

        <div class="row" style="margin-top:70px">
            <div class="col-xs-12">
                <section class="ksiazki">
                    <h2><span><a href="<?php echo get_post_type_archive_link('ksiazki'); ?>">książki</a></span></h2>
                    <h3>Fragmenty premierowych publikacji</h3>
                    <?php get_template_part( $template_dir, 'ksiazki' ); ?>
                </section>
                <script type="text/javascript">
                    $(".ksiazki_carousel").carousel({
                        show: {
                        "740px" : 1,
                        "980px" : 1
                        },
                        pagination: false
                    });
                </script>
            </div>
        </div>

        <div class="row" style="margin-top:70px">
            <div class="col-md-8">
                <section class="debaty">
                    <h2><span><a href="<?php echo get_post_type_archive_link('debaty'); ?>">debaty</a></span></h2>
                    <h3>Ankiety, podsumowania, dyskusje o książkach i autorach</h3>
                    <?php get_template_part( $template_dir, 'debaty' ); ?>
                </section>
                <div class="clearfix"></div>
                <section class="zdjecia">
                    <h2><span><a href="<?php echo get_post_type_archive_link('nagrania'); ?>">zdjęcia</a></span></h2>
                    <h3>RELACJE, PREZENTACJE KSIĄŻEK I PORTRETY AUTORÓW</h3>
                    <?php get_template_part( $template_dir, 'zdjecia' ); ?>
                </section>
            </div>
            <div class="col-md-4 second-separator">  
                <section class="blogi">
                    <h2><span><a href="<?php echo get_post_type_archive_link('dzwieki'); ?>">dźwięki</a></span></h2>
                    <h3>ZAPISY CZYTAŃ, DYSKUSJI, KONCERTÓW I AUDYCJI</h3>
                    <?php get_template_part( $template_dir, 'dzwieki' ); ?>
                </section>
            </div>
        </div>

        <div class="row" style="margin-top:12px">
            <div class="col-xs-12">
                <section class="nagrania">
                    <h2><span><a href="<?php echo get_post_type_archive_link('nagrania'); ?>">nagrania</a></span></h2>
                    <h3>Internetowa telewizja literacka</h3>
                    <?php get_template_part( $template_dir, 'nagrania' ); ?>
                </section>
            </div>
        </div>


        <span class="do_gory"><a class="top_bu" href="">DO GÓRY</a></span>

        <script type="text/javascript">
            jQuery(".custom-type-1").click(function() {
              window.location = $(this).find(".post-url").attr("href"); 
              return false;
            });
            jQuery(document).ready(function() {
                var offset = 220;
                var duration = 500;
                jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.do_gory').fadeIn(duration);
            } else {
                jQuery('.do_gory').fadeOut(duration);
            }
            });

            jQuery('.do_gory').click(function(event) {
                event.preventDefault();
                jQuery('html, body').animate({scrollTop: 0}, duration);
                return false;
            })

            });
        </script>

	</main>
</div>

<?php get_footer(); ?>
<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section class="rozmowy">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/wywiady/">wywiady</a></span></h2>
			<h3>Wywiady o książkach, wierszach i pisaniu</h3>
			<?php get_template_part( 'template-parts/loop', 'wywiady' ); ?>
		</section>

		<section class="szkice">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/recenzje/">recenzje</a></span></h2>
			<h3>Teksty krytyczne, komentarze, recenzje, notki i opinie</h3>
			<?php get_template_part( 'template-parts/loop', 'recenzje' ); ?>
		</section>

		<section class="ksiazki">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/ksiazki/">książki</a></span></h2>
			<h3>Fragmenty antologii, tomików, zbiorów opowiadań i szkiców</h3>
			<?php get_template_part( 'template-parts/loop', 'ksiazki' ); ?>
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

		<section class="utwory">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/utwory/">utwory</a></span></h2>
			<h3>Premierowe dzieła, tłumaczenia i zapowiedzi książek</h3>
			<?php get_template_part( 'template-parts/loop', 'utwory' ); ?>
		</section>

		<section class="debaty">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/debaty/">debaty</a></span></h2>
			<h3>Ankiety, podsumowania, dyskusje o książkach i autorach</h3>
			<?php get_template_part( 'template-parts/loop', 'debaty' ); ?>

			<script type="text/javascript">
				$(".debaty_carousel").carousel({
					show: {
					"740px" : 2,
					"980px" : 3
					},
					pagination: false
				});
			</script>
		</section>

		<section class="recytacje">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/cykle/">cykle</a></span></h2>
			<h3>autonomiczne terytoria w bibliotece</h3>

			<?php get_template_part( 'template-parts/loop', 'cykle' ); ?>
		</section>

		<section class="blogi">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/dzwieki/">dźwięki</a></span></h2>
			<h3>Zapisy wieczorów autorskich, dyskusje, koncertów i audycji</h3>
			<?php get_template_part( 'template-parts/loop', 'dzwieki' ); ?>
			<script type="text/javascript">
			$(".blogi_carousel").carousel({
				show: {
				"740px" : 2,
				"980px" : 3
				},
				pagination: false
			});
			</script>
		</section>

		<section class="nagrania">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/nagrania/">nagrania</a></span></h2>
			<h3>Internetowa telewizja literacka</h3>
			<?php get_template_part( 'template-parts/loop', 'nagrania' ); ?>
		</section>

		<section class="zdjecia">
			<h2><span><a href="https://www.biuroliterackie.pl/biblioteka/zdjecia/">zdjęcia</a></span></h2>
			<h3>Relacje z wydarzeń, prezentacje książek i portretów autorów</h3>
			<div class="zdjecia_przed"></div>
			<?php get_template_part( 'template-parts/loop', 'zdjecia' ); ?>
			<div class="zdjecia_po"></div>
		</section>
		<script type="text/javascript">
			$(".zdjecia_content").carousel({
				show: {
				"740px" : 1,
				"980px" : 3
				},
				pagination: false
			});
		</script>

		<span class="do_gory"><a class="top_bu" href="">DO GÓRY</a></span>

		<script type="text/javascript">
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

<script type="text/javascript">
	$(".master_slider_slider").carousel({
		show: {
		"740px" : 1,
		"980px" : 1
		},
		pagination: false
	});
</script>

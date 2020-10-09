<style type="text/css">

</style>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="wydarzenia__program">
			<div class="container-fluid">
				<div id="info">
					<div class="row">
						<?php
						/** REALIZATORZY **/
						if(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'realizatorzy')
						{
							require get_template_directory() . '/template-parts/wydarzenia-info_realizatorzy.php';
						}
						/** MULTIMEDIA **/
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'multimedia')
						{
							require get_template_directory() . '/template-parts/wydarzenia-info_multimedia.php';
						}
						/** WOLONTARIAT **/
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'wolontariat')
						{
							require get_template_directory() . '/template-parts/wydarzenia-info_wolontariat.php';
						}
						/** AKREDYTACJE **/
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'akredytacje')
						{
							require get_template_directory() . '/template-parts/wydarzenia-info_akredytacje.php';
						}
						else
						{
							//require get_template_directory() . '/template-parts/wydarzenia-niezbednik_miejsca.php';
							//require get_template_directory() . '/template-parts/wydarzenia-niezbednik_noclegi.php';
							//require get_template_directory() . '/template-parts/wydarzenia-niezbednik_bilety.php';
						}
						?>						
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
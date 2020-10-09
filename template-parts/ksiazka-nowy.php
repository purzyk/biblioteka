<?php
$terms = get_the_terms( $post->ID , 'autor' ); // AUTOR
$categories = get_terms('ksiazki-kategorie'); // KATEGORIA KSIAZKI
$term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<section class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<?php
					if($terms)
					{
						foreach( $terms as $term )
						{
						?>
						<h4 class="title_autor playfair-display" style="text-align:center;">
						<?php echo the_field('imie', $term);?>
						<span style="text-transform: uppercase;"> <?php echo the_field('nazwisko', $term);?></span>
						</h4>
						<?php
						}
					}
					?>
					<h1 class="title_h1 playfair-display" style="text-align: center;margin: 0;font-style: italic;font-size: 1.7em;font-weight: 600;"><? the_title(); ?></h1>
					<div class="data lato-font" style="color: #fff;margin-bottom: 23px;font-size: 14px;text-align: center;margin-top: 30px;">
							<span class="date" style="background-color: #000;padding: 7px"><?php the_date('d/m/Y'); ?></span>
							<span class="cat" style="background-color: #d01117;padding: 7px;text-transform: uppercase;"><?php echo $term_list[0]->name; ?></span>
					</div>
					</div>
				</div>

			</section>
		<?php endwhile; // End of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->
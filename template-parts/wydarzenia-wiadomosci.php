<style type="text/css">

</style>
<?php
$wiadomosci_term = get_field('choose_cat');

/** ARGUMENTS */
$args = array(
	'posts_per_page'   => -1,
	'post_type' => 'biuletyn',
	'tax_query' => array(
	array(
		'taxonomy' => 'biuletyn_kategorie',
		'field' => 'slug',
		'terms' => $wiadomosci_term->slug
		)
	)
);
$event_news = null;
$event_news = new WP_Query($args);

if( $event_news->have_posts() ) :
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="wydarzenia__wiadomosci" class="wydarzenia__wiadomosci-bundle">
			<div class="wrap-dbs lato-font">
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
						<h3 class="wydarzenia__title"><?php _e( 'wiadomości', 'biblioteka' ); ?></h3>
					</div>
				</div>
				<?php while ($event_news->have_posts()) : $event_news->the_post();
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'large');  
				$image_url = $image_url[0];
				if ( empty($image_url) )
				{
					$image_url = get_template_directory_uri().'/img/placeholder.png';
				}
				?>
				<div class="row event__news">
					<?php /** FEATURED IMAGE **/ ?>
					<div class="col-xs-12 col-sm-12 col-md-6 feat-image" style="background-image:url(<?php echo $image_url; ?>);"></div>
					<?php /** TEXT **/ ?>
					<div class="col-xs-12 col-sm-12 col-md-6">
						<h4 class="title tungsten-semibold"><?php the_title(); ?></h4>
						<div class="data">
							<span class="date"><?php the_date('d/m/Y'); ?></span>
							<span class="cat"><?php echo $wiadomosci_term->name; ?></span>
						</div>
						<div class="playfair-display excerpt"><?php the_excerpt(); ?></div>
						<div class="more">
							<a href="<?php echo the_permalink(); ?>"><?php _e( 'WIĘCEJ', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
wp_reset_query();
endif;
?>
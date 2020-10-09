<?php
/**
 * The template for displaying UCZESTNIK.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package biblioteka
 */
get_header('wydarzenia');

$term = get_queried_object();
$slider_img = array();
/** ARGUMENTS */
$args = array(
	'posts_per_page' => 1,
	'post_type' => 'wydarzenia',
	'tax_query' => array(
	array(
		'taxonomy' => 'uczestnik',
		'field' => 'slug',
		'terms' => $term->slug
		)
	)
);
$wydarzenia = null;
$wydarzenia = new WP_Query($args);
if( $wydarzenia->have_posts() )
{
	while ($wydarzenia->have_posts()) : $wydarzenia->the_post();
		if ( has_post_thumbnail() )
		{
			$image_id = get_post_thumbnail_id();  
			$image_url = wp_get_attachment_image_src($image_id,'bl_wydarzenia');  
			$slider_img[] = $image_url[0];
		}
	endwhile;
}
wp_reset_query();
if ( empty($slider_img) )
{
	$slider_img[] = "https://placeholdit.imgix.net/~text?txtsize=133&txt=biuroliterackie.pl&w=1600&h=578";
}
?>
<style type="text/css">
.tax-uczestnik header {
	padding: 35px 0 25px 0 !important;
}
.tax-uczestnik #uczestnik {
	margin-top: 30px;
}
.tax-uczestnik .name {
	text-align: center;
    font-size: 33px;
    font-family: Lato;
    text-transform: initial;
    color: #000;
	letter-spacing: normal;
    font-weight: bold;
}
</style>

<header id="masthead" class="site-header container-fluid" role="banner">
	<div class="row wrap-dbs">
		<div class="col-xs-offset-2 col-xs-8 col-md-4 col-md-offset-0 no-padding">
			<a href="http://www.biuroliterackie.pl/">
				<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/BLWWW_2012_czern_resize.jpg">
			</a>
		</div>
		<div class="col-md-8">
			<?php /* wp_nav_menu( array('menu' => 'menu-links' ));*/ ?>
		</div>
	</div>
</header><!-- #masthead -->

<section class="master_slider-dbs">
	<div class="slide-dbs">
		<img src="<?php echo $slider_img[0]; ?>" />
	</div>
</section>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="uczestnik" class="uczestnik">
			<div class="row wrap-dbs no-padding">
				<div class="col-md-12 no-padding">
					<h3 class="name"><?php echo $term->name; ?></h3>
				</div>
				<div class="col-md-12 no-padding">
					<div class="fluid-image" style="height:400px">
						<img src="https://placeholdit.imgix.net/~text?txtsize=133&txt=<?php echo urlencode($term->name); ?>&w=1083&h=400" />
					</div>
				</div>
			</div>	
		</section>		
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

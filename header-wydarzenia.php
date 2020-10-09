<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package biblioteka
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72741284-1', 'auto');
  ga('send', 'pageview');

</script>
<div id="page" class="hfeed site">
	<div class="transformer">


	<div class="main">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'biblioteka' ); ?></a>

<?php /** if ( is_single() ) { ?>
<section class="master_slider">
	<div class="slide">
	  <?php if ( is_single() ) { ?>
		<?php if ( has_post_thumbnail() ) {
		the_post_thumbnail('bl_wydarzenia');
		} else { ?>
		<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-1541x725.jpg" alt="<?php the_title(); ?>" />
		<?php } ?>
	<?php 									} else { ?>
					<img src="http://testowy.biz/bl/wp-content/uploads/2015/11/01-1600x891.jpg">
				<?php }
	?>
	<div class="desc_header">
	<span class="desc_nazwa"><?php the_title();?></span><br />
	<span class="desc_data"><?php the_field('data_do_pokazania');?></span><br />
	<span class="desc_miejsce"><?php the_field('miejsce');?></span>
	</div>
	</div>
</section>
<header id="masthead" class="site-header" role="banner">
	<div class="logo">
		<a href="http://www.biuroliterackie.pl/">
			<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/BLWWW_2012_czern_resize.jpg">
		</a>
	</div>
	<div class="main-links">
		<?php /* wp_nav_menu( array('menu' => 'menu-links' )); ?>
	</div>
</header><!-- #masthead -->
<?php } **/ ?>
	<div id="content" class="site-content">



<div class="post_auth"><span class="post_span"><?php the_post_thumbnail_caption(); ?></span></div>

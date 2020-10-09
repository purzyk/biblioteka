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
	<div class="off-canvas"><?php wp_nav_menu( array('menu' => 'top-links' )); ?></div>


	<header id="top_links">
		<div class="inner">
			<div class="site_branding"><a href="http://biuroliterackie.pl/"><img src="<?php echo  get_template_directory_uri().'/img/logo.png'?>"></a>			</div>
			<div class="top_nav"><img src="<?php echo  get_template_directory_uri().'/img/menu.png'?>" alt="" class="menu-toggle-btn"><?php wp_nav_menu( array('menu' => 'top-links' )); ?></div>
			<div class="social right">
			<a taget="_blank" href="https://www.facebook.com/BLiterackie"><img src="<?php echo  get_template_directory_uri().'/img/fb.png'?>"></a>
			<a taget="_blank" href="https://www.youtube.com/user/biuroliterackie"><img src="<?php echo  get_template_directory_uri().'/img/youtube.png'?>"></a>
			<a taget="_blank" href="https://www.instagram.com/biuroliterackie/"><img src="<?php echo  get_template_directory_uri().'/img/instagram.png'?>"></a>
			</div>
		</div>
	</header>
	<div class="main">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'biblioteka' ); ?></a>


	<?php get_template_part( 'template-parts/top', 'slider_code' ); ?>

	<div id="content" class="site-content">


<?php if(is_tax('cykle-nazwy')) {?>
<header id="masthead" class="site-header" role="banner">
<div class="logo">
			<a href="https://www.biuroliterackie.pl/biblioteka"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_3.png'?>"></a>
		</div>
		<div class="main-links">
			<?php wp_nav_menu( array('menu' => 'menu-links' )); ?>
		</div>
			</header><!-- #masthead -->
<?php } ?>




<div class="post_auth"><span class="post_span"><?php the_post_thumbnail_caption(); ?></span></div>

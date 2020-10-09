<?php
/**
 * The header for single AUTORZY_LISTA.
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

    <div class="navbar navbar-biblioteka navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                
                <a class="navbar-left" href="http://biuroliterackie.pl/"><img src="<?php echo  get_template_directory_uri().'/img/logo.png'?>"></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://www.facebook.com/BLiterackie"><img src="<?php echo  get_template_directory_uri().'/img/fb.png'?>"></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/user/biuroliterackie"><img src="<?php echo  get_template_directory_uri().'/img/youtube.png'?>"></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/biuroliterackie/"><img src="<?php echo  get_template_directory_uri().'/img/instagram.png'?>"></a></li>
                </ul>
                
                <?php
                wp_nav_menu( array(
                    'menu' => 'top-links',
                    'menu_class' => 'nav navbar-left navbar-nav',
                    'container' => '<ul>'
                )); 
                ?>
            </div>
        </div>
    </div>
	<div class="main">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'biblioteka' ); ?></a>

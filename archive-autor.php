<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header(); ?>
<div class="right_bck">

</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="archive_left">
					<div class="sidebar">
							<a class="side_logo" href="http://testowy.biz/bl/"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_4.png'?>"></a>
							<h4 class="premiera"><span>premiera</span></h4>
							<a class="premiera_ksiazka" href="#"><img src="http://testowy.biz/bl/wp-content/uploads/2015/11/w.jpg"></a>
							<h4><span>nawigacja</span></h4>
								<?php wp_nav_menu( array('menu' => 'sidebar_categories', 'link_before' => '<span>', 'link_after' => '</span>' )); ?>
							<h4 class="rankingi"><span>rankingi</span></h4>
							<ul class="rankingi_ul">
							<li><a href="#">najpopularniejsze teksty</a></li>
							<li><a href="#">NAJCHĘTNIEJ ODTWARZANE</a></li>
							<li><a href="#">NAJCZĘŚCIEJ CZYTANI</a></li>
							</ul>
							<form method="get" id="searchform_sidebar" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit_sidebar" value="Search" class="btn" />
			</div>
			</form>

							<h4 class="empty"><span>WYDARZENIA</span></h4>
							<a class="premiera_ksiazka" href="#"><img src="http://testowy.biz/bl/wp-content/uploads/2015/11/piesel.jpg"></a>


							<h4 class="tagi"><span>tagi</span></h4>
							<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar')) : ?>
[ do default stuff if no widgets ]
<?php endif; ?>


					</div>
			</section>

			<section class="archive_right">


<?php get_template_part( 'template-parts/archive', 'loop' ); ?>
			</section>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>


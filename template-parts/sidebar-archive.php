<a class="side_logo" href="https://www.biuroliterackie.pl/biblioteka/"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_4.png'?>"></a>
<h4 class="premiera"><span>premiera</span></h4>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('premiera')) : ?>
<?php endif; ?>
<h4><span>nawigacja</span></h4>
<?php wp_nav_menu( array('menu' => 'sidebar_categories', 'link_before' => '<span>', 'link_after' => '</span>' )); ?>
<?php /*
<h4 class="rankingi"><span>rankingi</span></h4>
<ul class="rankingi_ul">
<li><a href="#">najpopularniejsze teksty</a></li>
<li><a href="#">NAJCHĘTNIEJ ODTWARZANE</a></li>
<li><a href="#">NAJCZĘŚCIEJ CZYTANI</a></li>
</ul>
*/ ?>
<form method="get" id="searchform_sidebar" action="<?php echo home_url( '/' ); ?>">
<div><input type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit_sidebar" value="Search" class="btn" />
</div>
</form>

<h4 class="empty"><span>WYDARZENIA</span></h4>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('wydarzenie')) : ?>
<?php endif; ?>


<?php /* <h4 class="tagi"><span>tagi</span></h4>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar')) : ?>
<?php endif; ?>
*/ ?>
<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package biblioteka
 */

get_header('wydarzenia');

$premiery = false;

if( have_rows('dzien') )
{
	while ( have_rows('dzien') )
	{
		the_row();
		if( have_rows('wydarzenie') )
		{
			while ( have_rows('wydarzenie') )
			{
				the_row();
				if (get_sub_field('premiery'))
				{
					$premiery = true;
				}
			}
		}
	}
}

?>

<nav id="main-navbar" class="navbar site-header-dubas navbar-static-top" role="navigation">
	<div class="container-fluid no-padding">
		<div class="wrap-dbs">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#wydarzenia-navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="http://www.biuroliterackie.pl/" target="_blank">
					<img class="img-responsive col-xs-offset-1 col-md-offset-0" src="<?php echo get_template_directory_uri().'/img/BLWWW_2012_czern_resize.jpg'; ?>" />
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="wydarzenia-navbar">
				<ul id="menu-main-menu" class="nav navbar-nav navbar-right lato-font">

					<?php /** INFORMACJE **/
					if ( get_the_content() || $tytul_wydarzenia  ): ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#informacje"><?php _e( 'informacje', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** ZAPOWIEDŹ **/
					if( have_rows('zapowiedz_by_dubas') ): ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__zapowiedz"><?php _e( 'zapowiedź', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** WIADOMOŚCI **/
					if( get_field('choose_cat') ): ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__wiadomosci"><?php _e( 'wiadomości', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** UCZESTINCY **/
					if( have_rows('uczestnicy') ): ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__uczestnicy"><?php _e( 'uczestnicy', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** PROGRAM **/
					if( have_rows('dzien') ): ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__program"><?php _e( 'program', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** NIEZBĘDNIK **/
					if( have_rows('miejscawydarzen') || have_rows('miejsca_noclegowa') || get_field('bilety_na_koncerty') ) : ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__niezbednik"><?php _e( 'niezbędnik', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** PREMIERY **/
					if ( $premiery == TRUE ) : ?>
					<li><a href="<?php echo get_permalink(); ?>?premiery"><?php _e( 'premiery', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					<?php /** INFO **/
					/*
					if( get_field('realizatorzy') || have_rows('multimedia') || get_field('akredytacje') || get_field('wolontariat') ) : ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__info"><?php _e( 'info', 'biblioteka' ); ?></a></li>
					<?php endif;
					*/ ?>

					<?php /** PRZYJACIELE **/
					if( have_rows('organizatorzy') || have_rows('mecenasi') || have_rows('partnerzy') || have_rows('patroni_medialni') ) : ?>
					<li><a class="scroll-to" href="<?php echo get_permalink(); ?>#wydarzenia__przyjaciele"><?php _e( 'organizatorzy', 'biblioteka' ); ?></a></li>
					<?php endif; ?>

					

				</ul>
			</div>
		</div>
	</div>
</nav>

<?php /*
<header id="masthead" class="site-header-dubas container-fluid" role="banner">
	<div class="row wrap-dbs">
		<div class="col-xs-offset-2 col-xs-8 col-md-4 col-md-offset-0 no-padding">
			<a href="http://www.biuroliterackie.pl/" target="_blank">
				<img src="<?php echo get_template_directory_uri().'/img/BLWWW_2012_czern_resize.jpg'; ?>">
			</a>
		</div>
		<div class="col-md-8">
			<?php /* wp_nav_menu( array('menu' => 'menu-links' )); ?>
		</div>
	</div>
</header><!-- #masthead -->
<?php */ ?>
<section class="master_slider-dbs">
	<div class="slide-dbs">
		<?php
		if ( has_post_thumbnail() )
		{
			the_post_thumbnail('bl_wydarzenia');
		}
		else
		{
		?>
			<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-1541x725.jpg" alt="<?php the_title(); ?>" />
		<?php
		}
		?>
	</div>
</section>
<?php
if ( is_user_logged_in () )
{
	?>
	<?php
	$premiery = get_posts(array(
		'post_type' => 'ksiazki_lista',
		'meta_query' => array(
			array(
				'key' => 'premiera', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	));
	//print_r($premiery);
}

if( isset($_GET["news"]) )
{
	get_template_part( 'template-parts/wydarzenia', 'wiadomosci' );
}
elseif( isset($_GET["uczestnik"]) )
{
	get_template_part( 'template-parts/wydarzenia', 'uczestnik' );
}
elseif( isset($_GET["program"]) )
{
	if ( isset($_GET["program"]) && trim($_GET["program"]) )
	{
		get_template_part( 'template-parts/wydarzenia', 'programsingle' );
	}
	else
	{
		get_template_part( 'template-parts/wydarzenia', 'program' );
	}
}
elseif( isset($_GET["strona"]) && trim($_GET["strona"]) == 'niezbednik' )
{
	get_template_part( 'template-parts/wydarzenia', 'niezbednik' );
}
elseif( isset($_GET["premiery"]) )
{
	get_template_part( 'template-parts/wydarzenia', 'premiery' );
}
elseif( isset($_GET["strona"]) && trim($_GET["strona"]) == 'info' )
{
	get_template_part( 'template-parts/wydarzenia', 'info' );
}
else
{
	get_template_part( 'template-parts/wydarzenia', 'home' );
}

?>

<?php get_footer(); ?>

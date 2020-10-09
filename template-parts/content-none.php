<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Niestety, takiej strony nie ma.', 'biblioteka' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content"> <?php /*
	<h5 class="search-title"><?php printf( esc_html__( 'Może użyj wyszukiwarki?', 'biblioteka' ), '<span>' . get_search_query() . '</span>' ); ?></h5>	
		<form method="get" id="searchform_sidebar2" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit_sidebar" value="Search" class="btn" />
			*/ ?>
			</div>
			</form>
	</div><!-- .page-content -->
</section><!-- .no-results -->

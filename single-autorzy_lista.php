<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package biblioteka
*/

get_header('autorzy_clear'); ?>

<?php
if ( is_object_in_term( $post->ID, 'autorzy_lista_kategorie', 15947 ) ) :
	get_template_part( 'template-parts/loop', 'nasi_autorzy' );
elseif ( is_object_in_term( $post->ID, 'autorzy_lista_kategorie', 'leksykon-tworcow' ) ) :
	get_template_part( 'template-parts/loop', 'leksykon_autorzy' );
endif;
?>

<?php get_footer(); ?>

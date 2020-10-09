<?php
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$couleur = get_field('zdjecie_glowne_cyklu', $taxonomy . '_' . $term_id);
$size = 'bl_xl_large'; // (thumbnail, medium, large, full or custom size)

if( $couleur ) {

	echo wp_get_attachment_image( $couleur, $size );

}
else { ?>
<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-1541x725.jpg" alt="<?php the_title(); ?>" />
<?php }
?>
<?php if ( has_post_thumbnail() ) {
the_post_thumbnail('bl_xl_large');
} else { ?>
<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-1541x725.jpg" alt="<?php the_title(); ?>" />
<?php } ?>
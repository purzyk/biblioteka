<?php if ( has_post_thumbnail() ) {
the_post_thumbnail('bl_blog');
} else { ?>
<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-200x200.jpg" alt="<?php the_title(); ?>" />
<?php } ?>
<?php
// set up our archive arguments
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$count = 0;

$classes = array(
    'row',
    'row-eq-height',
);

$archive_args = array(
	'post_type' => 'biuletyn',
	'paged' => $paged,
	'posts_per_page'=> 12
);

// new instance of WP_Query
$archive_query = new WP_Query( $archive_args );
?>

<div class="biuletyn-dbs">

	<?php while ( $archive_query->have_posts() ) : $archive_query->the_post(); // run the custom loop ?>
	<?php $count++; ?>
	
	<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
		<?php
		$term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all"));

		$cat_title = $term_list[0]->name;
		$cat_url = get_term_link($term_list[0]->term_id);
		if ( $term_list[0]->parent != 0 )
		{
			$parent_cat = get_term( $term_list[0]->parent, $term_list[0]->taxonomy );
			$cat_title = $parent_cat->name;
			$cat_url = get_term_link($parent_cat->term_id);
		}

		$push_class = '';
		$pull_class = '';
		if ( ($count % 2) == 0 )
		{
			$push_class = 'col-md-push-6 ';
			$pull_class = 'col-md-pull-6 ';
		}
        
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'large');
		$image_url = !empty($image_url) ? $image_url[0] : get_template_directory_uri().'/img/placeholder.png';

		$excerpt = apply_filters('the_excerpt', get_the_excerpt());
		if (  mb_strlen($excerpt, 'UTF-8') > 336 )
		{
			$excerpt = wordwrap($excerpt, 336);
			$excerpt = explode("\n", $excerpt);
			$excerpt = $excerpt[0] . '...';
		}
		?>
		<figure class="<?php echo $push_class; ?>col-xs-12 col-sm-12 col-md-6">
			<a href="<?php echo the_permalink(); ?>">
				<img src="<?php echo $image_url; ?>" height="415" />
			</a>
		</figure>
		<div class="<?php echo $pull_class; ?>biuletyn__article-dbs col-xs-12 col-sm-12 col-md-6">
			<h4 class="biuletyn__title-dbs"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<div class="biuletyn__data-dbs lato-font">
				<span class="data_data-dbs"><?php the_time('d/m/Y');?></span>
				<span class="data_cat-dbs"><a href="<?php echo $cat_url; ?>"><?php echo $cat_title; ?></a></span>
			</div>
			<span class="biuletyn_excerpt-dbs playfair-display">
				<?php echo $excerpt; ?>
			</span>
			<span class="biuletyn_wiecej-dbs lato-font">
				<a href="<?php echo the_permalink(); ?>">WIĘCEJ</a>
			</span>
		</div>
	</article>

	<?php /* KSIĄŻKI */
        ($count == 3) ? get_template_part( 'template-parts/partials/module', 'ksiazki_lista' ) : NULL; ?>

	<?php /* AUTORZY */
	if($count==6)
	{
		get_template_part( 'template-parts/partials/module', 'autorzy_carousel' );
	} //$count==6
	?>

	<?php // OBECNE I NADCHODZĄCE WYDARZENIA
        ($count == 9) ? get_template_part( 'template-parts/partials/biuletyn/module', 'wydarzenia' ) : NULL; ?>

	<?php // PROJEKTY
        ($count == 12) ? get_template_part( 'template-parts/partials/biuletyn/module', 'projekty' ) : NULL; ?>

	<?php endwhile; // end the custom loop ?>

</div>
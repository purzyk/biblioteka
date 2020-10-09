<?php
$count = 0;
if ( have_posts() ) : ?>
<div id="autorzy__lista" class="autorzy__lista_div row">
	<?php
	while ( have_posts() ) : the_post();
	++$count;
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'bl_autor');
	$image_url = $image_url[0];
	if ( empty($image_url) )
	{
		$image_url = get_template_directory_uri().'/img/placeholders/autor-placeholder-300x300.jpg';
	}
	?>
		<article id="article_<?php echo $count; ?>" class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
			<a href="<?php the_permalink();?>">
				<figure>
					<img src="<?= $image_url ?>" alt="<?php the_title(); ?>" />
				</figure>
				<span class="lato-font red">&#47;</span>
				<span class="playfair-display autorzy_lista_imie"><?php the_field('imie');?></span>  <span class="playfair-display autorzy_lista_nazwisko"><?php the_field('nazwisko');?></span>
			</a>
		</article>
	<?php endwhile; // end the custom loop ?>
</div>

<!-- pagination -->
<?php
$cur_page = intval(get_query_var('paged'));
if ($cur_page == 0)
{
	$cur_page=1;
}
?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagination_links">
	<div class="pagination">
	<span>
	<?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?>
	<span><?php echo $cur_page; ?>/<?php echo $wp_query->max_num_pages; ?></span>
	<?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?>
	</span>
	</div>
</div>
<?php endif; ?>

<?php else : ?>
<div id="autorzy__lista" class="autorzy_lista_div">
	<article>
		<p class="lato-font not-found">Nie znaleziono autorów w wybranej kategorii.</p>
	</article>
</div>
<?php endif; ?>

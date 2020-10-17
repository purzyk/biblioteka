			<section class="top_articles">
			<?php get_template_part( 'template-parts/loop', 'archwiumtop_indeks' ); ?>
			<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
    show: {
        "740px" : 1,
        "980px" : 3
    },
    pagination: false
});
			</script>

		</section>
<?php if ( have_posts() ) : ?>

	<div class="archive_breadcrumbs">
	<div class="bread_outside">
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
    </div>
</div>
<?php /*
<div class="archive_sort">
Sortuj
<select name="browsers" required>

<option value="" disabled selected>wybierz</option>
<option value="chrome">autor</option>
<option value="safari">tytuł</option>
<option value="opera">OPERA</option>

</select>
</div>
*/?>
	</div>

		

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
	<?php
echo '<article class="archive_post">'; ?>
		<a href="<?php the_permalink();?>"><?php get_template_part( 'template-parts/img', 'large' ); ?></a>
		<?php
$term =	$wp_query->queried_object; 
$tags = wp_get_post_terms($post->ID, 'cykle-nazwy');
?>
<span class="kategoria_debaty"><a href="https://www.biuroliterackie.pl/biblioteka/cykle-nazwy/<?php echo $tags[0]->slug; ?>">
<?php

		echo $tags[0]->name;
		?>
		</a></span>
 <?php 
 $cats = get_the_category();
$cat_name = "";
foreach( $cats as $cat ){
  $cat_name .= $cat -> cat_name;
}
echo $cat_name;
$terms = get_the_terms( $post->ID , 'autor' );
$typ=get_post_type( get_the_ID() ); $typ = strtolower($typ); $term_list = wp_get_post_terms($post->ID, $typ.'-kategorie', array("fields" => "all")); ?>
<?php
		echo '<h4>' . get_the_title() . '</h4>';

		echo '<div class="archive_meta">';		
	if($terms) { ?>
		<span class="archive_date"><?php the_time('d/m/Y'); ?></span>
			<span class="archive_category"><span class="big"><b><a href="<?php site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug; ?>">
			<?php echo $term_list[0]->name;  ?>
			</a></b></span></span>
		<?php foreach( $terms as $term ) {?>
		<span class="archive_name"><?php echo the_field('imie', $term);?> <span class="big"><?php echo the_field('nazwisko', $term);?></span></span>
		<?php

	}
}
 echo '</div>';
the_excerpt(); ?>

		<span class="wiecej"><a href="<?php the_permalink();?>">WIĘCEJ</a></span>
		<?php 	echo '</article>';
				?>			

			<?php endwhile; ?>

		<?php $cur_page = intval(get_query_var('paged')); if ($cur_page == 0) {$cur_page=1;} ;  ?>
<div class="pagination_links"><div class="pagination"><span><?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?><span><?php echo $cur_page; ?>/<span><?php echo $wp_query->max_num_pages;?><?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?></div></div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
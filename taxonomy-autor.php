<?php
/**
 * Template Name:Kartoteka
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header(); ?>
<div class="right_bck">

</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="archive_left">
					<div class="sidebar">
							<?php get_template_part( 'template-parts/sidebar', 'archive' ); ?>

					</div>
			</section>

			<section class="archive_right">


			<section class="top_articles">
			<?php get_template_part( 'template-parts/loop', 'archwiumtop' ); ?>
			<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
    show: {
        "740px" : 3,
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
*/ ?>
	</div>

		
<div class="przystan_o_autorze">
 <?php
 $queried_object = get_queried_object();
 ?>
 <div class="o_autorze_big">
		<div class="o_autorze_left">
			<?php 
				$image = get_field('zdjecie', $queried_object);
$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}
?>      
<?php
$term = get_queried_object();
 if( get_field('strona_autora', $term) ): ?>
<a class="strona_autora" href="<?php echo the_field('strona_autora', $term);?>">Strona AUTORA</a>
<?php endif; ?>
</div>
<div class="o_autorze_right">

	<?php 
	 $queried_object = get_queried_object();
	$term = get_queried_object();
?>
		<h6><?php echo the_field('imie', $queried_object);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span></h6>
		<p class="o_autorze_bio"><?php echo $term->description;?></p>
		
<div class="listCat">
<?php get_template_part( 'template-parts/count', 'autor' ); ?>
</div>
</div>
</div>
</div>
<div class="przystan_o_autorze">
	<div class="o_autorze_big">
		<div class="teksty_autora">

			    <?php 
			$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
			$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
			$count_wywiady = 0;
			// arguments
			$args = array(
			'post_type' => 'ksiazki',
			'post_status' => 'publish',
			'posts_per_page' => -1, // you may edit this number
			'orderby' => 'date',
			'tax_query' => array(
			    array(
			        'taxonomy' => 'autor',
			        'field' => 'id',
			        'terms' => $custom_taxterms
			    )
			),
			'post__not_in' => array ($post->ID),
			);
			$related_items = new WP_Query( $args );
			// loop over query
			if ($related_items->have_posts()) : 
$bibliografia=1;
				?>
			


<?php 
else: {
	$bibliografia=0;
	?>

<?php }
endif; ?>

<div id="tabs">
  <ul>
    <?php if ($bibliografia>0) {  ?><li><a href="#bibliografia">BIBLIOGRAFIA</a></li>
    <?php

wp_reset_postdata();
?>
   <li><a href="#zasoby">ZASOBY W BIBLIOTECE</a></li><?php } ?>
  </ul>
  <?php if ($bibliografia>0) {  ?> <div id="bibliografia">
   				<?php
				while ( $related_items->have_posts() ) : $related_items->the_post();?>
		
 <p class="tytul_ksiazki_autor"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p> 
<?php
endwhile; ?>
  </div> <?php } ?>
  <div id="zasoby">
    <?php 
$term = get_queried_object();
$termidd = $term ->term_id;
// arguments
$args = array(
'post_type' => array('wywiady','recenzje','debaty','felietony','dzwieki','nagrania','zdjecia'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $termidd
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();?>
<div class="zasob">
<p class="data_zasoby"><?php the_time('d/m/Y');?></p>
 <p class="content_zasoby">
<?php 
 if ($post->post_type == "wywiady") {
$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/wywiady/">wywiady</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
		echo 'ss';

}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/recenzje/">recenzje</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/debaty/">debaty</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';

}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/cykle/">cykle</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/dzwieki/">dźwięki</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/nagrania/">nagrania</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/zdjecia/">zdjecia</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="https://www.biuroliterackie.pl/biblioteka/utwory/">utwory</a> / <a class="cat_lin taxon" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>';
}
?>
<span class="tax-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
<span class="auth_name_zasoby"><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></span>
 </p> 
 

 </div>
<?php
endwhile;

endif;
// Reset Post Data
?>
<?php
wp_reset_postdata();
?>
  </div>

</div>



<script type="text/javascript">
	$("#tabs").tabs();
</script>

</div>



		<?php endif; ?>

		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>


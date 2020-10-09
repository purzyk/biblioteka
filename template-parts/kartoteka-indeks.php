			<section class="top_articles">
			<?php get_template_part( 'template-parts/loop', 'archwiumtop_indeks' ); ?>
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
<div class="archive_sort">
Sortuj
<select name="browsers" required>

<option value="" disabled selected>wybierz</option>
<option value="chrome">autor</option>
<option value="safari">tytuł</option>
<option value="opera">OPERA</option>

</select>
</div>
	</div>

		

		 <?php 
$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
// arguments
$args = array(
'post_type' => array('wywiady','recenzje','debaty','felietony','dzwieki','nagrania','zdjecia'),
'post_status' => 'publish',
'posts_per_page' => 50, // you may edit this number
'orderby' => 'date',
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
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">wywiady / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">recenzje / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">debaty / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">felietony / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">dzwieki / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">nagrania / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">zdjecia / <b>'.$term_list[0]->name.'</b></a></span>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<span class="category"><a class="cat_lin" href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'">utwory / <b>'.$term_list[0]->name.'</b></a></span>';
}
?>
<span class="tax-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) { ?>
		<a class="cat_lin"><span><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></span></a>
		<?php 
	}
	
} 
?>
</span>

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

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
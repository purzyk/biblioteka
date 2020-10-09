<h1 class="title_h1"><? the_title(); ?></h1>
<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) {?>
	<h4 class="title_autor"><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></h4>
	<?php

}
}
?>
<p class="excerpt"><?php $content = get_the_excerpt() ? get_the_excerpt() : get_the_content(); ?>
	<?php if(!get_the_excerpt()) { echo wp_trim_words($content, 30); } else { echo strip_tags(get_the_excerpt(), '<i></i><strong></strong><em></em><b></b>'); } ?></p>
	<?php if( get_field('imie') ): ?>
	<p class="realizator">Realizacja: <?php the_field('imie');?> <span><?php the_field('nazwisko');?></span></p>
<?php endif; ?>
	
</section>
<section class="single_right">
	<?php
	global $post;
	$content = get_post_meta( $post->ID, 'autor', true ); ?>
	<?php the_content();?>
	

</section>

<div class="auth_bottom">
<section class="single_left single_ksiazka">

<?php $terms = get_the_terms( $post->ID , 'ksiazka' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<?php 

$image = get_field('okladka', $term);
$size = 'bl_ksiazka_okladka'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}

?>
	
<span class="tytul_wydawca">Biuro Literackie </span>
<?php if( get_field('link_do_sklepu', $term) ): ?>
	<span class="kup_ksiazke"><a target="_blank" href="<?php echo the_field('link_do_sklepu', $term);?>">kup książkę na poezjem.pl</a></span>
<?php endif; ?>
	<?php } } ?>
</section>
<section class="single_right">
<div class="przystan_o_autorze">
		
<?php
	$terms = get_the_terms( $post->ID , 'autor' ); ?>
		<?php
		foreach( $terms as $term ) {
$aa1 = $term->description;
if ($aa1!=null) {
$check=1;
}
					} 
					?>
					
	<?php
	if ($check==1) {
	
	if($terms) { ?>

	<?php
	$result = count($terms);
	?>
	<?php
if ($result==0) {

} elseif ($result==1) {
?>
<h2><span>O AUTORZE</span></h2>
<?php
} else {
?>
<h2><span>O AUTORACH</span></h2>
<?php
}
?>
	<?php
		foreach( $terms as $term ) {?>
		<?php if( get_field('nazwisko', $term) ): ?>
			<div class="autor_pole">
			<div class="o_autorze_left">
		<?php
		$image = get_field('zdjecie', $term);
		$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

		if( $image ) {	
			echo wp_get_attachment_image( $image, $size );
						}?>
						</div>
						<div class="o_autorze_right">
							<h6><?php echo the_field('imie', $term);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span>
							</h6>
							<p class="o_autorze_bio"><?php echo $term->description;?></p>
							<div class="listCat">
<?php /* get_template_part( 'template-parts/count', 'autor' ); */ ?>
</div>
						</div>
						</div> 
						<?php endif; ?>
						<?php
	
					} 
				}
				}
?>	

</div>
</section>
</div>

	
<?php
$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
// arguments
$args = array(
'post_type' => 'nagrania',
'post_status' => 'publish',
'orderby' => 'date',
'order' => 'desc',
'posts_per_page' => -1, // you may edit this number
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


// The Loop
if ($related_items->have_posts()) {
$nagrania=1;
}
else {
	$nagrania=0;
}
?>
<?php if ($nagrania==1){?>
<section>
	<div class="powiazania">
		<h2><span>Filmy autora</span></h2>

		<div id="tab-one">
			<?php get_template_part( 'template-parts/loop', 'filmy_autora' ); ?>
		</div>
		
		<script type="text/javascript">
			
			$(".teksty_autora").carousel({
				show: {
					"740px" : 2,
					"980px" : 3
				},
				pagination: false
			});	
			

		</script>
		</div>
		</section>
	<?php } ?>
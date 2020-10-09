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
	<span class="strona_debaty">

	<?php
$terms = get_the_terms( $post->ID, 'debaty-glosy-kategorie' );
						
if ( $terms && ! is_wp_error( $terms ) ) : 

	$draught_links = array();

	foreach ( $terms as $term ) {
		$draught_links[] = $term->name;
	}
						
	$on_draught = join( ", ", $draught_links );
?>

	<p>strona debaty</p>

<?php endif; ?>

	
<?php $orig_post = $post;
global $post;
if ( 'debaty' == get_post_type() ) {
$tags = wp_get_post_terms($post->ID, 'debaty-glosy-kategorie');
if ($tags) {
	$tag_ids = array();

	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args=array(
		'tax_query' => array(
        array(
            'taxonomy'  => 'debaty-glosy-kategorie',
            'terms'     => $tag_ids,
            'operator'  => 'IN'
        )
    ),
    'post__not_in'          => array( $post->ID ),
    'posts_per_page'        => 20,
    'ignore_sticky_posts'   => 1,
    'meta_key'		=> 'glos',
    'meta_value'	=> 'debata'
	);
	$my_query = new wp_query( $args );

	if( $my_query->have_posts() ) { ?>
		<?php $i=1; while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

						<a href="<?php the_permalink(); ?>" class="clearfix">

							<span>
							
							
							<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) {?>
<?php the_title(); ?>
	<?php

}
}
?>
							</span>
						</a>
					<?php $i++; ?>
				<?php } ?>


	<?php }
}
}
$post = $orig_post;
wp_reset_query(); ?>



	</span>
</section>
<section class="single_right">
	<?php
	global $post;
	$content = get_post_meta( $post->ID, 'autor', true );
	echo  $content; ?>
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
	
<span class="tytul_wydawca">>Biuro Literackie </span>
<span class="kup_ksiazke"><a target="_blank" href="<?php echo the_field('link_do_sklepu', $term);?>">kup książkę na poezjem.pl</a></span>
	<?php } } ?>
</section>
<section class="single_right">

<div class="przystan_o_autorze o_autorze">


		<h2><span>O AUTORZE</span></h2>
		<div class="o_autorze_left">
			<?php 
			$terms = get_the_terms( $post->ID , 'autor' );
			if($terms) {
				foreach( $terms as $term ) {?>
				<?php
				$image = get_field('zdjecie', $term);
$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}
?>      


<?php

}
}
?>


</div>
<div class="o_autorze_right">

	<?php 
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) {
		foreach( $terms as $term ) {?>
		<h6><?php echo the_field('imie', $term);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span></h6>
		<p class="o_autorze_bio"><?php echo $term->description;?></p>
		<?php

	}
}
?>			
</div>

</div>

<div class="przystan_o_autorze glosy_w_debacie">
<?php $test = get_field('glos');?>
<?php if($test=='debata') { ?>
	<h2><span>CZYTAJ GŁOSY W DEBACIE</span></h2>
	<?php } else {?>
	<h2><span>inne głosy w debacie</span></h2>
		<?php } ?>
	
<?php $orig_post = $post;
global $post;
if ( 'debaty' == get_post_type() ) {
$tags = wp_get_post_terms($post->ID, 'debaty-glosy-kategorie');
if ($tags) {
	$tag_ids = array();

	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	$args=array(
		'tax_query' => array(
        array(
            'taxonomy'  => 'debaty-glosy-kategorie',
            'terms'     => $tag_ids,
            'operator'  => 'IN'
        )
    ),
    'post__not_in'          => array( $post->ID ),
    'posts_per_page'        => 20,
    'ignore_sticky_posts'   => 1,
    'meta_key'		=> 'glos',
    'meta_value'	=> 'glos'
	);
	$my_query = new wp_query( $args );

	if( $my_query->have_posts() ) { ?>
		<div class="related">
			<ul class="related-items clearfix">
				<?php $i=1; while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

					<li<?php if($i%2==0) echo(' class="second"'); ?>>
						<a href="<?php the_permalink(); ?>" class="clearfix">

							<span>
							
							
							<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) {?>
	<?php
				$image = get_field('zdjecie', $term);
$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}
else { ?>
	<img src="http://testowy.biz/bl/wp-content/uploads/2015/11/03-300x300.jpg">
<?php }
?> 
<?php if($test=='debata') { ?>	<?php } else {?>
<span class="data_debaty"><?php the_time('d/m/Y'); ?></span>
		<?php } ?><h4><?php the_title(); ?></h4>

	<p class="title_autor"><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></p>
	<?php

}
}
?>
							</span>
						</a>
					</li>
					<?php $i++; ?>
				<?php } ?>
			</ul>
		</div>

	<?php }
}
}
$post = $orig_post;
wp_reset_query(); ?>

</div>


</section>
</div>


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
<span class="strona_debaty">
<p>Strona cyklu</p>
<span class="kategoria_debaty">
<?php
$tags = wp_get_post_terms($post->ID, 'cykle-nazwy');?>
	
	<a href="https://www.biuroliterackie.pl/biblioteka/cykle-nazwy/<?php echo $tags[0]->slug;?> "><?php echo $tags[0]->name;?></a>
		</span>
</span>
<?php
	$terms = get_the_terms( $post->ID , 'autor' );
	if($terms) { ?>

	<?php
		foreach( $terms as $term ) {?>
		<?php if( get_field('nazwisko', $term) ): ?>
		<?php
		$image = get_field('zdjecie', $term);
		$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

		if( $image ) {	
			echo wp_get_attachment_image( $image, $size );
						}?>

							<h6><?php echo the_field('imie', $term);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span>
							</h6>
							<p class="o_autorze_bio"><?php echo $term->description;?></p>


						<?php endif; ?>
						<?php
	
					} 
				}
?>
</section>
<section class="single_right">


</section>
</section>


	

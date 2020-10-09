<h6><span>NASZE CYKLE</span></h6>
<?php
// your taxonomy name
$tax = 'cykle-nazwy';

// get the terms of taxonomy
$terms = get_terms( $tax, $args = array(
  'hide_empty' => false, // do not hide empty terms
));

// loop through all terms
?>
<div class="typ_small"><div class="archwiumtop_carousell">
<?php
foreach( $terms as $term ) {
?>

<article>
<?php
	$termm = get_field('kategoria_nadrzedna', $term);
	if( $termm ): 
	$terma = get_term( $termm, 'felietony-kategorie' );

		?>



<?php endif; ?>
<a href="https://www.biuroliterackie.pl/biblioteka/cykle-nazwy/<?php echo $term->slug;?>">
<?php 
$couleur = get_field('zdjecie_glowne_cyklu', $term);
$size = 'bl_small'; // (thumbnail, medium, large, full or custom size)

if( $couleur ) {

	echo wp_get_attachment_image( $couleur, $size );

}
else { ?>
<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-470x213.jpg" alt="<?php the_title(); ?>" />
<?php }
?>

<div class="reveal">
<p><?php the_field('field_name', $term); ?></p>
<span class="category"><?php echo $terma->name;?></span>
		<h4><?php echo $term->name; ?></h4>
		<?php $termmb = get_field('autor_cyklu', $term);
if( $termmb ):

$number = $termmb[0];
$termav = get_term( $number, 'autor' );



		?>


<?php endif; ?>


		<h5><?php echo $termav->name;?></h5>
<script type="text/javascript">
	$.fn.wrapStart = function(numWords){
	return this.each(function(){
		$this = $(this);
		var node = $this.contents().filter(function(){
			return this.nodeType == 3
		}).first(),
		text = node.text(),
		first = text.split(" ", numWords).join(" ");
		if (!node.length) return;
		node[0].nodeValue = text.slice(first.length);
		node.before('<span>' + first + '</span>');
	});
};

$("h5").wrapStart(1);
</script>
		</div>
</a>
</article>
<?php

}

?>
</div></div>

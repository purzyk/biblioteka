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
	<section class="single_ksiazka">

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
	<?php /*	<span class="ksiazka_autor"><?php echo the_field('imie_autora_ksiazki', $term);?>&nbsp;<span class="auth_nazwisko"><?php echo the_field('nazwisko_autora_ksiazki', $term);?></span><span>*/?>
	
<span class="tytul_wydawca"><?php /*<span class="bold_italic"><?php echo $term->name; ?> / </span>*/?>Biuro Literackie </span>
<?php if( get_field('link_do_sklepu', $term) ): ?>
	<span class="kup_ksiazke"><a target="_blank" href="<?php echo the_field('link_do_sklepu', $term);?>">kup książkę na poezjem.pl</a></span>
<?php endif; ?>
	<?php } } ?>
</section>
</section>
<section class="single_right">
	<?php
	global $post;
	$content = get_post_meta( $post->ID, 'autor', true ); ?>
	<?php the_content();?>
	
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
<?php /* get_template_part( 'template-parts/count', 'autor' );*/ ?>
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

<div class="auth_bottom">

<section class="single_right">

</section>
</div>

	

<section>
<?php

// The Query
$custom_taxterms = wp_get_object_terms( $post->ID, 'ksiazka', array('fields' => 'ids') );
$count_wywiady = 0;
// arguments
$args = array(
	'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
'order' => 'desc',
'tax_query' => array(
    array(
        'taxonomy' => 'ksiazka',
        'field' => 'id',
        'terms' => $custom_taxterms
    )
),
'post__not_in' => array ($post->ID),
);
$related_items = new WP_Query( $args );

// The Loop
if ( $related_items->have_posts() ) {

$o_ksiazce=1;
	}
	else {
$o_ksiazce=0;
	}


$custom_taxterms2 = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
// arguments
$args = array(
	'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
'order' => 'desc',
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $custom_taxterms2
    )
),
'post__not_in' => array ($post->ID),
);
$related_items = new WP_Query( $args );

// The Loop
if ( $related_items->have_posts() ) {
	$tek_autora=1;
}
else {
	$tek_autora=0;
};


$custom_taxterms3 = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
// arguments
$args = array(
	'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
'order' => 'desc',
'meta_key'		=> 'o_autorze',
	'meta_value'	=> $custom_taxterms3,
'post__not_in' => array ($post->ID),
);
$related_items = new WP_Query( $args );

// The Loop
if ( $related_items->have_posts() ) {
	$tek_o_autorze=1;
}
else {
	$tek_o_autorze=0;
};
	?>

		<div id="tabs" class="powiazania">
		<?php if ($tek_o_autorze>0||$tek_autora||$o_ksiazce) {?><h2><span>powiązania</span></h2> <?php } ?>
   <ul>
       <?php if ($tek_autora>0) { ?> <li><a href="#teksty_autora">TEKSTY AUTORA</a></li><?php } ?>
          <?php if ($o_ksiazce>0) { ?><li><a href="#teksty_o_ksiazce">TEKSTY O KSIĄŻCE</a>
        </li><?php } ?>
          <?php if ($tek_o_autorze>0) { ?><li><a href="#teksty_o_autorze">TEKSTY O AUTORZE</a>
        </li><?php } ?>
    </ul>
    <?php if ($tek_autora>0) { ?> <div id="teksty_autora">
        <?php get_template_part( 'template-parts/loop', 'teksty_autora' ); ?>
    </div><?php } ?>
    <?php if ($o_ksiazce>0) { ?>  <div id="teksty_o_ksiazce">
      <?php get_template_part( 'template-parts/loop', 'teksty_o_ksiazce' ); ?>
    </div><?php } ?>
     <?php if ($tek_o_autorze>0) { ?>  <div id="teksty_o_autorze">
      <?php get_template_part( 'template-parts/loop', 'teksty_o_autorze' ); ?>
    </div><?php } ?>

</div>
<script type="text/javascript">
	$("#tabs").tabs({                                                                  
            activate:function(event,ui){                                                       
                            $(".teksty").carousel("resize")                                                  
                    }                                                                          
         });
	$(document).ready(function(){ 
			$(".teksty").carousel({
				show: {
					"740px" : 2,
					"980px" : 3
				},
				pagination: false
			});	

});
</script>

		</section>
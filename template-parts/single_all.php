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
			</section>
			<section class="single_right">
			<?php
			global $post;
$content = get_post_meta( $post->ID, 'autor', true );
echo  $content; ?>
				<?php the_content();?>
				


					<div class="przystan_o_autorze">
	
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
	<h6><?php echo the_field('imie', $term);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span><span class="ur">ur. <?echo the_field('data_urodzenia', $term);?> r.</span></h6>
<span class="o_autorze_bio"><?php echo $term->description;?></span>
	<?php
		
	}
}
 ?>


			
			<div class="listCat">
                         KSIĄŻKI <span><a href="http://portliteracki.pl/przystan/leksykon/autor/zbigniew_solski/teksty/ksiazki/">(0)</a></span>                          
                         UTWORY <span><a href="http://portliteracki.pl/przystan/leksykon/autor/zbigniew_solski/teksty/utwory-2/">(0)</a></span> 
                         SZKICE <span><a href="http://portliteracki.pl/przystan/leksykon/autor/zbigniew_solski/teksty/szkice-3/">(2)</a></span> 
                         ROZMOWY <span><a href="http://portliteracki.pl/przystan/leksykon/autor/zbigniew_solski/teksty/rozmowy/">(0)</a></span>
                         RECYTACJE <span><a href="http://portliteracki.pl/przystan/leksykon/autor/zbigniew_solski/teksty/recytacje-2/">(0)</a></span>
						 </div>
		</div>
		
	</div>

			</section>
		<section>
		<div class="powiazania">
<h2><span>powiązania</span></h2>

<nav>
    <a href="#tab-one" class="tab" data-tabs-group="tab-group">Teksty autora</a>
    <a href="#tab-two" class="tab" data-tabs-group="tab-group">teksty o książce</a>
    <a href="#tab-three" class="tab" data-tabs-group="tab-group">teksty o autorze</a>
</nav>
<div id="tab-one">
<?php get_template_part( 'template-parts/loop', 'teksty_autora' ); ?>
</div>
<div id="tab-two">
 <?php get_template_part( 'template-parts/loop', 'teksty_o_ksiazce' ); ?>

</div>
<div id="tab-three">
   <?php get_template_part( 'template-parts/loop', 'teksty_o_autorze' ); ?>

</div>
<script type="text/javascript">
$(".tab").tabs();
$(".teksty_autora").carousel({
    show: {
        "740px" : 2,
        "980px" : 3
    },
    pagination: false
});	
$(".fs-tabs__1").click(function(){
    $(".teksty_o_ksiazce").carousel({
    show: {
        "740px" : 2,
        "980px" : 3
    },
    pagination: false
});
});
$(".fs-tabs__2").click(function(){
    $(".teksty_o_autorze").carousel({
    show: {
        "740px" : 2,
        "980px" : 3
    },
    pagination: false
});
});

</script>


</div>
</section>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
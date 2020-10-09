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
	<?php
	global $post;
	$content = get_post_meta( $post->ID, 'autor', true ); ?>
	<?php the_content();?>
 <?php previous_post_link('%link', 'Previous in category', TRUE); ?> 
 <?php
 // get_posts in same custom taxonomy
 $the_terms = get_the_term_list($post->ID, 'cykle-nazwy');
$postlist_args = array(
   'posts_per_page'  => -1,
   'orderby'         => 'date',
   'order'           => 'desc',
   'post_type'       => 'felietony',
   'your_custom_taxonomy' => 'cykle-nazwy',
   'tax_query' => array(
        array(
            'taxonomy' => 'cykle-nazwy',
            'field' => 'slug',
            'terms' => $the_terms
        )
    )
); 
$postlist = get_posts( $postlist_args );

// get ids of posts retrieved from get_posts
$ids = array();
foreach ($postlist as $thepost) {
   $ids[] = $thepost->ID;
}

// get and echo previous and next post in the same taxonomy        
$thisindex = array_search($post->ID, $ids);
$previd = $ids[$thisindex-1];
$nextid = $ids[$thisindex+1];
?>
<div class="cykle_next_prev">


<?php
if ( !empty($previd) ) {
   echo '<a class="poprzedni" rel="prev" href="' . get_permalink($previd). '">nowszy wpis</a>';
}
if ( !empty($nextid) ) {
   echo '<a  class="nastepny" rel="next" href="' . get_permalink($nextid). '">starszy wpis</a>';
}
?>
</div>
</section>
</section>


	

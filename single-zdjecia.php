<?php
/**
* The template for displaying all single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package biblioteka
*/
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<section class="single_left">
				<?php $categories = get_terms('utwory-kategorie');
				$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
				echo '<span class="category">zdjęcia / <b>'.$term_list[0]->name.'</b></span>';
				?>
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

$images = get_field('galeria');

if( $images ): ?>
    <ul class="galeria">
        <?php foreach( $images as $image ): ?>
            <li>
                <a rel="lightbox" href="<?php echo $image['url']; ?>">
                     <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
            </li>
        <?php endforeach; ?>
    </ul>


<?php endif; ?>
	<?php
	global $post;
	$content = get_post_meta( $post->ID, 'autor', true );
	echo  $content; ?>
	<?php the_content();?>
	


	

</section>
<section>
	<div class="powiazania">
		<h2><span>INNE GALERIE</span></h2>

		<div id="tab-one">
			<?php get_template_part( 'template-parts/loop', 'inne_galerie' ); ?>
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
	<?php endwhile; // End of the loop. ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
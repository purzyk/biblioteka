<?php
$featured_posts = get_field('ksiazki');
if( $featured_posts ): ?>
    <div class="js-ksiazki">

    <?php foreach( $featured_posts as $post ):
setup_postdata($post); 
$term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
        ?>
		<article class="custom-type-1"><div class="ksiazki_left">			
			<div class="title_ksiazki">
			<span class="category"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"> <?php echo $term_list[0]->name; ?></a></span>
			<div>
			<?php
		$terms = get_the_terms($post->ID, 'autor');
		if ($terms)
		{
			foreach($terms as $term)
			{ ?>
		<span class="imie"><?php
				echo the_field('imie', $term); ?><span class="nazwisko"> <?php
				echo the_field('nazwisko', $term); ?></span></span>
		<?php
			}
		}

?>	
</div>	
<h4><a class="post-url" href="<?php
		the_permalink(); ?>"> <?php
		the_title(); ?></a></h4> 
</div>

<a href="<?php
		the_permalink(); ?>"> <?php
		the_excerpt(); ?> </a>
		<span class="wiecej"><a href="<?php
		the_permalink(); ?>">WIĘCEJ</a></span>		
		</div><div class="ksiazki_right">		
		<a href="<?php
		the_permalink(); ?>"> <?php
		get_template_part('template-parts/img', 'ksiazka'); ?> </a>
		 </div></article>
        <?php  endforeach; ?>
        <?php wp_reset_postdata(); ?>

    </div>
   
<?php endif; ?>
<script>
$('.js-ksiazki').slick({
    infinite: true,
    dots: false,
});
</script>
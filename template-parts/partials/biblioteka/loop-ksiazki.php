<?php
$latest_post_date = wp_list_pluck( get_posts( array('post_type' => 'ksiazki','posts_per_page' => 1) ), 'post_date' );

$the_query = new WP_Query(array(
	'post_type' => 'ksiazki',
	'date_query' => array(
        array(
            'after'     => date('Y-m-d', strtotime($latest_post_date[0] . '-3 days')),
            'before'    => date('Y-m-d', strtotime($latest_post_date[0]) ),
            'inclusive' => true,
        ),
    ),
));

// The Loop

if ($the_query->have_posts())
{
	echo '<div class="ksiazki_carousel">';
	while ($the_query->have_posts())
	{
		echo '<article class="custom-type-1">';
		echo '<div class="ksiazki_left">';
		$the_query->the_post();
		$categories = get_terms('ksiazki-kategorie'); ?>
			<div class="premiera_ksiazki">
				<span class="premiera">
					Premiera
				</span>
				<span class="ksiazki_data">
					<?php
		the_field('data_premiery'); ?>
				</span>

			</div>
			<div class="title_ksiazki">
			<div>
			<?php /* $term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
		echo '<span class="category"><a href="'.site_url().'/'.$term_list[0]->taxonomy .'/'.$term_list[0]->slug.'"><b>'.$term_list[0]->name.'</b></a></span>'; */ ?>
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
		<?php
		echo '</div>';
		echo '<div class="ksiazki_right">'; ?>
		<a href="<?php
		the_permalink(); ?>"> <?php
		get_template_part('template-parts/img', 'ksiazka'); ?> </a> <?php
		echo '</div>';
		echo '</article>';
	}
}

echo '</div>';
/* Restore original Post Data */
wp_reset_postdata();
?>
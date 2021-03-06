<?php
$meta_query = array(
    'relation' => 'OR',
);

if( have_rows('autorzy_r') )
{
    $i = 0;
    while ( have_rows('autorzy_r') ) : the_row();
    
        $meta_query[] = array(
            'relation' => 'AND',
            array(
                'key' => 'autorzy_r_%_imie',
                'value'   => get_sub_field('imie'),
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'autorzy_r_%_nazwisko',
                'value'   => get_sub_field('nazwisko'),
                'compare' => 'LIKE'
            ),
        );
    $i++;
    if($i==3) break;
    endwhile;
}


//print_r($meta_query);
//var_dump(get_post_meta( get_the_ID(), 'autorzy_r', true ));

$count = 0;
$classes = array(
	'row',
	'row-eq-height',
);

$poezjem_args = array(
	'post_type'  => 'ksiazki_lista',
    'posts_per_page' => 8,
    'post__not_in' => array($post->ID),
	'meta_key'   => 'data',
	'orderby'    => 'meta_value_num',
	'order'      => 'DESC',
    'tax_query' => array(
		array(
			'taxonomy' => 'ksiazki_wydawca',
			'field'    => 'slug',
			'terms'    => 'biuro-literackie',
		),
	),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'autorzy_r_0_imie',
            'value'   => get_post_meta( $post->ID, 'autorzy_r_0_imie', true ),
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'autorzy_r_0_nazwisko',
            'value'   => get_post_meta( $post->ID, 'autorzy_r_0_nazwisko', true ),
            'compare' => 'LIKE'
        )
    ),
);

$poezjem_query = new WP_Query( $poezjem_args );

if ( $poezjem_query->have_posts() ) : ?>
<style>

</style>
<div class="clearfix"></div>
<section id="ksiazki__more-books">
	<h2 class="biuletyn_subtitle">
		<span class="lato-font">inne książki autora</span>
	</h2>

	<div class="module__ksiazki_lista row">
		<?php
		while ( $poezjem_query->have_posts() ) : $poezjem_query->the_post();
		$count++;
		$id = $post->ID;
		$term_list = wp_get_post_terms($post->ID, 'ksiazki_serie', array("fields" => "all"));
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'bl_ksiazka_okladka');
		$image_url = $image_url[0];

		$originalDate = get_field('data');
		$newDate = date("d/m/Y", strtotime($originalDate));

		if ( !has_post_thumbnail() )
		{
			$image_url = "https://placeholdit.imgix.net/~text?txtsize=27&txt=284×400&w=284&h=400";
		}

		$autor = '<br>';
		if ( get_field('imie', $id) )
		{
			$autor = get_field('imie', $id);
			$autor .= ' ';
			$autor .= mb_strtoupper(get_field('nazwisko', $id), 'UTF-8');
		}
		?>
		<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-6 col-lg-offset-0">
			<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
				<figure class="col-xs-12 col-sm-6 col-md-6">
					<a href="<?php the_permalink(); ?>" target="_blank" title="więcej">
						<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
					</a>
				</figure>

				<div class="col-xs-12 col-sm-6 col-md-6">
					<h3 class="playfair-display"><?php echo $autor; ?></h3>
					<h4 class="playfair-display"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<div class="lato-font">
						<span class="data_data-dbs"><?php echo $newDate; ?></span>
						<?php if ( !empty($term_list) ) : ?>
						<span class="data_cat-dbs"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
						<?php endif; ?>
					</div>

					<span class="lato-font">
						<a href="<?php the_permalink(); ?>" target="_blank">WIĘCEJ</a>
					</span>
				</div>
			</article>
		</div>
	<?php endwhile; ?>
</div>

</section>
<?php wp_reset_postdata(); ?>
<?php endif; ?>

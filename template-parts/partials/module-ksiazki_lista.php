<?php
$today = getdate();
$post_type = get_query_var( 'post_type' ) ? get_query_var( 'post_type' ) : 'biuletyn';
$ksiazki_args = array(
    'meta_query' => array(
        array(
            'key' => 'data',
            'value' => date("Y-m-d", strtotime("-1 year")),
            'compare' => '>='
        ),
        array(
            'key'     => 'data',
            'value'   => date("Y-m-d"),
            'compare' => '<='
        )
    ),
	'post_type' => 'ksiazki_lista',
	'orderby' => 'meta_value',
	'meta_key' => 'data',
	'posts_per_page'=> 15
);

$ksiazki_query = new WP_Query( $ksiazki_args );

if ( $ksiazki_query->have_posts() ) : ?>
<section id="<?php echo $post_type; ?>__ksiazki-lista" class="module__ksiazki_lista <?php echo $post_type; ?>_ksiazki-lista">

	<h2 class="<?php echo $post_type; ?>__module-subtitle">
        <span><a href="<?php echo get_post_type_archive_link('ksiazki_lista'); ?>"><?php _e( 'książki', 'biblioteka' ); ?></a></span>
    </h2>

		<ul>
		<?php
		while ( $ksiazki_query->have_posts() )
		{
			$ksiazki_query->the_post();
            
			$link = get_permalink();
			$tytul = get_the_title();
			
            $autor = '<br>';
            if( have_rows('autorzy_r') )
            {
                $autor = get_field('autorzy_r_0_imie');
				$autor .= ' ';
				$autor .= mb_strtoupper(get_field('autorzy_r_0_nazwisko'), 'UTF-8');
                
                if ( get_field('autorzy_r_1_imie') )
                {
                    $autor = 'Rożni AUTORZY';
                }
            }
            
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id,'bl_ksiazka_okladka');
			$image_url = $image_url[0];
		?>
			<li>
			<a href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
				<div>
					<img src="<?php echo $image_url; ?>" width="300" />
				</div>
				<div>
					<div class="playfair-display"><?php echo $autor; ?></div>
					<div class="playfair-display"><?php echo $tytul; ?></div>
				</div>
			</a>
			</li>
		<?php
		} //while have_posts()
		wp_reset_postdata();
		?>
		</ul>
		
</section>
<script type="text/javascript">
	jQuery(".module__ksiazki_lista ul").carousel({
		show: 5,
		pagination: false
	});
</script>
<?php endif; //if have_posts() ?>

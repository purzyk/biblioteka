<?php
$post_type = get_query_var( 'post_type' ) ? get_query_var( 'post_type' ) : 'biuletyn';
$autorzy_args = array(
    'post_type' => 'autorzy_lista',
    'autorzy_lista_kategorie' => 'nasi-autorzy',
    'meta_query' => array(
    array(
        'key' => 'nazwisko',
        'value'   => array(''),
        'compare' => 'NOT IN'
    )
    ),
    'meta_key' => 'nazwisko',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'paged' => $paged,
    'posts_per_page'=> 15
);

// new instance of WP_Query
$autorzy_query = new WP_Query( $autorzy_args );

if ( $autorzy_query->have_posts() )
{
?>
<section id="<?php echo $post_type; ?>__autorzy" class="<?php echo $post_type; ?>_autorzy">

    <h2 class="<?php echo $post_type; ?>__module-subtitle">
        <span><a href="<?php echo get_post_type_archive_link('autorzy_lista'); ?>"><?php _e( 'autorzy', 'biblioteka' ); ?></a></span>
    </h2>

    <ul>
        <?php
        while ( $autorzy_query->have_posts() )
        {
            $autorzy_query->the_post();
            
            $k = $post->ID;
            $link = get_permalink( $k );
            $autor = get_the_title();
            if ( get_field('imie', $k) && get_field('nazwisko', $k) )
            {
                $autor = get_field('imie', $k);
                $autor .= ' ';
                $autor .= mb_strtoupper(get_field('nazwisko', $k), 'UTF-8');
            }

            $cover_img_id = get_post_meta( $post->ID, 'duze_zdjecie_na_tlo', true );
            $image_id = get_post_thumbnail_id();
            $image_url = $cover_img_id ? wp_get_attachment_image_src($cover_img_id,'bl_biuletyn_autor') : wp_get_attachment_image_src($image_id,'bl_biuletyn_autor');
            $image_url = (!empty($image_url)) ? $image_url[0] : get_template_directory_uri().'/img/placeholders/autor-placeholder.jpg';        
            ?>
            
            <li>
                <a href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                    <img src="<?php echo $image_url; ?>" />
                    <div class="<?php echo $image_id; ?> playfair-display autor"><span><?php echo $autor; ?></span></div>
                </a>
            </li>
            
        <?php
        } //endwhile have_posts()
        ?>
    </ul>
</section>
<script type="text/javascript">
$("#<?php echo $post_type; ?>__autorzy ul").carousel({
show: 3,
pagination: false
});
</script>
<?php
wp_reset_postdata();
} //endif have_posts()
?>

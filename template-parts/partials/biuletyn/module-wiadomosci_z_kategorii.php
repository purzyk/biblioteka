<?php
/*
* 
* INNE WIADOMOŚCI Z KATEGORII
* 
* single-biuletyn.php
* 
*/

$term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all")); 
$term_id = !empty($term_list) ? $term_list[0]->term_id : "";

$args = array(
    'posts_per_page'=> 10,
    'post__not_in' => array($post->ID),
    'post_type' => 'biuletyn',
    'tax_query' => array(
        array(
            'taxonomy' => 'biuletyn_kategorie',
            'field'    => 'term_id',
            'terms'    => $term_id,
        )
    ),
);

$similar_query = new WP_Query( $args );

if( $similar_query->have_posts() ): ?>

<div class="similar-posts">
    <div><span class="lato-font"><?php _e( 'inne wiadomości z kategorii', 'biblioteka' ); ?></span></div>
    <div class="fs-carousel-dubas">
        <?php
        while( $similar_query->have_posts() ) : $similar_query->the_post();
        // Okładka
        $similar_img_id = get_post_thumbnail_id();
        $similar_img_url = wp_get_attachment_image_src($similar_img_id,'large');
        $similar_img_url = $similar_img_url[0];

        if ( !empty($similar_img_id) ) :
        ?>
        <div class="similar-post" style="background-image: url(<?php echo $similar_img_url; ?>)">
            <span class="tungsten-medium">
                <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                    <span class="title"><?php echo sanitize_text_field(get_the_title()); ?></span>
                    <span class="excerpt"><?php the_excerpt(); ?></span>
                </a>
            </span>
        </div>
        <?php endif; //!empty($similar_img_id) ?>
        <?php endwhile; ?>
    </div>
</div>
<script>
    $(".similar-posts .fs-carousel-dubas").carousel({
        infinite: true,
        theme: "",
        pagination: false
    });
</script>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
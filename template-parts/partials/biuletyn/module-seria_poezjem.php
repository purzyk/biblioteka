<?php
/*
 * 
 * KSIĄŻKI Z SERII POEZJA W POEZJEM.PL
 * 
 * single-biuletyn.php
 * single-projekty.php
 * 
 */

$poezja_args = array(
    'posts_per_page'=> 10,
    'post_type'		=> 'ksiazki_lista',
    'meta_key'		=> 'seria',
    'meta_value'	=> 'Poezje'
);

$poezja_query = new WP_Query( $poezja_args );

if( $poezja_query->have_posts() ): ?>
<div id="module__seria-poezjem">
    <div>
        <span class="item-image item-image-poezja">
            <img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/10/poezja-w-poezjem.jpg" />
        </span>
        <span class="tungsten-medium title">
            <?php _e( 'książki z serii poezja w poezjem.pl', 'biblioteka' ); ?>
        </span>
    </div>
    <?php
    while( $poezja_query->have_posts() ) : $poezja_query->the_post();

    // Okładka
    $book_img_id = get_post_thumbnail_id();
    $book_img_url = wp_get_attachment_image_src($book_img_id,'bl_large');
    $book_img_url = $book_img_url[0];
    $book_url = get_the_permalink();
    $galeria = get_field('galeria');
    $link_do_poezjem = get_field('link_do_poezjem');

    if ( $link_do_poezjem )
    {
        $book_url = $link_do_poezjem;
    }

    if ( $galeria )
    {
        $book_img_url= $galeria[0]['sizes']['bl_large'];
    }
    ?>
    <div>
        <span class="item-image item-image-poezja">
            <a href="<?php echo $book_url; ?>" target="_blank" title="<?php the_title(); ?>">
                <img src="<?php echo $book_img_url; ?>" />
            </a>
        </span>
        <span class="tungsten-medium title">
            <a href="<?php echo $book_url; ?>" target="_blank" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
        </span>
    </div>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>
<script>
    $("#module__seria-poezjem").carousel({
        infinite: true,
        theme: "",
        pagination: false
    });
</script>
<?php endif; ?>

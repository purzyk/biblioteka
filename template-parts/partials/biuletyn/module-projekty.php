<?php
/*
* 
* PROJEKTY
* 
* single-biuletyn.php (single)
* single-projekty.php (single)
* loop-biuletyn.php (archive)
* 
*/

$post_type = get_query_var( 'post_type' ) ? get_query_var( 'post_type' ) : 'biuletyn';

$args = array(
    'post_type' => 'projekty',
    'posts_per_page'=> 8
);

$projekty_query = new WP_Query( $args );

if ( $projekty_query->have_posts() ) : ?>

<section id="<?php echo $post_type; ?>__projekty" class="module__projekty <?php echo $post_type; ?>_projekty">

    <h2 class="<?php echo $post_type; ?>__module-subtitle">
        <span><?php _e( 'projekty', 'biblioteka' ); ?></span>
    </h2>

    <ul>
        <?php
        while ( $projekty_query->have_posts() ) : $projekty_query->the_post();

        $id = $post->ID;
        $link = get_permalink();
        $tytul = get_the_title();
        $kat = wp_get_post_terms($id, 'projekty_kategorie', array("fields" => "all"));

        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id,'bl_large');
        $image_url = $image_url[0];
        if ( empty($image_url) )
        {
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
            $image_url = ( !empty($image_url) ) ? $matches[1][0] : "//placeholdit.imgix.net/~text?txtsize=58&txt=619×417&w=619&h=417";;
        }
        ?>
        <li>
            <a href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
                <div>
                    <img src="<?php echo $image_url; ?>" />
                </div>
                <div>
                    <div class="transition-300-ease">
                        <div class="lato-font"><?php echo ( !empty($kat) ) ? $kat[0]->name : NULL; ?></div>
                        <div class="playfair-display"><?php echo $tytul; ?></div>
                    </div>
                </div>
            </a>
        </li>
        <?php
        endwhile; //while have_posts()
        wp_reset_postdata();
        ?>
    </ul>

</section>

<script type="text/javascript">
    jQuery(".module__projekty ul").carousel({
        show: 2,
        pagination: false
    });
</script>

<?php endif; //if have_posts() ?>

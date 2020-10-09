<?php // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
$book_name = get_the_title();
$book_term = get_term_by('name', $book_name, 'ksiazka');
$book_id = $book_term ? $book_term->term_id : "";

$typ_postu = array();
$typ_postu['wywiady']['taxonomy'] = 'wywiady-kategorie';
$typ_postu['recenzje']['taxonomy'] = 'recenzje-kategorie';
$typ_postu['ksiazki']['taxonomy'] = 'ksiazki-kategorie';
$typ_postu['utwory']['taxonomy'] = 'utwory-kategorie';
$typ_postu['debaty']['taxonomy'] = 'debaty-kategorie';
$typ_postu['felietony']['taxonomy'] = 'felietony-kategorie';
$typ_postu['dzwieki']['taxonomy'] = 'dzwieki-kategorie';
$typ_postu['nagrania']['taxonomy'] = 'nagrania-kategorie';
$typ_postu['zdjecia']['taxonomy'] = 'zdjecia-kategorie';

$about_book_args = array(
    'posts_per_page'=> -1,
    'post_type' => array( 'wywiady', 'recenzje', 'ksiazki', 'utwory', 'debaty', 'felietony', 'dzwieki', 'nagrania', 'zdjecia' ),
    'tax_query' => array(
        array(
            'taxonomy' => 'ksiazka',
            'field'    => 'term_id',
            'terms'    => $book_id
        ),
    ),
);
$about_book_query = new WP_Query( $about_book_args );

if( $about_book_query->have_posts() ) : ?>

<section id="biueletyn__materialy-o-ksiazce">
    <h2 class="biuletyn_subtitle"><span class="lato-font"><?php _e( 'teksty i materiały o książce w bibliotece', 'biblioteka' ); ?></span></h2>
    <div id="materialy-o-ksiazce">
        <ul class="post-o-ksiazce">
            <?php
            while( $about_book_query->have_posts() ) : $about_book_query->the_post();
                
            //var_dump($post->post_type);
                //echo $typ_postu[$post->post_type]['taxonomy'];
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_autor');
                $image_url = $image_url[0];
                if ( empty($image_url) )
                {
                    $image_url = "//placeholdit.imgix.net/~text?txtsize=36&txt=381×212&w=381&h=212";
                }
                $excerpt = strip_tags( apply_filters('the_excerpt', get_post_field('post_excerpt', $post->ID)), '<em>' );
                $kategoria = wp_get_post_terms($post->ID, $typ_postu[$post->post_type]['taxonomy'], array("fields" => "all"));
                ?>
                
                <li>
                    <a href="<?php echo get_permalink($id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>">
                        <img src="<?php echo $image_url; ?>" width="381" height="212" />
                    </a>
                    <?php if ( !empty($kategoria[0]) ) : ?>
                    <span class="lato-font kategoria">
                        <a class="transition-300-ease" href="<?php echo get_term_link($kategoria[0]->term_id); ?>" target="_blank"><?php echo $kategoria[0]->name; ?></a>
                    </span>
                    <?php else : ?>
                    <span class="lato-font kategoria"><br /></span>
                    <?php endif; ?>
                    <a class="tungsten-semibold transition-300-ease title" href="<?php echo get_permalink($id); ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank"><?php echo get_the_title($id); ?></a>
                    <span class="playfair-display excerpt"><?php echo $excerpt; ?></span>
                    <span class="lato-font wiecej-button">
                        <a class="transition-300-ease" href="<?php echo get_permalink($id); ?>" target="_blank" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>"><?php _e( 'więcej', 'biblioteka' ); ?></a>
                    </span>
                </li>
                
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
</section>
<script type="text/javascript">
jQuery(".post-o-ksiazce").carousel({
    show: {
        "740px" : 1,
        "1163px" : 3
    },
    pagination: false
});
</script>
<?php endif; //if( $about_book_query->have_posts() ) ?>
<?php // end TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE ?>
<?php
/*
* 
* TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
* 
* single-biuletyn.php
* 
*/

$book = get_the_terms( $post->ID, 'ksiazka' );
$book_id = $book ? $book[0]->term_id : "";

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

$typ_postu = array();

foreach ( $about_book_args['post_type'] as $t )
{
    switch ($t)
    {
        case "ksiazki":
            $typ_postu[$t]['nazwa'] = 'książki';
            break;
        case "felietony":
            $typ_postu[$t]['nazwa'] = 'cykle';
            break;
        case "dzwieki":
            $typ_postu[$t]['nazwa'] = 'dźwięki';
            break;
        case "zdjecia":
            $typ_postu[$t]['nazwa'] = 'zdjęcia';
            break;
        default:
        $typ_postu[$t]['nazwa'] = $t;
        break;
    }
    $typ_postu[$t]['taxonomy'] = $t.'-kategorie';
}

if( $about_book_query->have_posts() )
{
    while( $about_book_query->have_posts() ) : $about_book_query->the_post();

        if ( count($typ_postu[$post->post_type]['ID']) < 6 )
        {
            $typ_postu[$post->post_type]['status'] = 1;
            $typ_postu[$post->post_type]['ID'][$post->ID] = $post->ID; 
        }

    endwhile;
    wp_reset_postdata();
?>
<section id="biueletyn__materialy-o-ksiazce">
<div class="similar-posts">
    <div class="tytulMaterialy"><span class="lato-font"><?php _e( 'teksty i materiały o książce w bibliotece', 'biblioteka' ); ?></span></div>
    </div>
    

    <div id="materialy-o-ksiazce">
        <ul class="lato-font kategorie">
        <?php foreach ( $typ_postu as $typ => $t) : ?>
            <?php if ( !empty($t['status']) && $t['status'] == 1 ) : ?>
            <li>
                <a class="transition-300-ease" href="#<?php echo urlencode( mb_strtolower($typ,'UTF-8') ); ?>">
                    <?php echo $t['nazwa']; ?>
                </a>
            </li>
            <?php else : ?>
            <li style="color: #d0d0d0"><?php echo $t['nazwa']; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>

        <?php foreach ( $typ_postu as $typ => $t) : ?>
            <?php if ( !empty($t['status']) && $t['status'] == 1 ) : ?>
                <div id="<?php echo urlencode( mb_strtolower($typ,'UTF-8') ); ?>">
                    <ul class="post-o-ksiazce">
                    <?php
                    foreach ( $t['ID'] as $id ) :
    
                    $image_id = get_post_thumbnail_id($id);
                    $image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_autor');
                    $image_url = ( !empty($image_url) ) ? $image_url[0] : "//placeholdit.imgix.net/~text?txtsize=36&txt=381×212&w=381&h=212";
        
                    $excerpt = strip_tags( apply_filters('the_excerpt', get_post_field('post_excerpt', $id)), '<em>' );
                    $kategoria = wp_get_post_terms($id, $t['taxonomy'], array("fields" => "all"));
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
                    <?php endforeach; //foreach ( $t['ID'] as $id ) ?>
                    </ul>
                </div>
            <?php endif; // if ( $t['status'] == 1 ) ?>
        <?php endforeach; //foreach ( $typ_postu as $typ => $t) ?>
    </div>
</section>

<script type="text/javascript">
jQuery(function() {
    jQuery(".ui-tabs-anchor").click(function(evt) {
        jQuery(".post-o-ksiazce").carousel("reset");
        evt.preventDefault();
    })
});
jQuery(".post-o-ksiazce").carousel({
    show: {
        "740px" : 2,
        "1163px" : 3
    },
    pagination: false
});
jQuery( "#materialy-o-ksiazce" ).tabs();
</script>

<?php } //if( $about_book_query->have_posts() )	?>

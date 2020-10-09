<?php // TEKSTY I MATERIAŁY O AUTORZE W BIBLIOTECE
$autor_name = get_the_title();
$autor_term = get_term_by('name', $autor_name, 'autor');
$autor_id = $autor_term ? $autor_term->term_id : "";
$autor_tag = get_term_by('name', $autor_name, 'post_tag');
//var_dump($autor_term);
$about_author_args = array(
    'posts_per_page'    => -1,
    'post_type'         => array( 'wywiady', 'recenzje', 'ksiazki', 'utwory', 'debaty', 'felietony', 'dzwieki', 'nagrania', 'zdjecia' ),
    'tax_query'         => array(
        array(
            'taxonomy' =>   'autor',
            'field'    =>   'term_id',
            'terms'    =>   $autor_id
        ),
    ),
);


$typ_postu = array();
foreach ( $about_author_args['post_type'] as $t )
{
    switch ($t) {
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

$about_author_query = new WP_Query( $about_author_args );

if( $about_author_query->have_posts() )
{
    // SPRAWDŹ CZY SĄ WPISY I POBIERZ ID
    while( $about_author_query->have_posts() ) : $about_author_query->the_post();
        foreach ( $typ_postu as $typ => $t)
        {
            if ( $typ == $post->post_type)
            {
                $typ_postu[$post->post_type]['status'] = 1;
                $typ_postu[$post->post_type]['ID'][$post->ID] = $post->ID;
            }
        }
    endwhile;
    wp_reset_postdata();
    // END - SPRAWDŹ CZY SĄ WPISY I POBIERZ ID
?>
<section id="module__materialy-o-autorze">
    <h2 class="biuletyn_subtitle"><span class="lato-font"><?php _e( 'teksty i materiały autora w bibliotece', 'biblioteka' ); ?></span></h2>
    <div id="materialy-o-autorze">
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
                    <ul class="post-o-autorze">
                    <?php
                    $i=0;
                    foreach ( $t['ID'] as $id ) :
                        if($i==6) break;
    
                    $image_id = get_post_thumbnail_id($id);
                    $image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_autor');
                    $image_url = $image_url[0];
                    if ( empty($image_url) )
                    {
                        $image_url = "//placeholdit.imgix.net/~text?txtsize=36&txt=381×212&w=381&h=212";
                    }
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
                    <?php $i++; endforeach; ?>
                    </ul>
                </div>
            <?php endif; // if ( $t['status'] == 1 ) ?>
        <?php endforeach; //foreach ( $typ_postu as $typ => $t) ?>
    </div>
</section>
<script type="text/javascript">
jQuery(function() {
    jQuery(".ui-tabs-anchor").click(function(evt) {
        jQuery(".post-o-autorze").carousel("reset");
        evt.preventDefault();
    })
});
jQuery(".post-o-autorze").carousel({
    show: {
        "740px" : 2,
        "1163px" : 3
    },
    pagination: false
});
jQuery( "#materialy-o-autorze" ).tabs();
</script>
<?php } //if( $about_author_query->have_posts() )	
// end TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE ?>
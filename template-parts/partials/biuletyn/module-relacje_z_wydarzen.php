<?php
/*
* 
* RELACJE Z WYDARZEŃ
* 
* single-biuletyn.php
* single-projekty.php
* 
*/

$rzw_args = array(
    'posts_per_page'=> 3,
    'post_type' => 'zdjecia',
    'tax_query' => array(
        array(
            'taxonomy' => 'zdjecia-kategorie',
            'field'    => 'slug',
            'terms'    => 'relacje-z-wydarzen',
        )
    ),
);

$rzw_query = new WP_Query( $rzw_args );

if( $rzw_query->have_posts() ): ?>

<div id="module__relacje-z-wydarzen" class="relacje-z-wydarzen">
    <p class="tungsten-medium title"><?php _e( 'relacje z wydarzeń', 'biblioteka' ); ?></p>

    <div class="row">
        <ul>
            <?php
            while( $rzw_query->have_posts() ) : $rzw_query->the_post();
            // Okładka
            $rzw_img_id = get_post_thumbnail_id();
            $rzw_img_url = wp_get_attachment_image_src($rzw_img_id,'bl_ksiazka_okladka');
            $rzw_img_url = ( !empty($rzw_img_url) ) ? $rzw_img_url[0] : "//placeholdit.imgix.net/~text?txtsize=26&txt=282×160&w=282&h=160";
            ?>
            <li class="col-md-4">
                <a href="<?php the_permalink(); ?>" class="item-image item-image-rzw" target="_blank" title="<?php echo the_title(); ?>">
                    <img src="<?php echo $rzw_img_url; ?>" alt="<?php echo the_title(); ?>" />
                    <div class="title-rzw">
                        <span>
                            <span class="tungsten-medium"><?php echo the_title(); ?></span>
                        </span>
                    </div>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>

</div>
<?php wp_reset_postdata(); ?>
<?php endif; ?>

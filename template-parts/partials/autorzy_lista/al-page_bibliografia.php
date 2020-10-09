<?php
$args_przeklady = array(
    'post_type'  => 'ksiazki_lista',
    'post_status' => array( 'publish', 'private' ),
    'posts_per_page' => -1,
    'meta_key'   => 'data',
    'orderby'    => 'meta_value_num',
    'order'      => 'DESC',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'translation_%_imie',
            'value'   => get_field('imie'),
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'translation_%_nazwisko',
            'value'   => get_field('nazwisko'),
            'compare' => 'LIKE'
        )
    ),
);
$przeklady_query = new WP_Query( $args_przeklady );
//$post_ids_przeklady = wp_list_pluck( $przeklady_query->posts, 'ID' );
//print_r($post_ids_przeklady);

$args = array(
    'post_type'  => 'ksiazki_lista',
    'post_status' => array( 'publish', 'private' ),
    'posts_per_page' => -1,
    'meta_key'   => 'data',
    'orderby'    => 'meta_value_num',
    'order'      => 'DESC',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'autorzy_r_%_imie',
            'value'   => get_field('imie'),
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'autorzy_r_%_nazwisko',
            'value'   => get_field('nazwisko'),
            'compare' => 'LIKE'
        )
    ),
);

$kl_query = new WP_Query( $args );

//if ( is_user_logged_in() )
//{
//    print_r( wp_list_pluck( $kl_query->posts, 'post_title' ) );
//}

$bibliografia = array();

if ( $kl_query->have_posts() ) {
    
    while ( $kl_query->have_posts() )
    {
        
        $kl_query->the_post();

        $gatunek = wp_get_post_terms($post->ID, 'ksiazki_gatunek_do_bibliografii', array("fields" => "all"));
        $book_seria = wp_get_post_terms($post->ID, 'ksiazki_serie', array("fields" => "all"));
        $book_gatunki = wp_get_post_terms($post->ID, 'ksiazki_lista_kategorie', array("fields" => "all"));
        
        if ( !empty($gatunek) )
        {
            $bibliografia[$gatunek[0]->name][] = $post->ID;
        }
        elseif ( !empty($book_seria) )
        {
            $bibliografia[$book_seria[0]->name][] = $post->ID;
        }
        elseif ( !empty($book_gatunki) )
        {
            $bibliografia[$book_gatunki[0]->name][] = $post->ID;
        }
        else
        {
            $bibliografia['Pozostałe'][] = $post->ID;
        }

    }
    wp_reset_postdata();
}

if ( $kl_query->have_posts() ) : ?>
    <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-4">
    <?php //POEZJE
    if ( !empty($bibliografia) ) :
        foreach ($bibliografia as $kategoria => $ids): ?>
        <ul class="bibliografia">
            <p class="playfair-display"><span class="lato-font">/</span> <?php echo $kategoria; ?></p>
            <?php
            foreach ($ids as $id):
            
            $wydawca = "";
            $miejsce = "";
            $data = "";

            if (get_field('wydawca', $id))
            {
                $wydawca = get_field('wydawca', $id).',';
            }
            if (get_field('miejsce', $id))
            {
                $miejsce = get_field('miejsce', $id);
            }

            $check_date = strpos(get_field('data', $id), '-');
            if ( get_field('data', $id) && $check_date == TRUE )
            {
                $data = get_field('data', $id);
                $data = date_create($data);
                $data = date_format($data,"Y");
            }
            elseif (get_field('data', $id) && $check_date == FALSE )
            {
                $data = get_field('data', $id);
            }
            ?>
            <li class="playfair-display">
                <p><?php echo get_post_field( 'post_title', $id ); ?></p>
                <div>
                    <?php echo $wydawca; ?> <?php echo $miejsce; ?> <?php echo $data; ?>
                    
                    <?php if ( strpos(get_field('wydawca', $id), 'Biuro Literackie') !== false ) : ?>
                    <a class="red-triangle" href="<?php echo get_the_permalink($id); ?>" target="_blank"></a>
                    <?php endif; ?>
                    
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    <?php endif; //!empty($bibliografia['poezje']) ?>
    </div>
<?php endif; //$kl_query->have_posts() ?>


<?php
// PRZEKŁADY
if ( $przeklady_query->have_posts() ) : ?>
    <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-4">
       
        <ul class="bibliografia">
            <p class="playfair-display"><span class="lato-font">/</span> Przekłady</p>
            <?php 
            while ( $przeklady_query->have_posts() ) : $przeklady_query->the_post(); 
            
            $wydawca = "";
            $miejsce = "";
            $data = "";
            
            if (get_field('wydawca'))
            {
                $wydawca = get_field('wydawca').',';
            }
            if (get_field('miejsce'))
            {
                $miejsce = get_field('miejsce');
            }
            
            $check_date = strpos(get_field('data'), '-');
            if ( get_field('data') && $check_date == TRUE )
            {
                $data = get_field('data');
                $data = date_create($data);
                $data = date_format($data,"Y");
            }
            elseif (get_field('data') && $check_date == FALSE )
            {
                $data = get_field('data');
            }
            ?>

            <li class="playfair-display">
                <p><?php echo get_post_field( 'post_title' ); ?></p>
                <div>
                    <?php echo $wydawca; ?> <?php echo $miejsce; ?> <?php echo $data; ?>

                    <?php if ( strpos(get_field('wydawca', $id), 'Biuro Literackie') !== false ) : ?>
                    <a class="red-triangle" href="<?php echo get_the_permalink(); ?>" target="_blank"></a>
                    <?php endif; ?>
                </div>
            </li>

            <?php endwhile; ?>
        </ul>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; //$przeklady_query->have_posts() ?>

<?php get_template_part( 'template-parts/partials/autorzy_lista/al', 'module_poezjem' ); ?>

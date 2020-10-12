<?php
$count = 0;
$classes = array(
	'row',
	'row-eq-height',
);
if ( have_posts() ) : ?>
<div class="ksiazki_lista-dbs row">
	<?php
	while ( have_posts() ) : the_post();
	$count++;
	$term_list = wp_get_post_terms($post->ID, 'ksiazki_serie', array("fields" => "all"));
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_ksiazka2');
	$image_url = (has_post_thumbnail()) ? $image_url[0] : "https://placeholdit.imgix.net/~text?txtsize=27&txt=284×400&w=284&h=400";

	$originalDate = get_field('data');
	$newDate = date("d/m/Y", strtotime($originalDate));

    $kl_autor = array();
    if( have_rows('autorzy_r') )
    {
        $i = 0;
        while ( have_rows('autorzy_r') )
        {
            the_row(); $i++;
                        
            $bl_autor = get_sub_field('imie');
            $bl_autor .= ' ';
            $bl_autor .= mb_strtoupper(get_sub_field('nazwisko'), 'UTF-8');
            
            $autorzy_args = array(
                'post_type' => 'autorzy_lista',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'imie',
                        'value'   => get_sub_field('imie'),
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'nazwisko',
                        'value'   => get_sub_field('nazwisko'),
                        'compare' => 'LIKE'
                    )
                )
            );
            
            $autorzy_array = get_posts( $autorzy_args );
            $author_id = wp_list_pluck( $autorzy_array, 'ID' );
            
//            if ( is_user_logged_in() )
//            {
//                var_dump($author_id);
//            }

            $kl_autor[0]['imie'] = $bl_autor;
            $kl_autor[0]['id'] = isset($author_id[0]) ? $author_id[0] : TRUE;
            
            if ($i > 1)
            {
                $kl_autor[0]['id'] = FALSE;
                break;
            }
                
        }
        
    }
    
    $autor = '<br>';    
    if ( !empty($kl_autor[0]['id']) && $kl_autor[0]['id'] !== FALSE )
    {
        $autor = '<a href="'.get_permalink($kl_autor[0]['id']).'">';
        $autor .= $kl_autor[0]['imie'];
        $autor .= '</a>';
    }
    else
    {
        $autor = "Różni AUTORZY";
    }
    
	$book_excerpt = strip_tags( apply_filters('the_excerpt', get_post_field('post_excerpt', $post->ID)), '<em>' );
	if (  mb_strlen($book_excerpt, 'UTF-8') > 814 )
	{
		$book_excerpt = wordwrap($book_excerpt, 814);
		$book_excerpt = explode("\n", $book_excerpt);
		$book_excerpt = $book_excerpt[0] . '...';
	}
	?>
	<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-6 col-lg-offset-0">
		<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
			<span class="excerpt"><a href="<?php echo the_permalink(); ?>" class="transition-300-ease"><?php the_excerpt();?></a></span>
			<figure class="col-xs-12 col-sm-6 col-md-6">
                <a href="<?php echo get_field('link_do_poezjem'); ?>" target="_blank" title="więcej">
                    <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                </a>
            </figure>

			<div class="col-xs-12 col-sm-6 col-md-6">
				<h3 class="playfair-display"><?php echo $autor; ?></h3>
				<h4 class="playfair-display"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>

				<div class="lato-font">
					<span class="data_data-dbs"><?php echo $newDate; ?></span>
					<?php if ( !empty($term_list) ) : ?>
					<span class="data_cat-dbs"><a href="<?php echo get_term_link($term_list[0]->term_id); ?>"><?php echo $term_list[0]->name; ?></a></span>
					<?php endif; ?>
				</div>

				<span class="lato-font">
					<a href="<?php echo the_permalink(); ?>">WIĘCEJ</a>
				</span>
			</div>
		</article>
	</div>
	<?php endwhile; // end the custom loop ?>
</div>

<!-- pagination -->
<?php if ( !is_search() ) : ?>
    
    <?php
    $cur_page = intval(get_query_var('paged'));
    if ($cur_page == 0)
    {
        $cur_page=1;
    }
    ?>
    <div class="pagination_links">
        <div class="pagination">
        <span>
        <?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?>
        <span><?php echo $cur_page; ?>/<?php echo $wp_query->max_num_pages; ?></span>
        <?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?>
        </span>
        </div>
    </div>
<?php endif; //!is_search() ?>

<?php else : ?>
<div class="ksiazki-lista__notFound">
	<article id="article_<?php echo $count; ?>" <?php post_class(); ?>>
		<p class="playfair-display">Nie znaleziono książek w wybranej kategorii.</p>
	</article>
</div>
<?php endif; ?>

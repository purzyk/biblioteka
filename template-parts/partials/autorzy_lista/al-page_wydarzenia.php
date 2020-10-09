<?php
/*global $wpdb;
$query = "
    SELECT *
    FROM {$wpdb->prefix}postmeta
    INNER JOIN {$wpdb->prefix}postmeta m1
      ON ( {$wpdb->prefix}posts.ID = m1.post_id )
    INNER JOIN {$wpdb->prefix}postmeta m2
      ON ( {$wpdb->prefix}posts.ID = m2.post_id )
    WHERE
    {$wpdb->prefix}posts.post_type = 'wydarzenia'
    AND ( m1.meta_key LIKE 'dzien_%_wydarzenie_%_uczestnicy_%_nazwisko' AND m1.meta_value = {$autor_trim[1]} )
    AND ( m2.meta_key LIKE 'dzien_%_wydarzenie_%_uczestnicy_%_imie' AND m2.meta_value = {$autor_trim[0]} )
    GROUP BY {$wpdb->prefix}posts.ID
    ORDER BY {$wpdb->prefix}posts.post_date
    DESC;
";
$wpdb_wydarzenia = $wpdb->get_results($query, OBJECT);

var_dump($wpdb_wydarzenia);*/

// filter
function my_posts_where( $where ) {
	
	$where = str_replace("meta_key = 'dzien_%_wydarzenie_%_uczestnicy_%", "meta_key LIKE 'dzien_%_wydarzenie_%_uczestnicy_%", $where);

	return $where;
}

add_filter('posts_where', 'my_posts_where');


// PODSTRONA WIADOMOŚCI
$autor_name = get_the_title();
$autor_trim = explode(' ', trim($autor_name));
$autor_term = get_term_by('name', $autor_name, 'autor');
$autor_tag = get_term_by('name', $autor_name, 'post_tag');

$absolute_url = get_permalink();
if (!empty($_GET["page"]))
{
    $absolute_url = $absolute_url.'?page='.$_GET["page"];
}

$menu_links = array('wywiady','recenzje','ksiazki','utwory','debaty','felietony','dzwieki','nagrania','zdjecia');
$wydarzenia_cat = $menu_links;
if ( !empty($_GET['kategoria']) )
{
    $wydarzenia_cat = $_GET['kategoria'];
}

$count = "0";
$classes = array(
    'row',
    'row-eq-height',
);

if ( get_query_var('paged') ) 
{
    $paged = get_query_var('paged');
}
elseif ( get_query_var('page') )
{
    $paged = get_query_var('page');
}
else
{
    $paged = 1;
}

$wydarzenia_args = array(
    'post_type'  => 'wydarzenia',
    //'tag_id' => $autor_tag->term_id,
    'paged' => $paged,
	'posts_per_page'=> 12,
    //'post_status' => 'any',
    'meta_key' => 'data',
	'orderby' => 'meta_value',
	'order' => 'DESC',
    'meta_query' => array(
        'relation'		=> 'AND',
		array(
			'key' => 'dzien_%_wydarzenie_%_uczestnicy_%_imie',
			'value' => $autor_trim[0],
			'compare' => 'LIKE'
		),
        array(
			'key' => 'dzien_%_wydarzenie_%_uczestnicy_%_nazwisko',
			'value' => $autor_trim[1],
			'compare' => 'LIKE'
		)
	)
);
$wydarzenia_query = new WP_Query( $wydarzenia_args );

// Pagination fix
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $wydarzenia_query;

?>

<?php if ( $wydarzenia_query->have_posts() ) : ?>
<div class="module__autorzy-wydarzenia row">
   
    <?php
    while ( $wydarzenia_query->have_posts() ) : $wydarzenia_query->the_post();
    
        $count++; 
        $term_list = wp_get_post_terms($post->ID, $post->post_type.'_kategorie', array("fields" => "all"));
    
        $originalDate = get_field('data');
		$newDate = date("d/m/Y", strtotime($originalDate));
        
        $event_status = "ARCHIWUM";
        if ( $originalDate > current_time('Y-m-d') )
        {
            $event_status = "WKRÓTCE";
        }
        
        $cat_title = '';
        $cat_url = '';
        if (!empty($term_list))
        {
            $cat_title = $term_list[0]->name;
            $cat_url = get_term_link($term_list[0]->term_id);
            if ( $term_list[0]->parent != 0 )
            {
                $parent_cat = get_term( $term_list[0]->parent, $term_list[0]->taxonomy );
                $cat_title = $parent_cat->name;
                $cat_url = get_term_link($parent_cat->term_id);
            }
        }

        $push_class = '';
        $pull_class = '';
        if ( ($count % 2) == 0)
        {
            $push_class = 'col-md-push-6 ';
            $pull_class = 'col-md-pull-6 ';
        }
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id,'large');
        $image_url = $image_url[0];
        if ( empty($image_url) )
        {
            $image_url = get_template_directory_uri().'/img/placeholder.png';
        }
        
        $book_excerpt = strip_tags( apply_filters('the_excerpt', get_post_field('post_excerpt', $post->ID)) );
        if ( !has_excerpt( $post->ID ) )
        {
            $book_excerpt = strip_tags( apply_filters('the_content', get_post_field('post_content', $post->ID)) );
        }
        if (  mb_strlen($book_excerpt, 'UTF-8') > 2171 )
        {
            $book_excerpt = wordwrap($book_excerpt, 2171);
            $book_excerpt = explode("\n", $book_excerpt);
            $book_excerpt = $book_excerpt[0] . '...';
        }
		?>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-8 col-lg-offset-2">
			<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
			    <span class="excerpt"><a href="<?php echo the_permalink(); ?>" class="transition-300-ease"><?php echo $book_excerpt; ?></a></span>
				<figure class="col-xs-12 col-sm-6 col-md-6">
					<a href="<?php the_permalink(); ?>" target="_blank" title="więcej">
						<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
					</a>
				</figure>

				<div class="col-xs-12 col-sm-6 col-md-6">
					<h3 class="playfair-display color-red"><?php echo $event_status; ?></h3>
					<h4 class="playfair-display"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<div class="lato-font">
						<span class="data_data-dbs"><?php echo $newDate; ?></span>
						<?php if ( !empty($term_list) ) : ?>
						<span class="data_cat-dbs"><a href="<?php echo $cat_url; ?>"><?php echo $cat_title; ?></a></span>
						<?php endif; ?>
					</div>

					<span class="lato-font">
						<a href="<?php the_permalink(); ?>" target="_blank">WIĘCEJ</a>
					</span>
				</div>
			</article>
		</div>
   
    <?php endwhile; ?>
    
</div>
<?php wp_reset_postdata(); ?>

<!-- pagination -->
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
	<span><?php echo $cur_page; ?>/<?php echo $wydarzenia_query->max_num_pages; ?></span>
	<?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?>
	</span>
	</div>
</div>

<?php endif; ?>


<?php
// Reset main query object
$wp_query = NULL;
$wp_query = $temp_query;
?>
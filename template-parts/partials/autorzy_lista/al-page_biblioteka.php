<?php
// PODSTRONA WIADOMOŚCI
$autor_name = get_the_title();
$autor_term = get_term_by('name', $autor_name, 'autor');
$autor_tag = get_term_by('name', $autor_name, 'post_tag');

$absolute_url = get_permalink();
if (!empty($_GET["page"]))
{
    $absolute_url = $absolute_url.'?page='.$_GET["page"];
}

$menu_links = array('wywiady','recenzje','ksiazki','utwory','debaty','felietony','dzwieki','nagrania','zdjecia');
$biblioteka_cat = $menu_links;
if ( !empty($_GET['kategoria']) )
{
    $biblioteka_cat = $_GET['kategoria'];
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

$biblioteka_args = array(
    'post_type'  => $biblioteka_cat,
    //'tag_id' => $autor_tag->term_id,
    'paged' => $paged,
	'posts_per_page'=> 12,
    'tax_query' => array(
		array(
			'taxonomy' => 'autor',
			'field'    => 'term_id',
			'terms'    => $autor_term->term_id,
		),
	)
);
$biblioteka_query = new WP_Query( $biblioteka_args );

// Pagination fix
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $biblioteka_query;

?>

<div class="autor__menu-kategoria autor__menu-kategoria-biblioteka">
    <ul class="lato-font">
    <?php
    foreach ( $menu_links as $item ) :
        $kategoria = get_post_type_object( $item );
        $nazwa = $kategoria->labels->name;
        
        switch ($nazwa)
        {
            case "ksiazki":
                $nazwa = 'książki';
                break;
            case "felietony":
                $nazwa = 'cykle';
                break;
            case "dzwieki":
                $nazwa = 'dźwięki';
                break;
            case "zdjecia":
                $nazwa = 'zdjęcia';
                break;
            default:
            $nazwa = $nazwa;
            break;
        }
        
        $active = "";
        if ( isset($_GET["kategoria"]) && trim($_GET["kategoria"]) == $item )
        {
            $active = "class='active'";
        }
        $cat_args = array(
            'post_type'  => $item,
            'posts_per_page'=> 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'autor',
                    'field'    => 'term_id',
                    'terms'    => $autor_term->term_id,
                ),
            )
        );
        $cat_query = new WP_Query( $cat_args );

        if ( $cat_query->have_posts() ) :
        ?>
        <li>
            <a <?php echo $active; ?>href="<?php echo add_query_arg( 'kategoria', $item, $absolute_url ); ?>">
                <?php echo $nazwa; ?>
            </a>
        </li>
        <?php else : ?>
        <li><?php echo $nazwa; ?></li>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</div>

<?php if ( $biblioteka_query->have_posts() ) : ?>
<div class="biuletyn-cards-rwd">
   
    <?php while ( $biblioteka_query->have_posts() ) : $biblioteka_query->the_post(); ?>
    <?php $count++; ?>
    
    <article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
		<?php
		$term_list = wp_get_post_terms($post->ID, $post->post_type.'-kategorie', array("fields" => "all"));

		$cat_title = $term_list[0]->name;
		$cat_url = get_term_link($term_list[0]->term_id);
		if ( $term_list[0]->parent != 0 )
		{
			$parent_cat = get_term( $term_list[0]->parent, $term_list[0]->taxonomy );
			$cat_title = $parent_cat->name;
			$cat_url = get_term_link($parent_cat->term_id);
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

		$excerpt = apply_filters('the_excerpt', get_the_excerpt());
		if (  mb_strlen($excerpt, 'UTF-8') > 336 )
		{
			$excerpt = wordwrap($excerpt, 336);
			$excerpt = explode("\n", $excerpt);
			$excerpt = $excerpt[0] . '...';
		}
		?>
		<figure class="<?php echo $push_class; ?>col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<a href="<?php echo the_permalink(); ?>">
				<img src="<?php echo $image_url; ?>" />
			</a>
		</figure>
		<div class="<?php echo $pull_class; ?>biuletyn__article-dbs col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h4 class="biuletyn__title-dbs"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<div class="biuletyn__data-dbs lato-font">
				<span class="data_data-dbs"><?php the_time('d/m/Y');?></span>
				<span class="data_cat-dbs"><a href="<?php echo $cat_url; ?>"><?php echo $cat_title; ?></a></span>
			</div>
			<span class="biuletyn_excerpt-dbs playfair-display">
				<?php echo $excerpt; ?>
			</span>
			<span class="biuletyn_wiecej-dbs lato-font">
				<a href="<?php echo the_permalink(); ?>">WIĘCEJ</a>
			</span>
		</div>
	</article>
   
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
	<span><?php echo $cur_page; ?>/<?php echo $biblioteka_query->max_num_pages; ?></span>
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
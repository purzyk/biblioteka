<?php
/**
* The template for displaying archive pages.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package biblioteka
*/
get_header('primary');

$count = 0;
?>
<div id="primary" class="content-area">
  <main id="main-dbs" class="site-main" role="main">
    <section class="biuletyn">
      <figure class="logo__biuletyn">
        <a href="<?php echo get_post_type_archive_link('biuletyn'); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/biuletyn_logo.png" />
        </a>
      </figure>
      <div>
        <h3 class="biuletyn__title">Codzienne wiadomości z Biura Literackiego, premiery i zapowiedzi, a także zapowiedzi i relacje z wydarzeń.</h3>
      </div>
      <div>
        <?php wp_nav_menu( array('menu' => 'biuletyn', 'before' => '<span class="red">/</span>', )); ?>
      </div>
      <div class="row">
      	<div class="col-md-8 col-md-offset-2" style="text-align: center;display: block;">
      		<div style="display: inline-block;width: 556px;">
      			<form role="search" method="get" class="col-md-12 lato-font search-form search-form-biuletyn" action="<?php echo home_url( '/' ); ?>">
      				<input type="search" placeholder="SZUKAJ" value="<?php the_search_query(); ?>" name="s" title="Szukaj:" />
      				<input type="hidden" name="post_type" value="biuletyn" />
      				<input type="submit" value="Search" />
      			</form>
      		</div>
      	</div>
      	<div class="col-md-2">
            <div style="display:block;">
                <div class="dropdown dropdown-search">
                    <button class="lato-font btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">wybierz
                    <span class="caret-dbs"></span></button>
                    <ul class="lato-font dropdown-menu">
                        <?php if ( !empty($_GET['biuletyn_kategorie']) ) : ?>
                            <li><a href="<?php echo remove_query_arg( array('paged','biuletyn_kategorie','orderby','order' ) ); ?>">pokaż wszystko</a></li>
                        <?php endif; ?>
                        <!--DATA-->
                        <?php
                        $reset_query = array('paged','orderby','order' );
                        $date_asc = array('orderby' => 'date','order' => 'asc');
                        $date_desc = array('orderby' => 'date','order' => 'desc');
                        ?>
                        <li class="sortuj-data">data
                            <a class="asc" href="<?php echo add_query_arg( $date_asc, remove_query_arg('paged') ); ?>" title="sortuj rosnąco"></a>
                            <a class="desc" href="<?php echo add_query_arg( $date_desc, remove_query_arg('paged') ); ?>" title="sortuj malejąco"></a>
                        </li>
                        <!--DATA-->
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'wiesci-z-biura', remove_query_arg( $reset_query ) ); ?>">wieści z biura</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'premiery', remove_query_arg( $reset_query ) ); ?>">premiery</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'zapowiedzi', remove_query_arg( $reset_query ) ); ?>">zapowiedzi</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'wydarzenia', remove_query_arg( $reset_query ) ); ?>">wydarzenia</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'relacje', remove_query_arg( $reset_query ) ); ?>">relacje</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'projekty', remove_query_arg( $reset_query ) ); ?>">projekty</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'w-bibliotece', remove_query_arg( $reset_query ) ); ?>">w bibliotece</a></li>
                        <li><a href="<?php echo add_query_arg( 'biuletyn_kategorie', 'przeglad-prasy', remove_query_arg( $reset_query ) ); ?>">przegląd prasy</a></li>
                    </ul>
                </div>
            </div>
        </div>
      </div>

      <div class="biuletyn-dbs">

      	<?php while ( have_posts() ) : the_post(); ?>
      	<?php $count++;
      	$classes = array(
      		'row',
      		'row-eq-height',
      	);
      	?>
      	<article id="article_<?php echo $count;?>-dbs" <?php post_class( $classes ); // output a post article ?>>
      		<?php
      		$term_list = wp_get_post_terms($post->ID, 'biuletyn_kategorie', array("fields" => "all"));

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
      		<figure class="<?php echo $push_class; ?>col-xs-12 col-sm-12 col-md-6">
      			<a href="<?php echo the_permalink(); ?>">
      				<img src="<?php echo $image_url; ?>" />
      			</a>
      		</figure>
      		<div class="<?php echo $pull_class; ?>biuletyn__article-dbs col-xs-12 col-sm-12 col-md-6">
      			<h4 class="biuletyn__title-dbs"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
      			<div class="biuletyn__data-dbs lato-font">
      				<?php /** <pre style="display:none;"><?php var_dump($term_list); ?></pre> **/ ?>
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

      	<?php endwhile; // end the custom loop
        wp_reset_query(); ?>

      </div>

        <!-- pagination -->
        <?php
        $previous_link_img = '<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />';
        $next_link_img = '<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />';

        $cur_page = intval(get_query_var('paged'));
        if ($cur_page == 0)
        {
            $cur_page=1;
        }
        $previous_link = add_query_arg( 'paged', ($cur_page - 1) );
        $next_link = $cur_page + 1;
        if ( $cur_page == $wp_query->max_num_pages )
        {
            $next_link = "";
        }
        if ( $cur_page == 2 )
        {
            $previous_link = remove_query_arg( 'paged' );
        }
        ?>
        <div class="pagination_links">
            <div class="pagination">
            <span>
            
                <?php if ( !empty($_GET['paged']) ) : ?>
                <a href="<?php echo $previous_link; ?>">
                    <?php echo $previous_link_img; ?>
                </a>
                <?php endif; //$cur_page != 1 || $cur_page != 0 ?>
            
            <span><?php echo $cur_page; ?>/<?php echo $wp_query->max_num_pages; ?></span>
               
                <?php if ( $cur_page != $wp_query->max_num_pages ) : ?>
                <a href="<?php echo add_query_arg( 'paged', $next_link ); ?>" title="następna strona">
                    <?php echo $next_link_img; ?>
                </a>
                <?php endif; //$cur_page == $wp_query->max_num_pages ?>
                
            </span>
            </div>
        </div>

    </section>
  </main>
  <!-- #main -->
</div>
<!-- #primary -->
<script type="text/javascript">
  $(".master_slider_slider").carousel({
    show: {
      "740px" : 1,
      "980px" : 1
    }
    ,
    pagination: false
  }
);
</script>
<?php get_footer(); ?>

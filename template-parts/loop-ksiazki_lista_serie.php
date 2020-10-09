


<?php   $term =	$wp_query->queried_object;
$slug = $term->slug;?>
  <?php


    // set up our archive arguments
		 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $archive_args = array(
      post_type => array('ksiazki_lista'),    // get only posts
			'paged' => $paged,
			      'tax_query' => array(
        array(
            'taxonomy' => 'ksiazki_serie',
            'field' => 'slug',
            'terms' => $slug ,
        )
    ),
      'posts_per_page'=> 12   // this will display all posts on one page
    );

    // new instance of WP_Quert
    $archive_query = new WP_Query( $archive_args );
$count=0;
  ?>

  <div class="biuletyn ksiazki_lista">
    <?php while ( $archive_query->have_posts() ) : $archive_query->the_post(); // run the custom loop ?>




      <article <?php post_class(); // output a post article ?> >
<a href="<?php the_permalink();?>"><div class="ksiazki_desc">
<?php the_excerpt();?>
</div></a>
				<?php $term_list = wp_get_post_terms($post->ID, 'ksiazki_lista_kategorie', array("fields" => "all")); ?>
				<figure>
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('bl_biuletyn_ksiazka');
					} else { ?>
					<img src="http://www.pl/bl/wp/wp-content/uploads/2016/05/zaslepka-1541x725-615x412.jpg" alt="<?php the_title(); ?>" />
					<?php } ?>
				</figure>
				<div class="biuletyn__article">
          <h3><span class="autorzy_lista_imie"><?php the_field('autor_imie');?></span>  <span class="autorzy_lista_nazwisko"><?php the_field('autor_nazwisko');?></span></h3>
					        <h4><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="biuletyn__data">
										<span class="data_data"><?php the_time('d/m/Y');?></span><span class="data_cat"><?php echo $term_list[0]->name ?></span>


									</div>
									<span class="biuletyn_excerpt">
									</span>

									<a class="biuletyn_wiecej" href="<?php the_permalink(); ?>">WIĘCEJ</a>
				</div>

      </article>

    <?php endwhile; // end the custom loop ?>

  </div>

	<?php $cur_page = intval(get_query_var('paged')); if ($cur_page == 0) {$cur_page=1;} ;  ?>
	<div class="pagination_links"><div class="pagination"><span><?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?>
	<span><?php echo $cur_page; ?>/<span><?php echo $wp_query->max_num_pages;?>
	<?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?></div></div>

<form method="get" id="searchform_sidebar2" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit_sidebar" value="Search" class="btn" />
			</div>
			</form>
<section class="szukaj2">
<h5 class="search-title"><?php printf( esc_html__( 'Wyniki wyszukiwania dla: %s', 'biblioteka' ), '<span>' . get_search_query() . '</span>' ); ?></h5>	
<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
	<?php
echo '<article class="archive_post">'; ?>
		<a href="<?php the_permalink();?>">
 <?php 
		echo '<h4>' . get_the_title() . '</h4>';
the_excerpt(); ?>
		<?php 	echo '</a></article>';
				?>			
			<?php endwhile; ?>
			</section>
<?php $cur_page = intval(get_query_var('paged')); if ($cur_page == 0) {$cur_page=1;} ;  ?>
<div class="pagination_links"><div class="pagination"><span><?php previous_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />'); ?><span><?php echo $cur_page; ?>/<span><?php echo $wp_query->max_num_pages;?><?php next_posts_link('<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />'); ?></div></div>
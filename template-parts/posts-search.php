<form method="get" id="searchform_sidebar2" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="InputSearch" />
			</div>
			</form>
<section class="szukaj2">
<h5 class="search-title"><?php printf( esc_html__( 'Wyniki wyszukiwania dla: %s', 'biblioteka' ), '<span>' . get_search_query() . '</span>' ); ?></h5>	
<div class="indexTekstow" id="ourHolder">
<?php /* Start the Loop */ ?>
			<?php 
			         global $wp_query;
					 $args = array_merge( $wp_query->query_vars, ['posts_per_page' => 10000 ] );
					 query_posts( $args );					
			while ( have_posts() ) : the_post(); ?>
			
			<div data-name="Czasu jest mało" class="zasob item category-<?php echo $post->post_type; ?>">
<div class="itemRow">
<div>
<p class="itemRow__data"><?php the_time('d/m/Y');?></p>
</div>
<div>
 <?php 
 if ($post->post_type == "wywiady") {
$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/wywiady/">wywiady</a>';

}
if ($post->post_type == "ksiazki") {
	$term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/ksiazki/">książki</a>';
	
	}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/recenzje/">recenzje</a>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/debaty/">debaty</a>';

}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/cykle/">cykle</a>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/dzwieki/">dźwięki</a>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/nagrania/">nagrania</a>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/zdjecia/">zdjecia</a>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/utwory/">utwory</a>';
}
if ($post->post_type == "kartoteka_25") {
	$term_list = wp_get_post_terms($post->ID, 'kartoteka_25-kategorie', array("fields" => "all"));
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/kartoteka_25/">kartoteka 25</a>';
	}
?>
</div>
<div class="itemRow__autorzy">
<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) { ?>
	<?php $term_link = get_term_link( $term ); ?>
		<a class="itemRow__autor" href="<?php echo $term_link; ?>"><span><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></span></a>
		<?php 
	}
	
} 
?>
</div>
 </div>
 
 <span class="itemRow__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
 </span>
 <div class="itemRow__excerpt">
 <?php echo strip_tags( get_the_excerpt(),'<em><br>' ); ?>
 </div>
 
 </div>
		
			<?php endwhile; ?>
			</div>
			</section>
			<script type="text/javascript">
$(document).ready(function() {
	$('.archive_sort select').on('change', function() {
		var ourClass = this.value;
		$('.inputSearch input').val('');
		$('#filterOptions li').removeClass('active');
		if(ourClass == 'all') {
			// show all our items
			$('#ourHolder').children('div.item').show();	
		}
		else {
			// hide all elements that don't share ourClass
			$('#ourHolder').children('div:not(.' + ourClass + ')').hide();
			// show all elements that do share ourClass
			$('#ourHolder').children('div.' + ourClass).show();
		}
		return false;
});
	$('#filterOptions li a').click(function() {
		$('.archive_sort select').val("");
		// fetch the class of the clicked item
		var ourClass = $(this).attr('class');
		$('.inputSearch input').val('');
		
		// reset the active class on all the buttons
		$('#filterOptions li').removeClass('active');
		// update the active state on our clicked button
		$(this).parent().addClass('active');
		
		if(ourClass == 'all') {
			// show all our items
			$('#ourHolder').children('div.item').show();	
		}
		else {
			// hide all elements that don't share ourClass
			$('#ourHolder').children('div:not(.' + ourClass + ')').hide();
			// show all elements that do share ourClass
			$('#ourHolder').children('div.' + ourClass).show();
		}
		return false;
	});
});
</script>
			<section class="top_articles">
			<?php get_template_part( 'template-parts/loop', 'archwiumtop_indeks' ); ?>
			<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
    show: {
        "740px" : 3,
        "980px" : 3
    },
    pagination: false
});
			</script>
		</section>
<?php if ( have_posts() ) : ?>

	<div class="archive_breadcrumbs smallerPadding">
	<div class="bread_outside">
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
    </div>
</div>
<div class="archive_sort newSort">
Sortuj
<select name="kategorie" required>
<option value="" disabled selected>wybierz</option>
<option value="all">Wszystkie</option>
<option value="category-wywiady">wywiady</option>
<option value="category-ksiazki">książki</option>
<option value="category-utwory">utwory</option>
<option value="category-recenzje">recenzje</option>
<option value="category-debaty">debaty</option>
<option value="category-felietony">cykle</option>
<option value="category-dzwieki">dżwieki</option>
<option value="category-nagrania">nagrania</option>
<option value="category-zdjecia">zdjęcia</option>
<option value="category-kartoteka_25">kartoteka 25</option>

</select>
</div>
	</div>
	<div class="filters" id="filterOptions">
	<li class="filter"><a class="category-a" href="#">A</a></li>
	<li class="filter"><a class="category-b" href="#">B</a></li>
	<li class="filter"><a class="category-c" href="#">C</a></li>
	<li class="filter"><a class="category-d" href="#">D</a></li>
	<li class="filter"><a class="category-e" href="#">E</a></li>
	<li class="filter"><a class="category-ę" href="#">Ę</a></li>
	<li class="filter"><a class="category-f" href="#">F</a></li>
	<li class="filter"><a class="category-g" href="#">G</a></li>
	<li class="filter"><a class="category-h" href="#">H</a></li>
	<li class="filter"><a class="category-i" href="#">I</a></li>
	<li class="filter"><a class="category-j" href="#">J</a></li>
	<li class="filter"><a class="category-k" href="#">K</a></li>
	<li class="filter"><a class="category-l" href="#">L</a></li>
	<li class="filter"><a class="category-ł" href="#">Ł</a></li>
	<li class="filter"><a class="category-m" href="#">M</a></li>
	<li class="filter"><a class="category-n" href="#">N</a></li>
	<li class="filter"><a class="category-o" href="#">O</a></li>
	<li class="filter"><a class="category-p" href="#">P</a></li>
	<li class="filter"><a class="category-r" href="#">R</a></li>
	<li class="filter"><a class="category-s" href="#">S</a></li>
	<li class="filter"><a class="category-t" href="#">T</a></li>
	<li class="filter"><a class="category-u" href="#">U</a></li>
	<li class="filter"><a class="category-w" href="#">W</a></li>
	<li class="filter"><a class="category-x" href="#">X</a></li>
	<li class="filter"><a class="category-y" href="#">Y</a></li>
	<li class="filter"><a class="category-z" href="#">Z</a></li>
	<li class="filter"><a class="category-ż" href="#">Ż</a></li>
	<li class="filter"><a class="category-ź" href="#">Ź</a></li>
	<li class="filter"><a class="category-0" href="#">#</a></li>
	<li class="filter active"><a class="all" href="#">Wszystkie</a></li>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#ourHolder div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<div class="inputSearch">
<input id="myInput" type="text" placeholder="Tytuł tekstu">
</div>

<div class="indexTekstow" id="ourHolder">
		

		 <?php 
$custom_taxterms = wp_get_object_terms( $post->ID, 'autor', array('fields' => 'ids') );
// arguments
$args = array(
	'post_type' => array('wywiady','ksiazki','utwory','recenzje','debaty','felietony','dzwieki','nagrania','zdjecia','kartoteka_25'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();?>
<?php 
$naz=get_the_title() ;
$charset = 'UTF-8';
$length = 1;
if(mb_strlen($naz, $charset) > $length) {
  $naz = mb_substr($naz, 0, 1, $charset);
  if($naz>0 && $naz < 10  ) {
$naz=0;
  }
  $naz = mb_strtolower($naz);
}
?>
<div data-name="<?php the_title(); ?>" class="zasob item category-<?php echo $naz;?> category-<?php echo $post->post_type; ?>">
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
 <?php
 the_excerpt();
 ?>
 </div>
 
 </div>
<?php
endwhile;

endif;
// Reset Post Data
?>
</div>
<?php
wp_reset_postdata();
?>
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
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
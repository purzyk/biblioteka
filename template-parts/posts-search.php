
<div class="inputSearch">
<form method="get" id="searchform_sidebar2" action="<?php bloginfo('home'); ?>/">
<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="InputSearch" />
</form>

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


<div class="newSort__arrows">
<div class="newSort__item">
Data  <span id="sort-by-date-asc" style = "cursor: pointer;">&#9650;</span> <span id="sort-by-date-desc" style = "cursor: pointer;">&#9660;</span>
</div>
<div class="newSort__item">
A-Z <span id="sort-by-name-desc" style = "cursor: pointer;">&#9650;</span> <span id="sort-by-name-asc" style = "cursor: pointer;">&#9660;</span>
</div>
</div>
</div>
</div>


			
			
<section class="szukaj2">
<h5 class="search-title"><?php printf( esc_html__( 'Wyniki wyszukiwania dla: %s', 'biblioteka' ), '<span>' . get_search_query() . '</span>' ); ?></h5>	
<div class="main-wrapper indexTekstow" id="ourHolder">
<?php /* Start the Loop */ ?>
			<?php 
					 global $wp_query;

					 $args = array_merge( $wp_query->query_vars, ['posts_per_page' => 100000 ] );
					 query_posts( $args );					
			while ( have_posts() ) : the_post(); ?>
			
			<div class="box-wrapper zasob item  category-<?php echo $post->post_type; ?>" data-site="<?php the_title();?>" data-price="<?php the_time('Y');?>">
<div class="itemRow">
<div>
<p class="itemRow__data"><?php the_time('d/m/Y');?></p>
</div>
<div>
 <?php 
 if ($post->post_type == "wywiady") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/wywiady/">wywiady</a>';

}
if ($post->post_type == "ksiazki") {
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/ksiazki/">książki</a>';
	
	}
 if ($post->post_type == "recenzje") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/recenzje/">recenzje</a>';
}
 if ($post->post_type == "debaty") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/debaty/">debaty</a>';

}
 if ($post->post_type == "felietony") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/cykle/">cykle</a>';
}
 if ($post->post_type == "dzwieki") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/dzwieki/">dźwięki</a>';
}
 if ($post->post_type == "nagrania") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/nagrania/">nagrania</a>';
}
 if ($post->post_type == "zdjecia") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/zdjecia/">zdjecia</a>';
}
 if ($post->post_type == "utwory") {
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/utwory/">utwory</a>';
}
if ($post->post_type == "kartoteka_25") {
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/kartoteka_25/">kartoteka 25</a>';
	}
	if ($post->post_type == "biuletyn") {	
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biuletyn/">biuletyn</a>';
}
if ($post->post_type == "projekty") {	
	echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/projekty/">projekty</a>';
}
?>
</div>

<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	?>
<div class="itemRow__autorzy">
	<?php
	foreach( $terms as $term ) { ?>
	<?php $term_link = get_term_link( $term ); ?>
		<a class="itemRow__autor" href="<?php echo $term_link; ?>"><span><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></span></a>
		<?php 
	}
?>
</div>
<?php	
} 
?>

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

<script>
function sortByDateAsc(){
	var boxes = $(".box-wrapper").detach();
	
	boxes.sort(function (a, b) {
				return +$(a).attr("data-price") < +$(b).attr("data-price") ? 1 : -1;
			});
	boxes.appendTo('.main-wrapper');
}
function sortByDateDesc(){
	var boxes = $(".box-wrapper").detach();
	
	boxes.sort(function (a, b) {
				return +$(a).attr("data-price") < +$(b).attr("data-price") ? -1 : 1;
			});
	boxes.appendTo('.main-wrapper');
}
function sortbynamedesc(){
$("#ourHolder .box-wrapper").sort(function (a, b) {
    if ( ($(a).attr("data-site").toLowerCase() > $(b).attr("data-site").toLowerCase()) )  { 
        return 1;
    } else if ( ($(a).attr("data-site").toLowerCase() == $(b).attr("data-site").toLowerCase()) ){
        return 0;
    } else {
        return -1;
    }
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#ourHolder");
});
}
function sortbynameasc(){
$("#ourHolder .box-wrapper").sort(function (a, b) {
    if ( ($(a).attr("data-site").toLowerCase() > $(b).attr("data-site").toLowerCase()) )  { 
        return -1;
    } else if ( ($(a).attr("data-site").toLowerCase() == $(b).attr("data-site").toLowerCase()) ){
        return 0;
    } else {
        return 1;
    }
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#ourHolder");
});
}
$(document).ready(function() {
	$('#sort-by-name-desc').click(function(){
		sortbynamedesc();
	});
  	$('#sort-by-name-asc').click(function(){
		sortbynameasc();
	});
  	$('#sort-by-date-asc').click(function(){
		sortByDateDesc();
	});
	$('#sort-by-date-desc').click(function(){
		sortByDateAsc();
	});
}); 


</script>
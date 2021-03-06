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
<div class="inputSearch">
<input id="myInput" type="text" placeholder="Tytuł tekstu">
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
<div class="main-wrapper indexTekstow" id="ourHolder">

<?php 
$args = array(
	'post_type' => array('wywiady','ksiazki','utwory','recenzje','debaty','felietony','dzwieki','nagrania','zdjecia','kartoteka_25'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
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
<div class="box-wrapper zasob item category-<?php echo $naz;?>  category-<?php echo $post->post_type; ?>" data-site="<?php the_title();?>" data-price="<?php the_time('Y');?>">
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
<?php
endwhile;

endif;
// Reset Post Data
?>
</div>
<?php
wp_reset_postdata();
?>


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
<script type="text/javascript">
$(document).ready(function() {
	$('.archive_sort select').on('change', function() {
		event.preventDefault();
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
		event.preventDefault();
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
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#ourHolder div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>
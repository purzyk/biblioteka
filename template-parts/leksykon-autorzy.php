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
<?php /*
<div class="archive_sort">
Sortuj
<select name="browsers" required>

<option value="" disabled selected>wybierz</option>
<option value="chrome">autor</option>
<option value="safari">tytuł</option>
<option value="opera">OPERA</option>

</select>
</div>
*/?>
	</div>

		

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="filters">
<div class="filter" data-filter=".category-a">A</div>
<div class="filter" data-filter=".category-b">B</div>
<div class="filter" data-filter=".category-c">C</div>
<div class="filter" data-filter=".category-d">D</div>
<div class="filter" data-filter=".category-e">E</div>
<div class="filter" data-filter=".category-ę">Ę</div>
<div class="filter" data-filter=".category-f">F</div>
<div class="filter" data-filter=".category-g">G</div>
<div class="filter" data-filter=".category-h">H</div>
<div class="filter" data-filter=".category-i">I</div>
<div class="filter" data-filter=".category-j">J</div>
<div class="filter" data-filter=".category-k">K</div>
<div class="filter" data-filter=".category-l">L</div>
<div class="filter" data-filter=".category-ł">Ł</div>
<div class="filter" data-filter=".category-m">M</div>
<div class="filter" data-filter=".category-n">N</div>
<div class="filter" data-filter=".category-o">O</div>
<div class="filter" data-filter=".category-p">P</div>
<div class="filter" data-filter=".category-q">Q</div>
<div class="filter" data-filter=".category-r">R</div>
<div class="filter" data-filter=".category-s">S</div>
<div class="filter" data-filter=".category-t">T</div>
<div class="filter" data-filter=".category-u">U</div>
<div class="filter" data-filter=".category-w">W</div>
<div class="filter" data-filter=".category-x">X</div>
<div class="filter" data-filter=".category-y">Y</div>
<div class="filter" data-filter=".category-z">Z</div>
<div class="filter" data-filter=".category-ż">Ż</div>
<div class="filter" data-filter=".category-ź">Ź</div>
<div class="filter" data-filter="all">Wszyscy</div>
</div>


<style>
#autorzy_filtr .mix{
	display: none;
}
</style>
<script type="text/javascript">
	$(function(){

	// Instantiate MixItUp:

	$('#autorzy_filtr').mixItUp();

});
</script>

<?php
$artistsList = get_terms( 'autor');
$t = 0;
echo '<div id="users">
  <input class="search nazwisko_autora" placeholder="nazwisko autora" />
  <div style="clear:both"></div>

  <ul id="autorzy_filtr" class="list autorzy_lista">';
// expand the array to include the last name field
foreach ( $artistsList as $artist ) {
	$termID = $artistsList[$t]->term_id;

	// get the field last name for this ID
	$lastName = get_field('nazwisko', 'autor_'.$termID);

	// plop it into the object
	$artistsList[$t]->lastName = $lastName;

	$t ++;
}
function cmp($a, $b)
{
	return strcmp($a->lastName, $b->lastName);
}
usort($artistsList, "cmp");
foreach ( $artistsList as $artist ) {
 if( get_field('nazwisko', $artist) ): ?>
     	<?php $naz=get_field('nazwisko', $artist) ;
$charset = 'UTF-8';
$length = 1;
if(mb_strlen($naz, $charset) > $length) {
  $naz = mb_substr($naz, 0, 1, $charset);
  $naz = mb_strtolower($naz);
}


     	?>
<li class="mix category-<?php echo $naz;?>">
<?php $term_link = get_term_link( $artist ); ?>
<a href="<?php echo $term_link; ?>">
<?php
$image = get_field('zdjecie', $artist);
$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}
else { ?>
	<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-300x300.jpg">
<?php } 
?>
</a>
<h5 class="name"><span><?php echo the_field('nazwisko', $artist);?> </span> <?php echo the_field('imie', $artist);?></h5>

<a class="autorzy_wiecej" href="<?php echo $term_link; ?>">więcej</a>
</li>
<?php endif;
}
    echo '</ul></div>';
?>


     


 

 
	

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		

<script type="text/javascript">
	var options = {
  valueNames: [ 'name' ],
   page:10000
};

var userList = new List('users', options);
</script>
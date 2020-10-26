			<section class="top_articles">
			<?php get_template_part( 'template-parts/loop', 'archwiumtop_indeks' ); ?>
			<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
    show: {
        "740px" : 1,
        "980px" : 3
    },
    pagination: false
});
			</script>
		</section>


	<div class="archive_breadcrumbs">
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
*/ ?>
	</div>


<?php get_template_part( 'template-parts/posts', 'search' ); ?>
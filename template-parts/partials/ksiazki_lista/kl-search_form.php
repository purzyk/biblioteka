<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form role="search" method="get" class="col-md-12 lato-font search-form search-form-autorzy" action="<?php echo home_url( '/' ); ?>">
			<input type="search" placeholder="SZUKAJ" value="<?php the_search_query(); ?>" name="s" title="Szukaj:" />
			<input type="hidden" name="post_type" value="ksiazki_lista" />
			<input type="submit" value="Search" />
		</form>
	</div>
</div>
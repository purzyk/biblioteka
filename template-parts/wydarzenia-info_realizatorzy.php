<?php /** REALIZATORZY **/
$realizatorzy = get_field('realizatorzy');
if( $realizatorzy ) : ?>
<style type="text/css">
.realizatorzy {
	margin-top: 20px;
}
.realizatorzy ul {
	margin-bottom: 30px;
}
</style>
<div id="realizatorzy" class="realizatorzy lato-font">

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h3 class="wydarzenia__title"><?php _e( 'realizatorzy', 'biblioteka' ); ?></h3>
		</div>
	</div>

	<div class="row" style="margin-top:50px;">
		<div class="col-xs-12 col-sm-12 col-md-12 playfair-display">
			<?php echo $realizatorzy; ?>
		</div>	
	</div>	

</div>
<?php endif; 
/** REALIZATORZY **/ ?>
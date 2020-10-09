<?php /** AKREDYTACJE **/
$akredytacje = get_field('akredytacje');
if( $akredytacje ) : ?>
<style type="text/css">
.akredytacje {
	margin-top: 20px;
	text-align: justify;
}
</style>
<div id="akredytacje" class="container akredytacje lato-font">

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h3 class="wydarzenia__title"><?php _e( 'dziennikarze', 'biuro-literackie' ); ?></h3>
		</div>
	</div>

	<div class="row" style="margin-top:50px;">
		<div class="col-xs-12 playfair-display">
			<?php echo $akredytacje; ?>
		</div>	
	</div>	

</div>
<?php endif; 
/** AKREDYTACJE **/ ?>
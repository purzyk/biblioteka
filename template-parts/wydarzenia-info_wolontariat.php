<?php /** WOLONTARIAT **/
$wolontariat = get_field('wolontariat');
if( $wolontariat ) : ?>
<style type="text/css">
.wolontariat {
	margin-top: 20px;
	text-align: center;
}
</style>
<div id="wolontariat" class="container wolontariat lato-font">

	<div class="row">
		<div class="col-xs-12">
			<h3 class="wydarzenia__title"><?php _e( 'wolontariat', 'biuro-literackie' ); ?></h3>
		</div>
	</div>

	<div class="row" style="margin-top:50px;">
		<div class="col-xs-12 playfair-display">
			<?php echo $wolontariat; ?>
		</div>	
	</div>	

</div>
<?php endif; 
/** WOLONTARIAT **/ ?>
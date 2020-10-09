<?php /** BILETY NA KONCERTY **/
$bilety = get_field('bilety_na_koncerty');
if( $bilety ) : ?>
<div id="bilety-na-koncerty" class="bilety-na-koncerty single-event-dbs">
	<div class="row">
	<?php
		$bilety_baner = get_field('bilety_na_koncerty_baner');
		if( !empty($bilety_baner) )
		{
			$baner_src = $bilety_baner['url'];
		}
		else
		{
			$baner_src = 'https://placeholdit.imgix.net/~text?txtsize=59&txt=632%C3%97300&w=632&h=300';
		}
		?>
		<div class="col-md-6 col-sm-6" style="padding-left: 0;">
			<img src="<?php echo $baner_src; ?>" />
		</div>
		<div class="col-xs-11 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 bottom-align-text">
			<h3 class="tungsten-semibold niezbednik__title"><?php _e( 'bilety na koncerty', 'biuro-literackie' ); ?></h3>
		</div>
	</div>
	
	<div class="row">	
		<div class="playfair-display col-md-8 col-md-offset-2">
			<?php echo $bilety; ?>
		</div>
	</div>	
	
</div>
<?php endif;
/** BILETY NA KONCERTY **/ ?>
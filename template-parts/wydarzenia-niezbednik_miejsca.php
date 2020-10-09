<?php /** MIEJSCA WYDARZEŃ **/
if( have_rows('miejscawydarzen') ) : ?>
<div id="miejsca-wydarzen" class="miejsca-wydarzen single-event-dbs">
	<div class="row">
	<?php
		$miejsca_wydarzen_baner = get_field('miejsca_wydarzen_baner');
		if( !empty($miejsca_wydarzen_baner) )
		{
			$baner_src = $miejsca_wydarzen_baner['url'];
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
			<h2 class="niezbednik__title tungsten-semibold"><?php _e( 'niezbędnik', 'biuro-literackie' ); ?></h3>
			<h3 class="niezbednik__title tungsten-semibold"><?php _e( 'miejsca wydarzeń', 'biuro-literackie' ); ?></h3>
		</div>
	</div>
	
	<?php
		// loop through the rows of data
		while ( have_rows('miejscawydarzen') ) : the_row(); 
			$location = get_sub_field('mapa');
			$nazwa = mb_strtolower(get_sub_field('nazwa_miejsca'), 'UTF-8');
			$url = get_sub_field('url');
			$opis = get_sub_field('opis'); ?>
		<div class="row single-place-dbs" style="margin-top:50px;">
			<div class="col-xs-8 col-md-5 col-md-offset-1">
				<h4 class="lato-font"><?php echo $nazwa; ?></h4>
				<?php if ($opis) : ?>
				<span class="desc playfair-display"><?php echo $opis; ?></span>
				<?php endif; ?>
			</div>
			
			<?php if ($location || $url) : ?>
			<div class="col-xs-4 col-md-6">
				<?php if ($location) : ?>
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<a class="see-map-dbs lato-font" title="<?php echo $location['address']; ?>" target="_blank" href="https://www.google.com/maps/place/<?php echo urlencode($location['address']);?>/@<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>,17z/"><?php _e( 'sprawdź na mapie', 'biuro-literackie' ); ?></a>
				<?php endif; ?>

				<?php if ( $url ) : ?>
				<a class="go-to-adress lato-font" title="<?php _e( 'Idź do adresu', 'biuro-literackie' ); ?>" target="_blank" href="<?php echo $url; ?>"><?php echo str_replace('http://', '' , $url); ?></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>	
		<?php endwhile;?>	
</div>
<?php endif; 
/** MIEJSCA WYDARZEŃ **/ ?>
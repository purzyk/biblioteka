<?php /** BAZA NOCLEGOWA **/ 
if( have_rows('transport') ) : ?>
<div id="baza-noclegowa" class="baza-noclegowa single-event-dbs">
	<div class="row">
	<?php
		$baza_noclegowa_baner = get_field('transport_baner');
		if( !empty($baza_noclegowa_baner) )
		{
			$baner_src = $baza_noclegowa_baner['url'];
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
			<h3 class="tungsten-semibold niezbednik__title"><?php _e( 'transport', 'biuro-literackie' ); ?></h3>
		</div>
	</div>
	
	<?php
		// loop through the rows of data
		while ( have_rows('transport') ) : the_row(); 
			$location = get_sub_field('mapa');
			$nazwa = mb_strtolower(get_sub_field('nazwa'), 'UTF-8');
			$url = get_sub_field('url');
			$opis = get_sub_field('opis'); ?>
		<div class="row single-place-dbs" style="margin-top:50px;">
			<div class="col-xs-8 col-md-5 col-md-offset-1">
				<h4 class="lato-font"><?php echo $nazwa; ?></h4>
				<?php if ($opis) : ?>
				<span class="playfair-display desc"><?php echo $opis; ?></span>
				<?php endif; ?>
			</div>
			
			<div class="col-xs-4 col-md-6">
			<?php if( get_sub_field('zdjecie') ): ?>
				<img src="<?php echo the_sub_field('zdjecie');?>">
				<?php endif; ?>
			</div>
		</div>	
		<?php endwhile;?>	
</div>
<?php endif;
/** BAZA NOCLEGOWA **/ ?>
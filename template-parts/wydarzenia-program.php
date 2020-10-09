<?php
/** PLACEHOLDERS **/
$placeholder_location = get_template_directory_uri().'/img/placeholders/';
$placeholder = array();
$placeholder['75x75'] = $placeholder_location.'75x75.png';
$uczestnik = array();
if( have_rows('uczestnicy') )
{
	while ( have_rows('uczestnicy') )
	{ the_row();
		if( have_rows('uczestnik_repeater') )
		{
			while ( have_rows('uczestnik_repeater') )
			{ the_row();
				$zdjecie = get_sub_field('zdjecie');
				$zdjecie_url = $placeholder['75x75'];
				$imie = get_sub_field('imie');
				$nazwisko = get_sub_field('nazwisko');
				$separator = '';
				$plus = '';
				if ( $imie && $nazwisko )
				{
					$separator = '_';
					$plus = '+';
				}
				if( $zdjecie )
				{
					$zdjecie_url = $zdjecie['sizes']['thumbnail'];
				}

				$uczestnik[$imie.$separator.$nazwisko] = array();
				$uczestnik[$imie.$separator.$nazwisko]['zdjecie'] = $zdjecie_url;
				$uczestnik[$imie.$separator.$nazwisko]['url'] = '?uczestnik=';
				$uczestnik[$imie.$separator.$nazwisko]['url'] .= urlencode( mb_strtolower($imie.$plus.$nazwisko,'UTF-8') );
			}
		}
	}
}
/** PROGRAM **/
if( have_rows('dzien') ) { ?>
<style>
.ul__wydarzenia-dbs div > div .wydarzenie_div-dbs:last-child {
	border-bottom: none;
}
</style>
<div class="navigation-btns lato-font">
	<div class="left">
		<a href="<?php echo get_permalink(); ?>">
		<span><?php _e( 'powrót na stronę główną', 'biblioteka' ); ?></span></a>
	</div>
	<?php
	/** NIEZBĘDNIK **/
	if( have_rows('miejscawydarzen') || have_rows('miejsca_noclegowa') || get_field('bilety_na_koncerty')  ) : ?>
	<div class="right">
		<a href="<?php echo get_permalink(); ?>?strona=niezbednik">
		<span><?php _e( 'niezbędnik', 'biblioteka' ); ?></span></a>
	</div>
	<?php endif; 
	/** NIEZBĘDNIK KONIEC **/ ?>
</div>
<section id="wydarzenia__program" class="wydarzenia__program-single">
	<div class="wrap-dbs">
		<div id="program">
			<h3 class="wydarzenia__title lato-font"><?php _e( 'program', 'biblioteka' ); ?></h3>
			<?php
			$date = array();
			$dzien = 0;
			if( have_rows('dzien') ): 
				while ( have_rows('dzien') ) : the_row();
				$dzien++;
				$data = get_sub_field('data_dbs', false, false);
				$data = new DateTime($data);
				$date[$dzien] = $data->format('jm');
				endwhile;
			endif; 
			
			$dzien = 0;
			if( have_rows('dzien') ): ?>
			<ul class="ul__wydarzenia-dbs">
				<?php
				while ( have_rows('dzien') ) : the_row();
				$dzien++;
				$data = get_sub_field('data_dbs', false, false);
				$data = new DateTime($data);
				
				?>
				<div style="margin: 50px 0;">
					<ul class="dni_ul-dbs row active" style="margin: 0 -34px;">
						<li class="col-sm-3 col-md-3" style="background-color: #d01117;">
							<a href="#dzien-<?php echo $dzien;?>">
								<span class="dzien_data"><?php echo $data->format('j/m'); ?></span><br />
								<span class="nazwa lato-font"><?php the_sub_field('nazwa_dnia'); ?></span>
							</a>
						</li>
					</ul>
					<div id="dzien-<?php echo $dzien;?>">
					<?php
					if( have_rows('wydarzenie') ): // check if the repeater field has rows of data
						while ( have_rows('wydarzenie') ) : the_row();
							$single_url = get_permalink();
							$single_url .= '?program=';
							$single_url .= rawurlencode( mb_strtolower(get_sub_field('nazwa_wydarzenia'),'UTF-8') );
							$single_url .= '&dzien=';
							$single_url .= filter_var ( $date[$dzien], FILTER_SANITIZE_NUMBER_INT);
							$single_url .= '&godz=';
							$single_url .= filter_var ( get_sub_field('godz'), FILTER_SANITIZE_NUMBER_INT); ?>
							
							<div class="wydarzenie_div-dbs">
								<div class="row">
									<?php /** WYDARZENIA LEWO **/ ?>
									<div class="col-sm-4 col-md-4 lato-font">
									
										<div class="row">
											<div class="visible-xs col-xs-12">
												<span class="nazwa_wydarzenia-dbs">
													<a href="<?php echo $single_url; ?>" target="_blank">
														<?php the_sub_field('nazwa_wydarzenia'); ?>
													</a>
												</span>
											</div>
										</div>
																	
										<div class="row dane_wydarzenia">
											<div class="col-xs-2 col-md-2"><i class="fa fa-clock-o" aria-hidden="true"></i> </div>
											<div class="col-xs-10 col-md-10"><?php the_sub_field('godz');?> </div>
										</div>
										
										<div class="row dane_wydarzenia miejsce_wydarzenia-dbs">
											<div class="col-xs-2 col-md-2"><i class="fa fa-location-arrow" aria-hidden="true"></i> </div>
											<div class="col-xs-10 col-md-10"><?php the_sub_field('miejsce');?> </div>
										</div>
										
										<div class="row dane_wydarzenia uczestnicy_wydarzenia-dbs">
											<div class="col-xs-2 col-md-2"><i class="fa fa-user" aria-hidden="true"></i> </div>
											<div class="col-xs-10 col-md-10">
											<?php if( have_rows('uczestnicy') ): ?>
											<ul>
												<p><?php _e( 'uczestnicy', 'biblioteka' ); ?></p>
												<?php
												while ( have_rows('uczestnicy') ) : the_row();
												$imie = get_sub_field('imie');
												$nazwisko = get_sub_field('nazwisko');
												$separator = '';
												if ( $imie && $nazwisko )
												{
													$separator = '_';
												}
												
												if ( !empty( $uczestnik[$imie.$separator.$nazwisko] ) )
												{
												?>
												<li>
													<a href="<?php echo $uczestnik[$imie.$separator.$nazwisko]['url']; ?>" target="_blank">
														<?php the_sub_field('imie');?> <?php the_sub_field('nazwisko'); ?>
													</a>
												</li>
												<?php
												}
												else
												{
												?>
												<li>
													<?php the_sub_field('imie');?> <?php the_sub_field('nazwisko'); ?>
												</li>
												<?php
												}
												endwhile; ?>
											</ul>
											<?php endif;
											
											if( have_rows('prowadzacy') ): ?>
											<p><?php _e( 'prowadzący', 'biblioteka' ); ?></p>
											<ul>
												<?php
												while ( have_rows('prowadzacy') ) : the_row();
												$imie = get_sub_field('imie');
												$nazwisko = get_sub_field('nazwisko');
												$separator = '';
												if ( $imie && $nazwisko )
												{
													$separator = '_';
												}
												
												if ( !empty( $uczestnik[$imie.$separator.$nazwisko] ) )
												{
												?>
												<li>
													<a href="<?php echo $uczestnik[$imie.$separator.$nazwisko]['url']; ?>" target="_blank">
														<?php the_sub_field('imie');?> <?php the_sub_field('nazwisko'); ?>
													</a>
												</li>
												<?php
												}
												else
												{
												?>
												<li>
													<?php the_sub_field('imie');?> <?php the_sub_field('nazwisko'); ?>
												</li>
												<?php
												}
												endwhile; ?>
											</ul>
											<?php endif; ?>
											</div>
										</div>
									</div>

									<?php /** WYDARZENIA PRAWO **/ ?>
									<div class="col-sm-8 col-md-8">
										<span class="visible-sm visible-md visible-lg nazwa_wydarzenia-dbs">
											<a href="<?php echo $single_url; ?>" target="_blank">
												<?php the_sub_field('nazwa_wydarzenia');?>
											</a>
										</span>
										<span class="playfair-display opis-wydarzenia-dbs">
											<?php if ( get_sub_field('opis_wysiwyg') ) : ?>
												<?php
												$opis_wysiwyg = get_sub_field('opis_wysiwyg');
												if ( strpos($opis_wysiwyg, '<p><!--more--></p>') !== false )
												{
													$opis_wysiwyg = substr($opis_wysiwyg, 0, strpos($opis_wysiwyg, '<p><!--more--></p>'));
													$opis_wysiwyg = strip_tags($opis_wysiwyg, '<p><a>');
												}
												echo $opis_wysiwyg; ?>
												<span class="read-more lato-font">
													<a href="<?php echo $single_url; ?>" target="_blank" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>"><?php _e( 'więcej', 'biblioteka' ); ?></a>
												</span>
											<?php /** elseif ( get_sub_field('opis') ) : ?>
												<?php the_sub_field('opis'); ?>
												<span class="read-more lato-font 190816">
													<a href="<?php echo $single_url; ?>" target="_blank" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>"><?php _e( 'więcej', 'biblioteka' ); ?></a>
												</span> <?php **/ ?> 
											<?php endif; ?>
										</span>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 no-padding">
										<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
										<?php if ( get_sub_field('kategoria') ) : ?>
											<div class="lato-font kategoria_wydarzenia-dbs">
												<span><?php the_sub_field('kategoria');?></span>
											</div>
										<?php endif; ?>
										</div>
									</div>
									<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0 col-md-8 col-md-offset-0 uczestnicy_wydarzenia-dbs">
										<?php
										$uczestnicy_wydarzenia = array();
										$uczestnicy_count = 0;
										if( have_rows('uczestnicy') )
										{
											while ( have_rows('uczestnicy') )
											{ 
												the_row();
												$uczestnicy_count++;
												$imie = get_sub_field('imie');
												$nazwisko = get_sub_field('nazwisko');

												$uczestnicy_wydarzenia[$uczestnicy_count]['imie'] = get_sub_field('imie');
												$uczestnicy_wydarzenia[$uczestnicy_count]['nazwisko'] = get_sub_field('nazwisko');
											}
										}
										if( have_rows('prowadzacy') )
										{
											while ( have_rows('prowadzacy') )
											{ 
												the_row();
												$uczestnicy_count++;
												$imie = get_sub_field('imie');
												$nazwisko = get_sub_field('nazwisko');

												$uczestnicy_wydarzenia[$uczestnicy_count]['imie'] = get_sub_field('imie');
												$uczestnicy_wydarzenia[$uczestnicy_count]['nazwisko'] = get_sub_field('nazwisko');
											}
										}
										foreach ( $uczestnicy_wydarzenia as $uczestnik_wydarzenia )
										{
											$imie = $uczestnik_wydarzenia['imie'];
											$nazwisko = $uczestnik_wydarzenia['nazwisko'];
											$separator = '';
											if ( $imie && $nazwisko )
											{
												$separator = '_';
											}
											
											if ( !empty( $uczestnik[$imie.$separator.$nazwisko] ) )
											{
											?>	
											<a href="<?php echo $uczestnik[$imie.$separator.$nazwisko]['url']; ?>" target="_blank">
												<img src="<?php echo $uczestnik[$imie.$separator.$nazwisko]['zdjecie']; ?>" title="<?php echo $imie.' '.$nazwisko; ?>" alt="<?php echo $imie.' '.$nazwisko; ?>" />
											</a>
											<?php
											}
										}
										?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php else :
						// no rows found

					endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
			</ul>
		<?php else :
			// no rows found
		endif; ?>
		</div>
	</div>
</section>
<?php } ?>
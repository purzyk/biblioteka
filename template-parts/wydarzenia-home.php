<?php
/** PLACEHOLDERS **/
$placeholder_location = get_template_directory_uri().'/img/placeholders/';
$placeholder = array();
$placeholder['75x75'] = $placeholder_location.'75x75.png';
$uczestnik = array();
$premiery = array();
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
} ?>

<div class="navigation-btns lato-font">
	<?php /*
	<div class="left">
		<a href="https://www.biuroliterackie.pl/biblioteka/">
		<span><?php _e( 'powrót na stronę na główną', 'biblioteka' ); ?><span></a>
	</div>
	*/ ?>
	<?php if( have_rows('dzien') ) : ?>
	<div class="right">
		<a href="<?php echo get_permalink(); ?>?program">
		<span><?php _e( 'program', 'biblioteka' ); ?></span></a>
	</div>
	<?php endif; ?>
</div>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php /** INFORMACJE **/
		$tytul_wydarzenia = get_field('tytul_wydarzenia');
		if ( get_the_content() || $tytul_wydarzenia  ) :
		?>
		<section id="informacje" class="wydarzenia__informacje-dubas">
			<div class="wrap-dbs">
				<?php if ($tytul_wydarzenia) : ?>
					<h3 class="wydarzenia__title"><?php echo $tytul_wydarzenia; ?></h3>
				<?php endif; ?>

				<?php if ( get_the_content() ) : ?>
				<div class="column playfair-display">
				<?php the_content(); ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
		endif;

		/** ODLICZANIE **/
        $bg_wydarzenia = get_field('baner_wydarzenia_fb') ? get_field('baner_wydarzenia_fb')['url'] : '//www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/odliczanie.jpg';
		$data_wydarzenia = get_field('data');
		if ( $data_wydarzenia ) : ?>
		<section id="wydarzenia__odliczanie" style="background: url(<?php echo $bg_wydarzenia; ?>) center center no-repeat;">
			<?php if( get_field('facebook_link') ): ?>
				<a target="_blank" class="wydarzenie_na_facebooku lato-font" href="<?php the_field('facebook_link'); ?>"><?php _e( 'wydarzenie na fb', 'biblioteka' ); ?></a>
			<?php endif; ?>
			<div id="clockdiv">
				<div>
					<span class="days tungsten-semibold"></span>
					<p class="smalltext lato-font"><?php _e( 'dni', 'biblioteka' ); ?></p>
				</div>
				<div>
					<span class="hours tungsten-semibold"></span>
					<p class="smalltext lato-font"><?php _e( 'godziny', 'biblioteka' ); ?></p>
				</div>
				<div>
					<span class="minutes tungsten-semibold"></span>
					<p class="smalltext lato-font"><?php _e( 'minuty', 'biblioteka' ); ?></p>
				</div>
				<div>
					<span class="seconds tungsten-semibold"></span>
					<p class="smalltext lato-font"><?php _e( 'sekundy', 'biblioteka' ); ?></p>
				</div>
			</div>
			<script>
			function getTimeRemaining(endtime)
			{
				var t = Date.parse(endtime) - Date.parse(new Date());
				var seconds = Math.floor((t / 1000) % 60);
				var minutes = Math.floor((t / 1000 / 60) % 60);
				var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
				var days = Math.floor(t / (1000 * 60 * 60 * 24));
				return {
				'total': t,
				'days': days,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
				};
			}

			function initializeClock(id, endtime)
			{
				var clock = document.getElementById(id);
				var daysSpan = clock.querySelector('.days');
				var hoursSpan = clock.querySelector('.hours');
				var minutesSpan = clock.querySelector('.minutes');
				var secondsSpan = clock.querySelector('.seconds');

				function updateClock()
				{
					var t = getTimeRemaining(endtime);

					daysSpan.innerHTML = t.days;
					hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
					minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
					secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

					if (t.total <= 0)
					{
						clearInterval(timeinterval);
					}
				}

				updateClock();
				var timeinterval = setInterval(updateClock, 1000);
			}

			var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
			var dear2 = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);

			var taaa = Date.parse(new Date());
			var deadline = '<?php echo $data_wydarzenia; ?>';
			//var deadline = '2016-09-16';
			initializeClock('clockdiv', deadline);
			</script>
		</section>
		<?php endif; // if ($data_wydarzenia) ?>

		<?php /** ZAPOWIEDŹ **/
		if( have_rows('zapowiedz_by_dubas') ) : ?>
		<section id="wydarzenia__zapowiedz" class="playfair-display">
			<div class="wrap-dbs">
				<h3 class="wydarzenia__title"><?php _e( 'zapowiedź', 'biblioteka' ); ?></h3>
				<div class="zapowiedz-carousel">
				<?php
				while ( have_rows('zapowiedz_by_dubas') ) : the_row();
				$id = get_sub_field('id');
				$tytul = get_sub_field('tytul');
				$tresc = get_sub_field('tresc');
				?>
				<div class="row" style="margin: 0;">
					<span class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-sm-push-6 col-md-6 col-md-offset-0 col-md-push-6 no-padding">
						<h4 class="wydarzenia_h4"><?php echo $tytul; ?></h4>
						<?php if ( $tresc ) : ?>
						<span><?php echo $tresc; ?></span>
						<?php endif; ?>
					</span>
					<span class="col-xs-12 col-sm-6 col-sm-pull-6 col-md-6 col-md-pull-6" style="padding-left:0;">
						<iframe src="https://www.youtube.com/embed/<?php echo $id; ?>?vq=hd1080" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</span>
				</div>
				<?php endwhile; //have_rows('zapowiedz_by_dubass') ?>
				</div>
			</div>
		</section>
		<script>
		jQuery(".zapowiedz-carousel").carousel({
			pagination: false
		});
		</script>
		<?php
		endif; //if( have_rows('zapowiedz_by_dubas') ) ?>

		<?php /** WIADOMOŚCI **/
		$wiadomosci_term = get_field('choose_cat');
		if( $wiadomosci_term ):

			/** ARGUMENTS */
			$args = array(
				'posts_per_page'   => -1,
				'post_type' => 'biuletyn',
				'tax_query' => array(
				array(
					'taxonomy' => 'biuletyn_kategorie',
					'field' => 'slug',
					'terms' => $wiadomosci_term->slug
					)
				)
			);
			$event_news = null;
			$event_news = new WP_Query($args);
			if( $event_news->have_posts() )
			{
			?>
			<section id="wydarzenia__wiadomosci">
				<div class="wrap-dbs lato-font">
					<div class="row">
						<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
							<h3 class="wydarzenia__title"><?php _e( 'wiadomości', 'biblioteka' ); ?></h3>
						</div>
						<div class="col-xs-6 col-xs-offset-3 col-md-2 col-md-offset-2 term-url">
							<a href="?news<?php /** echo get_term_link( $wiadomosci_term->term_taxonomy_id ); **/ ?>" title="<?php _e( 'zobacz więcej', 'biblioteka' ); ?>" target="_blank">
							<?php _e( 'zobacz więcej', 'biblioteka' ); ?>
							</a>
						</div>
					</div>
					<div class="carousel">
						<?php while ($event_news->have_posts()) : $event_news->the_post();
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id,'large');
						$image_url = $image_url[0];
						if ( empty($image_url) )
						{
							$image_url = get_template_directory_uri().'/img/placeholder.png';
						}
						?>
						<div class="row event__news">
							<?php /** FEATURED IMAGE **/ ?>
							<span class="col-xs-12 col-sm-12 col-md-6" style="background-image:url(<?php echo $image_url; ?>);"></span>
							<?php /** TEXT **/ ?>
							<span class="col-xs-12 col-sm-12 col-md-6">
								<h4 class="title tungsten-semibold"><?php the_title(); ?></h4>
								<div class="data">
									<span class="date"><?php the_date('d/m/Y'); ?></span>
									<span class="cat"><?php echo $wiadomosci_term->name; ?></span>
								</div>
								<span class="playfair-display excerpt"><?php the_excerpt(); ?></span>
								<span class="more">
									<a href="<?php echo the_permalink(); ?>"><?php _e( 'WIĘCEJ', 'biblioteka' ); ?></a>
								</span>
							</span>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<script>
			jQuery(".carousel").carousel({
				pagination: false
			});
			</script>
			<?php
			}
			wp_reset_query();
		endif; ?>


		<?php /** UCZESTINCY **/
            get_template_part( 'template-parts/partials/single_wydarzenia/module', 'uczestnicy_home' );
        /** end UCZESTINCY **/
        

		/** PROGRAM **/
		if( have_rows('dzien') ) { ?>
		<section id="wydarzenia__program">
			<div class="wrap-dbs">
				<div id="program">
					<h3 class="wydarzenia__title lato-font"><?php _e( 'program', 'biblioteka' ); ?></h3>
					<?php
					$date = array();
					$dzien = 0;
					if( have_rows('dzien') ): ?>
					<ul class="dni_ul-dbs row">
						<?php // loop through the rows of data
						while ( have_rows('dzien') ) : the_row();
						$dzien++;
						$data = get_sub_field('data_dbs', false, false);
						$data = new DateTime($data);
						$date[$dzien] = $data->format('jm');
						?>
						<li class="col-sm-3 col-md-3">
							<a href="#dzien-<?php echo $dzien;?>">
								<span class="dzien_data"><?php echo $data->format('j/m'); ?></span><br />
								<span class="nazwa lato-font"><?php the_sub_field('nazwa_dnia'); ?></span>
							</a>
						</li>
						<?php // display a sub field value
						endwhile; ?>
					</ul>
					<?php else:
						// no rows found
					endif;

					$dzien = 0;
					if( have_rows('dzien') ): ?>
					<ul class="ul__wydarzenia-dbs">
						<?php
						while ( have_rows('dzien') ) : the_row();
						$dzien++;
						?>
						<div id="dzien-<?php echo $dzien;?>">
						<?php
						if( have_rows('wydarzenie') ): // check if the repeater field has rows of data
							while ( have_rows('wydarzenie') ) : the_row();
								$premiery[] = get_sub_field('premiery');
								$single_url = '?program=';
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
					<?php endwhile; ?>
					</ul>
				<?php else :
					// no rows found
				endif; ?>
				</div>
			</div>
		</section>
		<script>
		$(function()
		{
			$( "#program" ).tabs();
		});
		</script>
		<?php } ?>

		<?php /** NIEZBĘDNIK **/
		$niezbednik_count = 0;
		$niezbednik_col_offset = '';
        if( have_rows('transport') )
		{
			$niezbednik_count = $niezbednik_count+1;
		}
		if( have_rows('miejscawydarzen') )
		{
			$niezbednik_count = $niezbednik_count+1;
		}
		if( have_rows('miejsca_noclegowa') )
		{
			$niezbednik_count = $niezbednik_count+1;
		}
		if( get_field('bilety_na_koncerty') )
		{
			$niezbednik_count = $niezbednik_count+1;
		}

		if ( $niezbednik_count === 1 )
		{
			$niezbednik_col_offset = 'col-md-offset-4';
		}
		elseif ( $niezbednik_count === 2 )
		{
			$niezbednik_col_offset = 'col-md-offset-2';
		}
		if ( $niezbednik_count > 0 ) :
		$bg_niezbednik = get_template_directory_uri().'/img/wydarzenia/niezbednik-tlo.jpg';
        $icon_transport = get_template_directory_uri().'/img/wydarzenia/transport.png';
		$icon_miejsca = get_template_directory_uri().'/img/wydarzenia/miejsca.png';
		$icon_noclegi = get_template_directory_uri().'/img/wydarzenia/noclegi.png';
		$icon_bilety = get_template_directory_uri().'/img/wydarzenia/bilety.png';
		?>
		<section id="wydarzenia__niezbednik">
			<div class="container">
				<div class="col-md-12">
					<h3 class="wydarzenia__title lato-font"><?php _e( 'niezbędnik', 'biblioteka' ); ?></h3>
				</div>
			</div>

			<div class="wrap-dbs bg-cover" style="background-image:url(<?php echo $bg_niezbednik; ?>);">
				<div class="row row-count-<?php echo $niezbednik_count; ?>">
                    
                    <?php if( have_rows('transport') ) : ?>
					<div class="col-md-4">
						<img src="<?php echo $icon_transport; ?>" />
						<p><?php _e( 'transport', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a target="_blank" href="?strona=niezbednik&sekcja=transport" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; //have_rows('transport') ?>
                    
					<?php if( have_rows('miejscawydarzen') ) : ?>
					<div class="col-md-4">
						<img src="<?php echo $icon_miejsca; ?>" />
						<p><?php _e( 'miejsca wydarzeń', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a target="_blank" href="?strona=niezbednik&sekcja=miejsca" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; //have_rows('miejscawydarzen') ?>

					<?php if( have_rows('miejsca_noclegowa') ) : ?>
					<div class="col-md-4">
						<img src="<?php echo $icon_noclegi; ?>" />
						<p><?php _e( 'baza noclegowa', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a target="_blank" href="?strona=niezbednik&sekcja=noclegi" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; //have_rows('miejsca_noclegowa') ?>

					<?php if( get_field('bilety_na_koncerty') ) : ?>
					<div class="col-md-4">
						<img src="<?php echo $icon_bilety; ?>" />
						<p><?php _e( 'bilety na koncerty', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a target="_blank" href="?strona=niezbednik&sekcja=bilety" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; //get_field('bilety_na_koncerty') ?>

				</div>
			</div>
		</section>
		<script>
		$(function() {
			$( "#wydarzenia__niezbednik .row-count-<?php echo $niezbednik_count; ?> > div:first-child" ).addClass( "<?php echo $niezbednik_col_offset; ?>" );
		});
		</script>
		<?php endif; //$niezbednik_count > 0 ?>

		<?php /** PREMIERY **/
            get_template_part( 'template-parts/partials/single_wydarzenia/module', 'premiery' );
		?>

		<?php /** INFO **/
		$info_count = 0;
		$info_col = 'col-md-4';
		$info_col_offset = '';
		if ( get_field('realizatorzy') )
		{
			$info_count = $info_count+1;
		}
		if ( have_rows('multimedia') )
		{
			$info_count = $info_count+1;
		}
		if ( get_field('akredytacje') )
		{
			$info_count = $info_count+1;
		}
		if ( get_field('wolontariat') )
		{
			$info_count = $info_count+1;
		}

		if ( $info_count === 1 )
		{
			$info_col_offset = 'col-md-offset-4';
		}
		elseif ( $info_count === 2 )
		{
			$info_col_offset = 'col-md-offset-2';
		}
		if ( $info_count === 4 )
		{
			$info_col = 'col-md-3';
		}
		if ( $info_count > 0 ) :
		$bg_info = get_template_directory_uri().'/img/wydarzenia/niezbednik-tlo.jpg';

		$link_realizatorzy = '?strona=info&sekcja=realizatorzy';
		$link_multimedia = '?strona=info&sekcja=multimedia';
		$link_akredytacje = '?strona=info&sekcja=akredytacje';
		$link_wolontariat = '?strona=info&sekcja=wolontariat';

		$icon_realizatorzy = get_template_directory_uri().'/img/info/realizatorzy.png';
		$icon_multimedia = get_template_directory_uri().'/img/info/multimedia.png';
		$icon_akredytacje = get_template_directory_uri().'/img/wydarzenia/bilety.png';
		?>
		<section id="wydarzenia__info">
			<div class="container">
				<div class="col-md-12">
					<h3 class="wydarzenia__title lato-font"><?php _e( 'info', 'biblioteka' ); ?></h3>
				</div>
			</div>

			<div class="wrap-dbs">
				<div class="row row-count-<?php echo $info_count; ?>">

					<?php if ( get_field('realizatorzy') ) : ?>
					<div class="<?php echo $info_col; ?>">
						<img src="<?php echo $icon_realizatorzy; ?>" />
						<p><?php _e( 'realizatorzy', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a href="<?php echo $link_realizatorzy; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; ?>

					<?php if ( have_rows('multimedia') ) : ?>
					<div class="<?php echo $info_col; ?>">
						<img src="<?php echo $icon_multimedia; ?>" />
						<p><?php _e( 'multimedia', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a href="<?php echo $link_multimedia; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; ?>

					<?php if ( get_field('akredytacje') ) : ?>
					<div class="<?php echo $info_col; ?>">
						<i class="fa fa-bullhorn" aria-hidden="true"></i>
						<p><?php _e( 'dziennikarze', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a href="<?php echo $link_akredytacje; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; ?>

					<?php if ( get_field('wolontariat') ) : ?>
					<div class="<?php echo $info_col; ?>">
						<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
						<p><?php _e( 'wolontariat', 'biblioteka' ); ?></p>

						<span class="wiecej-button">
							<a href="<?php echo $link_wolontariat; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
								<?php _e( 'więcej', 'biblioteka' ); ?>
							</a>
						</span>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</section>
			<?php if ( $info_count <= 2 ) : ?>
			<script>
			$(function() {
				$( "#wydarzenia__info .row-count-<?php echo $info_count; ?> > div:first-child" ).addClass( "<?php echo $info_col_offset; ?>" );
			});
			</script>
			<?php endif; //$info_count <= 2 script ?>
		<?php endif; //$info_count ?>

		<?php /** PRZYJACIELE **/ ?>
		<section id="wydarzenia__przyjaciele" class="lato-font">
			<div class="wrap-dbs">

				<?php /* ORGANIZATORZY */
				$organizatorzy = 'organizatorzy';
				if( have_rows($organizatorzy) ):
				$nth = 0;
				?>
				<h4 class="partnerzy_h4"><?php _e( 'organizatorzy', 'biblioteka' ); ?></h4>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<?php
					while ( have_rows($organizatorzy) ) : the_row();
					$nth++;

					$image = get_sub_field('zdjecie');
					$url = get_sub_field('link_url');
					$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)
					$offset = '';
					if ($nth <= 1) { $offset = 'col-xs-offset-4 col-sm-offset-4 col-md-offset-4'; }

					if( $image )
					{ ?>
						<div class="col-xs-4 col-sm-4 col-md-4 no-padding <?php echo $offset; ?>">
							<a style="display: block;text-align: center;" target="_blank" href="<?php echo $url;?>">
								<?php echo wp_get_attachment_image( $image, $size ); ?>
							</a>
						</div>
					<?php
					}
					endwhile; ?>
					</div>
				</div>
				<?php
				if ($nth === 1 )
				{
					$col_offset = 'col-md-offset-4';
				}
				elseif ( $nth === 2 )
				{
					$col_offset = 'col-md-offset-2';
				}
				//echo $col_offset;
				endif; // END OF THE SECTION

				/* MECENASI */
				$mecenasi = 'mecenasi';
				if( have_rows($mecenasi) ):
				$nth=0;
				?>
				<h4 class="partnerzy_h4"><?php _e( 'mecenasi', 'biblioteka' ); ?></h4>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php
						while ( have_rows($mecenasi) ) : the_row();
						$nth++;

						$image = get_sub_field('obrazek');
						$url = get_sub_field('url');
						$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)
						$offset = '';
						if ($nth <= 0) { $offset = 'col-xs-offset-4 col-sm-offset-4 col-md-offset-4'; }

						if( $image )
						{ ?>
							<div class="col-xs-4 col-sm-4 col-md-4 no-padding <?php echo $offset; ?>">
								<a style="display: block;text-align: center;" target="_blank" href="<?php echo $url;?>">
									<?php echo wp_get_attachment_image( $image['id'], $size ); ?>
								</a>
							</div>
						<?php
						}
						endwhile; ?>
					</div>
				</div>
				<?php
				else:
					// no rows found
				endif; // END OF THE SECTION

				/* PARTNERZY */
				$partnerzy = 'partnerzy';
				if( have_rows($partnerzy) ):
				$nth=0;
				?>
				<h4 class="partnerzy_h4"><?php _e( 'partnerzy', 'biblioteka' ); ?></h4>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php
						while ( have_rows('partnerzy') ) : the_row();
						$nth++;

						$image = get_sub_field('zdjecie');
						$url = get_sub_field('link_url');
						$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)
						$offset = '';
						$image = get_sub_field('zdjecie');
						$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)

						if ($nth <= 0) { $offset = 'col-xs-offset-4 col-sm-offset-4 col-md-offset-4'; }

						if( $image )
						{ ?>
							<div class="col-xs-4 col-sm-4 col-md-4 no-padding <?php echo $offset; ?>">
								<a style="display: block;text-align: center;" target="_blank" href="<?php echo $url;?>">
									<?php echo wp_get_attachment_image( $image, $size ); ?>
								</a>
							</div>
						<?php
						}
						endwhile; ?>
					</div>
				</div>
				<?php else :
					// no rows found
				endif; // END OF THE SECTION

				/* PATRONI */
				$patroni = 'patroni_medialni';
				if( have_rows($patroni) ):
				$nth=0; ?>
				<h4 class="partnerzy_h4"><?php _e( 'patroni medialni', 'biblioteka' ); ?></h4>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<?php
						while ( have_rows($patroni) ) : the_row();
						$nth++;

						$image = get_sub_field('zdjecie');
						$url = get_sub_field('link_url');
						$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)
						$offset = '';
						$image = get_sub_field('zdjecie');
						$size = 'bl_blog'; // (thumbnail, medium, large, full or custom size)

						if ($nth <= 0) { $offset = 'col-xs-offset-4 col-sm-offset-4 col-md-offset-4'; }

						if( $image )
						{ ?>
							<div class="col-xs-4 col-sm-4 col-md-4 no-padding <?php echo $offset; ?>">
								<a style="display: block;text-align: center;" target="_blank" href="<?php echo $url;?>">
									<?php echo wp_get_attachment_image( $image, $size ); ?>
								</a>
							</div>
						<?php
						}
						endwhile; ?>
					</div>
				</div>
				<?php else :
					// no rows found
				endif; ?>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<script>
	jQuery(document).ready(function($){
		$('.scroll-to').on('click',function (e) {
			e.preventDefault();

			var target = this.hash;
			var $target = $(target);

			$('html, body').stop().animate({
				'scrollTop': $target.offset().top
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
	});
</script>

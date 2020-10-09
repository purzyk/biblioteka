<?php
// I AM SORRY!!!

/** PLACEHOLDERS **/
$placeholder_location = get_template_directory_uri().'/img/placeholders/';
$placeholder = array();
$placeholder['300x300'] = $placeholder_location.'300x300.png';

$wydarzenie = array();
$uczestnicy_wszyscy = array();

$date = array();
$dzien = 0;
$i = 0;
if( have_rows('dzien') )
{
	while ( have_rows('dzien') )
	{
		the_row();
		$dzien++;
		$data_url = $_GET['dzien'];
		$data_dbs = get_sub_field('data_dbs', false, false);
		$data_dbs = new DateTime($data_dbs);
		$data_obecna = $data_dbs->format('jm');	
		$date[$dzien] = $data_obecna;
		$dateformatstring = "d F Y";
		$data = strtotime(get_sub_field('data_dbs', false, false));
		if ( $data_url === $data_obecna )
		{
			$wydarzenie['data'] = date_i18n($dateformatstring, $data);
			
			if( have_rows('wydarzenie') )
			{
				while ( have_rows('wydarzenie') )
				{
					the_row();
					$i++;
					/** GODZINA WYDARZENIA **/
					$godz_url = $_GET['godz'];
					$godz_curr = get_sub_field('godz');
					$godz_curr = filter_var( $godz_curr, FILTER_SANITIZE_NUMBER_INT);
					/** TYTUŁ WYDARZENIA **/
					$tytul_url = $_GET['program'];
					$tytul_url = str_replace("\\","",$tytul_url);
					$tytul_curr = get_sub_field('nazwa_wydarzenia');
					$tytul_curr = mb_strtolower($tytul_curr,'UTF-8');

					if ( $godz_url == $godz_curr && $tytul_url == $tytul_curr )
					{
						$wydarzenie['next'] = $i+1;
						$wydarzenie['godz'] = get_sub_field('godz');
						$wydarzenie['miejsce'] = get_sub_field('miejsce');
						$wydarzenie['kategoria'] = get_sub_field('kategoria');
						$wydarzenie['tytul'] = get_sub_field('nazwa_wydarzenia');
						$wydarzenie['opis'] = get_sub_field('opis');
						$wydarzenie['opis_wysiwyg'] = get_sub_field('opis_wysiwyg');
						$wydarzenie['premiery'] = get_sub_field('premiery');
						if( have_rows('uczestnicy') )
						{
							$uczestnicy_count = 0;
							while ( have_rows('uczestnicy') )
							{
								the_row();
								$uczestnicy_count++;
								$imie = get_sub_field('imie');
								$nazwisko = get_sub_field('nazwisko');
								$wydarzenie['uczestnicy'][$uczestnicy_count]['imie'] = $imie;
								$wydarzenie['uczestnicy'][$uczestnicy_count]['nazwisko'] = $nazwisko;
							}
						}
						if( have_rows('prowadzacy') )
						{
							$prowadzacy_count = 0;
							while ( have_rows('prowadzacy') )
							{
								the_row();
								$prowadzacy_count++;
								$imie = get_sub_field('imie');
								$nazwisko = get_sub_field('nazwisko');
								$wydarzenie['prowadzacy'][$prowadzacy_count]['imie'] = $imie;
								$wydarzenie['prowadzacy'][$prowadzacy_count]['nazwisko'] = $nazwisko;
							}
						}
					}
					/** GET NEXT EVENT **/
					if ( $i == $wydarzenie['next'] )
					{
						$single_url = get_permalink();
						$single_url .= '?program=';
						$single_url .= rawurlencode( mb_strtolower(get_sub_field('nazwa_wydarzenia'),'UTF-8') );
						$single_url .= '&dzien=';
						$single_url .= filter_var ( $date[$dzien], FILTER_SANITIZE_NUMBER_INT);
						$single_url .= '&godz=';
						$single_url .= filter_var ( get_sub_field('godz'), FILTER_SANITIZE_NUMBER_INT);
						
						$wydarzenie['next_url'] = $single_url;
					}
					elseif ( empty($wydarzenie['next_url']) )
					{
						//$wydarzenie['next_url'] = 0;
						$wydarzenie['next_day'] = $dzien+1;
					}
				}
			}
		}
	} 
}
/** WSZYSCY UCZESTNICY **/
if( have_rows('uczestnicy') )
{
	while ( have_rows('uczestnicy') )
	{ the_row();
		if( have_rows('uczestnik_repeater') )
		{
			while ( have_rows('uczestnik_repeater') )
			{ the_row();
				$zdjecie = get_sub_field('zdjecie');
				$zdjecie_url = $placeholder['300x300'];
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
					$zdjecie_url = $zdjecie['sizes']['bl_autor'];
				}

				$uczestnicy_wszyscy[$imie.$separator.$nazwisko] = array();
				$uczestnicy_wszyscy[$imie.$separator.$nazwisko]['imie'] = get_sub_field('imie');
				$uczestnicy_wszyscy[$imie.$separator.$nazwisko]['nazwisko'] = get_sub_field('nazwisko');
				$uczestnicy_wszyscy[$imie.$separator.$nazwisko]['zdjecie'] = $zdjecie_url;
				$uczestnicy_wszyscy[$imie.$separator.$nazwisko]['url'] = '?uczestnik=';
				$uczestnicy_wszyscy[$imie.$separator.$nazwisko]['url'] .= urlencode( mb_strtolower($imie.$plus.$nazwisko,'UTF-8') );
			}
		}
	}
}
/** NEXT EVENT **/
if ( empty($wydarzenie['next_url']) )
{
	if( have_rows('dzien') )
	{
		$next_day = 0;
		while ( have_rows('dzien') )
		{
		the_row();
		$next_day++;
		$data_dbs = get_sub_field('data_dbs', false, false);
		$data_dbs = new DateTime($data_dbs);
		$data_obecna = $data_dbs->format('jm');	
		$date[$next_day] = $data_obecna;
			if ( $next_day == $wydarzenie['next_day'] && have_rows('wydarzenie') )
			{
				$i_n_day = 0;
				$n_day = get_sub_field('data_dbs', false, false);
				$n_day = new DateTime($n_day);
				$n_day_jm = $n_day->format('jm');	
				while ( have_rows('wydarzenie') )
				{
					the_row();
					$i_n_day++;
					if ( $i_n_day == 1 )
					{
						$single_url = get_permalink();
						$single_url .= '?program=';
						$single_url .= rawurlencode( mb_strtolower(get_sub_field('nazwa_wydarzenia'),'UTF-8') );
						$single_url .= '&dzien=';
						$single_url .= filter_var ( $date[$next_day], FILTER_SANITIZE_NUMBER_INT);
						$single_url .= '&godz=';
						$single_url .= filter_var ( get_sub_field('godz'), FILTER_SANITIZE_NUMBER_INT);
						
						$wydarzenie['next_url'] = $single_url;
					}
				}
			}
		}
	}
}
?>
<?php
if ( is_user_logged_in () )
{
	//print_r($wydarzenie);
}
?>
<div class="navigation-btns lato-font">
	<div class="left">
		<a href="<?php echo get_permalink(); ?>">
		<span><?php _e( 'powrót na stronę główną', 'biblioteka' ); ?></span></a>
	</div>
	<?php if ( !empty($wydarzenie['next_url']) ) : ?>
	<div class="right">
		<a href="<?php echo $wydarzenie['next_url']; ?>">
		<span><?php _e( 'następnie wydarzenie', 'biblioteka' ); ?></span></a>
	</div>
	<?php endif; ?>
</div>
<section id="wydarzenia__program" class="pojedyncze_wydarzenie">
	<div class="wrap-dbs">
		<div id="program">
			<ul class="container">
				<div class="wydarzenie_div-dbs row">
					<?php /** WYDARZENIA LEWO **/ ?>
					<div class="col-sm-4 col-md-4 lato-font">
						<div class="row">
							<div class="visible-xs col-xs-12">
								<span class="nazwa_wydarzenia-dbs">
									<?php echo $wydarzenie['tytul']; ?>
								</span>
							</div>
						</div>
						<div class="row dane_wydarzenia">
							<div class="col-xs-2 col-md-2"><i class="fa fa-calendar" aria-hidden="true"></i> </div>
							<div class="col-xs-10 col-md-10"><?php echo $wydarzenie['data']; ?> </div>
						</div>
						
						<?php if( !empty($wydarzenie['godz']) ) : ?>
						<div class="row dane_wydarzenia">
							<div class="col-xs-2 col-md-2"><i class="fa fa-clock-o" aria-hidden="true"></i> </div>
							<div class="col-xs-10 col-md-10"><?php echo $wydarzenie['godz']; ?> </div>
						</div>
						<?php endif; ?>
						
						<?php if ( !empty($wydarzenie['miejsce']) ) : ?>
						<div class="row dane_wydarzenia miejsce_wydarzenia-dbs">
							<div class="col-xs-2 col-md-2"><i class="fa fa-location-arrow" aria-hidden="true"></i> </div>
							<div class="col-xs-10 col-md-10"><?php echo $wydarzenie['miejsce']; ?> </div>
						</div>
						<?php endif; ?>
								
						<div class="row dane_wydarzenia uczestnicy_wydarzenia-dbs">
							<div class="col-xs-2 col-md-2"><i class="fa fa-user" aria-hidden="true"></i> </div>
							<div class="col-xs-10 col-md-10">
							<?php if( !empty($wydarzenie['uczestnicy']) ) : ?>
							<ul>
								<p><?php _e( 'uczestnicy', 'biblioteka' ); ?></p>
								<?php
								foreach ( $wydarzenie['uczestnicy'] as $osoba ) : 
								$imie = $osoba['imie'];
								$nazwisko = $osoba['nazwisko'];
								$separator = '';
								if ( $imie && $nazwisko )
								{
									$separator = '_';
								}
								
								if ( !empty( $uczestnicy_wszyscy[$imie.$separator.$nazwisko] ))
								{
								?>
								<li>
									<a href="<?php echo $uczestnicy_wszyscy[$imie.$separator.$nazwisko]['url']; ?>" target="_blank">
										<?php echo $imie; ?> <?php echo $nazwisko; ?>
									</a>
								</li>
								<?php
								}
								else
								{
								?>
								<li>
									<?php echo $imie; ?> <?php echo $nazwisko; ?>
								</li>
								<?php
								}
								endforeach; ?>
							</ul>
							<?php endif; ?>
							
							<?php if( !empty($wydarzenie['prowadzacy']) ) : ?>
							<ul>
								<p><?php _e( 'prowadzący', 'biblioteka' ); ?></p>
								<?php foreach ( $wydarzenie['prowadzacy'] as $osoba ) :
								$imie = $osoba['imie'];
								$nazwisko = $osoba['nazwisko'];
								$separator = '';
								if ( $imie && $nazwisko )
								{
									$separator = '_';
								}
								
								if ( !empty( $uczestnicy_wszyscy[$imie.$separator.$nazwisko] ))
								{
								?>
								<li>
									<a href="<?php echo $uczestnicy_wszyscy[$imie.$separator.$nazwisko]['url']; ?>" target="_blank">
										<?php echo $imie; ?> <?php echo $nazwisko; ?>
									</a>
								</li>
								<?php
								}
								else
								{
								?>
								<li>
									<?php echo $imie; ?> <?php echo $nazwisko; ?>
								</li>
								<?php
								}
								endforeach; ?>
							</ul>
							<?php endif; ?>
							</div>
						</div>
					</div>
					
					<?php /** WYDARZENIA PRAWO **/ ?>
					<div class="col-sm-8 col-md-8">
						<?php if( !empty($wydarzenie['kategoria']) ) : ?>
						<div class="lato-font kategoria_wydarzenia-dbs">
							<span><?php echo $wydarzenie['kategoria']; ?></span>
						</div>
						<?php endif; ?>
						<?php if( !empty($wydarzenie['tytul']) ) : ?>
						<span class="visible-sm visible-md visible-lg nazwa_wydarzenia-dbs">
							<?php echo $wydarzenie['tytul']; ?>
						</span>
						<?php endif; ?>
						<span class="playfair-display opis-wydarzenia-dbs">
							<?php
							if( !empty( $wydarzenie['opis_wysiwyg'] ) )
							{
								echo $wydarzenie['opis_wysiwyg'];
							}
							elseif( !empty( $wydarzenie['opis'] ) )
							{
								echo $wydarzenie['opis'];
							}	
							?>
						</span>
					</div>
				</div>
			</ul>
		</div>
	</div>
</section>
<script>
$(function()
{
	$( "#program" ).tabs();
});
</script>

<section id="wydarzenia__uczestnicy">
	<div class="wrap-dbs">
		<h3 class="wydarzenia__title"><?php _e( 'uczestnicy', 'biblioteka' ); ?></h3>
		<div id="uczesnicy">
			<div>
				<ul class="osoby">
					<?php
					/** UCZESTNICY WYDARZENIA **/
					if( !empty($wydarzenie['uczestnicy']) ) :
					foreach ( $wydarzenie['uczestnicy'] as $uczestnik_wydarzenia )
					{
						$zdjecie_url = "//placeholdit.imgix.net/~text?txtsize=33&txt=300%C3%97300&w=300&h=300";
						$imie = $uczestnik_wydarzenia['imie'];
						$nazwisko = $uczestnik_wydarzenia['nazwisko'];
						$imie_span = '';
						$nazwisko_span = '';
						$separator = '';
						$plus = '';
						if ( $imie && $nazwisko )
						{
							$separator = '_';
							$plus = '+';
						}
						if ( $imie )
						{
							$imie_span .= '<span class="lato-font imie">'. $imie .'</span>';
						}
						if ( $nazwisko )
						{
							$nazwisko_span .= '<span class="lato-font nazwisko">'. $nazwisko .'</span>';
						}
						if ( !empty( $uczestnicy_wszyscy[$imie.$separator.$nazwisko] ))
						{
						?>	
						<li>
							<a class="single-uczestnik" href="?uczestnik=<?php echo urlencode( mb_strtolower($imie.$plus.$nazwisko,'UTF-8') ); ?>" title="zobacz więcej" target="_blank">
								<img src="<?php echo $uczestnicy_wszyscy[$imie.$separator.$nazwisko]['zdjecie']; ?>" width="300" height="300" />
								<?php echo $imie_span; ?><?php echo $nazwisko_span; ?>
							</a>
						</li>	
						<?php
						}
						else
						{
						?>
						<li>
							<p class="single-uczestnik">
								<img src="<?php echo $zdjecie_url; ?>" width="300" height="300" />
								<span class="lato-font imie"><?php echo $imie; ?></span>
								<?php echo $nazwisko_span; ?>
							</p>
						</li>	
						<?php
						}
					}
					endif;
					
					/** PROWADZĄCY WYDARZENIA **/
					if( !empty($wydarzenie['prowadzacy']) ) :
					foreach ( $wydarzenie['prowadzacy'] as $prowadzacy_wydarzenie )
					{
						$zdjecie_url = "//placeholdit.imgix.net/~text?txtsize=33&txt=300%C3%97300&w=300&h=300";
						$imie = $prowadzacy_wydarzenie['imie'];
						$nazwisko = $prowadzacy_wydarzenie['nazwisko'];
						$nazwisko_span = '';
						$separator = '';
						$plus = '';
						if ( $imie && $nazwisko )
						{
							$separator = '_';
							$plus = '+';
						}
						if ( $nazwisko )
						{
							$nazwisko_span .= '<span class="lato-font nazwisko">'. $nazwisko .'</span>';
						}
						if ( !empty( $uczestnicy_wszyscy[$imie.$separator.$nazwisko] ))
						{
						?>	
						<li>
							<a class="single-uczestnik" href="?uczestnik=<?php echo urlencode( mb_strtolower($imie.$plus.$nazwisko,'UTF-8') ); ?>" title="zobacz więcej" target="_blank">
								<img src="<?php echo $uczestnicy_wszyscy[$imie.$separator.$nazwisko]['zdjecie']; ?>" width="300" height="300" />
								<span class="lato-font imie"><?php echo $imie; ?></span>
								<?php echo $nazwisko_span; ?>
							</a>
						</li>	
						<?php
						}
						else
						{
						?>
						<li>
							<p class="single-uczestnik">
								<img src="<?php echo $zdjecie_url; ?>" width="300" height="300" />
								<span class="lato-font imie"><?php echo $imie; ?></span>
								<?php echo $nazwisko_span; ?>
							</p>
						</li>	
						<?php
						}
					}
					endif;
					?>
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(".osoby").carousel({
			show: {
				"740px" : 2,
				"980px" : 4
			},
			pagination: false
		});
	</script>
	<script>
		$(function() {
			$( "#uczesnicy" ).tabs();
		});
	</script>
</section>

<?php /** MODUŁ PREMIERY **/
    get_template_part( 'template-parts/partials/single_wydarzenia/module', 'premiery' );
?>
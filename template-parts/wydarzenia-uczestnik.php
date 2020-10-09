<style type="text/css">
.uczestnik {
	margin-top: 30px;
}
.uczestnik .name {
	text-align: center;
    text-transform: capitalize;
    color: #000;
	letter-spacing: normal;
    font-size: 30px;
    font-weight: 400;
}
.uczestnik .zdjecie {
	height: 540px;
    background-repeat: no-repeat;
    background-position: center 25%;
    background-size: cover;
	margin-bottom: 50px;
}
.uczestnik .linki a {
	display: block;
    font-size: 17px;
    color: #a7a7a7;
    margin-bottom: 10px;
    text-decoration: none;
    text-transform: uppercase;
}
.uczestnik .linki a i {
	margin-right: 15px;
}
.uczestnik .biogram p {
    line-height: 33px;
}
</style>
<?php
$name = explode("+", $_GET['uczestnik']);
$uczestnik = array();
if( have_rows('uczestnicy') )
{
	while ( have_rows('uczestnicy') )
	{ the_row();
		if( have_rows('uczestnik_repeater') )
		{
			while ( have_rows('uczestnik_repeater') )
			{ the_row();
				$baner = get_sub_field('baner');
				$zdjecie = get_sub_field('zdjecie');
				$zdjecie_url = "//placeholdit.imgix.net/~text?txtsize=33&txt=1171%C3%97400&w=1171&h=400";
				$imie = get_sub_field('imie');
				$nazwisko = get_sub_field('nazwisko');
				$display = get_sub_field('hide_title');
				$nazwisko_url = '';
				$biogram = get_sub_field('biogram');
				$strona = get_sub_field('strona');
				$books = get_sub_field('books');
				$teksty = get_sub_field('teksty');
				if ($nazwisko)
				{
					$nazwisko_url = '+'.$nazwisko;
				}
				if( $baner )
				{
					$zdjecie_url = $baner['sizes']['bl_wydarzenia'];
				}
				$current_url = $_GET['uczestnik'];
				$match_url = mb_strtolower($imie.$nazwisko_url,'UTF-8');
				if ( $current_url === $match_url )
				{
					$uczestnik['baner'] = $baner;
					$uczestnik['zdjecie'] = $zdjecie_url;
					$uczestnik['imie'] = $imie;
					$uczestnik['nazwisko'] = $nazwisko;
					$uczestnik['display'] = $display;
					$uczestnik['biogram'] = $biogram;
					$uczestnik['linki'] = array();
					if ( $strona )
					{
						$uczestnik['linki']['strona'] = $strona;
					}
					if ( $books )
					{
						$uczestnik['linki']['ksiazki'] = $books;
					}
					if ( $teksty )
					{
						$uczestnik['linki']['teksty'] = $teksty;
					}
				}
			}
		}
	}
}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="uczestnik" class="uczestnik">
			<div class="row wrap-dbs no-padding no-margin-side">
				<?php if( $uczestnik['display'] === false ): ?>
				<div class="col-md-12 no-padding">
					<h3 class="lato-font name">
						<?php echo $uczestnik['imie'].' '.$uczestnik['nazwisko']; ?>
					</h3>
				</div>
				<?php endif; ?>
				<div class="col-md-12 no-padding">
					<div class="zdjecie" style="background-image:url(<?php echo $uczestnik['zdjecie']; ?>);"></div>
				</div>
				<div class="col-md-4 no-padding linki lato-font">
					<?php if ( !empty( $uczestnik['linki'] ) ) : ?>
						<?php if ( !empty( $uczestnik['linki']['strona'] ) ) : ?>
							<a href="<?php echo $uczestnik['linki']['strona']; ?>" target="_blank" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
							<i class="fa fa-user" aria-hidden="true"></i>
								<?php _e( 'strona autora', 'biblioteka' ); ?>
							</a>
						<?php endif;?>
						<?php if ( !empty( $uczestnik['linki']['ksiazki'] ) ) : ?>
							<a href="<?php echo $uczestnik['linki']['ksiazki']; ?>" target="_blank" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
							<i class="fa fa-book" aria-hidden="true"></i>
								<?php _e( 'książki autora', 'biblioteka' ); ?>
							</a>
						<?php endif;?>
						<?php if ( !empty( $uczestnik['linki']['teksty'] ) ) : ?>
							<a href="<?php echo $uczestnik['linki']['teksty']; ?>" target="_blank" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								<?php _e( 'teksty autora', 'biblioteka' ); ?>
							</a>
						<?php endif;?>
					<?php else : ?>
					<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><i class="fa fa-globe" aria-hidden="true"></i>
						<?php _e( the_title(), 'biblioteka' ); ?>
					</a>
					<?php endif;?>
				</div>
				<div class="col-md-8 no-padding playfair-display biogram">
					<?php echo $uczestnik['biogram']; ?>
				</div>
			</div>	
		</section>		
	</main><!-- #main -->
</div><!-- #primary -->
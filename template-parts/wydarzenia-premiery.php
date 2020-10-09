<?php
$premiery = array();

if( have_rows('dzien') )
{
	while ( have_rows('dzien') )
	{
		the_row();
		if( have_rows('wydarzenie') )
		{
			while ( have_rows('wydarzenie') )
			{
				the_row();
				if (get_sub_field('premiery'))
				{
					foreach ( get_sub_field('premiery') as $b )
					{
						$seria = get_field('seria', $b);
						$premiery[$seria][$b] = $b;
					}
					
					
				}			
			}
		}
	} 
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

<?php if( !empty($premiery) ) : ?>
<style>
@media (min-width: 992px) {
	.wydarzenia__premiery-single .ksiazki-premiery .col-md-6 {
		width: 48%;
	}
}
.wydarzenia__premiery-single .navtab {
	margin-bottom: 40px;
	text-align: center;
}
.wydarzenia__premiery-single .navtab li {
	display: inline-block;
    margin-right: 30px;
    text-align: center;
}
.wydarzenia__premiery-single .navtab .ui-state-active a {
	font-weight:bold;
}
.wydarzenia__premiery-single .navtab .red-slash {
	color: #d01117;
} 
.wydarzenia__premiery-single .navtab li a {
	font-size: 14px;
	font-weight: normal;
    color: #000000;
    text-transform: uppercase;
}
.wydarzenia__premiery-single .ksiazki-premiery li {
	margin-top: 25px;
	margin-right: 1%;
    margin-left: 1%;
    padding: 0;
	-webkit-box-shadow: 0px 0px 10px 3px rgba(235,235,235,0.7);
    -moz-box-shadow: 0px 0px 10px 3px rgba(235,235,235,0.7);
    box-shadow: 0px 0px 10px 3px rgba(235,235,235,0.7);
}
.wydarzenia__premiery-single .book-cover {
	height: 384px;
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
}
.wydarzenia__premiery-single .book-info {
	padding-top: 45px;
	height: 384px;
}
.wydarzenia__premiery-single .book-info .tytul {
	padding-top: 10px;
}
.wydarzenia__premiery-single .data-kategoria {
    font-weight: 600;
    color: #fff;
    font-size: 14px;
    display: block;
    padding-top: 70px;
    text-align: center;
}
.wydarzenia__premiery-single .data-kategoria .book-data {
	background-color: #000;
    padding: 5px;
    width: 90px;
    display: inline-block;
}
.wydarzenia__premiery-single .data-kategoria .book-cat {
	background-color: #d01117;
    padding: 5px;
    text-transform: uppercase;
    margin-left: 2px;
    width: 90px;
    display: inline-block;
}
.wydarzenia__premiery-single .book-info a {
	position: absolute;
    bottom: 40px;
    width: 100%;
    font-size: 15px;
    text-align: center;
    text-transform: uppercase;
    text-decoration: none;
    color: #696969;
}
.wydarzenia__premiery-single .book-info a span {
	border: 1px solid;
    padding: 5px 10px;
    color: #696969;
}
.wydarzenia__premiery-single .book-info a:hover span {
	border: 1px solid #d01117;
    background-color: #d01117;
    color: white;
}
    
</style>
<section id="wydarzenia__premiery" class="wydarzenia__premiery-single" style="margin-top: 60px;">
	<div class="wrap-dbs">
		<h3 class="wydarzenia__title"><?php _e( 'premiery', 'biblioteka' ); ?></h3>
		<div id="premiery">
			<ul class="navtab">
				<?php 
				foreach ( $premiery as $s => $p ) :
				?>
				<li class="lato-font">
					<a href="#<?php echo urlencode( mb_strtolower($s,'UTF-8') ); ?>">
					<span class="red-slash">/</span> <?php echo $s; ?>
					</a>
				</li>
				<?php		
				endforeach; //array_unique($wydarzenie['premiery']['seria']) as $s
				?>
			</ul>
			
			<?php foreach ( $premiery as $s => $p ) : ?>
			<div id="<?php echo urlencode( mb_strtolower($s,'UTF-8') ); ?>">
				<ul class="ksiazki-premiery">
					<?php
					/** PREMIERY WYDARZENIA **/
					foreach ( $p as $b )
					{
						$ksiazka_info = get_post( $b );
						$link = get_permalink( $b );
						$tytul = $ksiazka_info->post_title;
						$date = DateTime::createFromFormat('Y-m-j', get_field('data', $b));
						$autor = get_field('imie', $b);
						$autor .= ' ';
						$autor .= mb_strtoupper(get_field('nazwisko', $b), 'UTF-8');
						$seria = get_field('seria', $b);
						$image_id = get_post_thumbnail_id( $b);  
						$image_url = wp_get_attachment_image_src($image_id,'bl_ksiazka_okladka');  
						$image_url = $image_url[0];				
						?>
						<li class="col-md-6 single-ksiazka">
							<div class="col-md-6 book-cover" style="background-image:url(<?php echo $image_url; ?>);">
							</div>
							<div class="col-md-6 book-info">
								<?php if ( get_field('imie', $b) ) : ?>
								<div class="playfair-display autor"><?php echo $autor; ?></div>
								<?php endif; ?>
								<div class="playfair-display tytul"><?php echo $tytul; ?></div>
								
								<div class="lato-font data-kategoria">
									<?php if ( get_field('data', $b) ) : ?>
									<span class="book-data"><?php echo $date->format('d/m/Y'); ?></span>
									<?php endif; ?>
									<span class="book-cat"><?php echo $seria; ?></span>
								</div>
								
								<a class="lato-font" href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
									<span class="transition-300-ease"><?php _e( 'więcej', 'biblioteka' ); ?></span>
								</a>
							</div>
						</li>
						<?php
					} ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<script>
		$(function() {
			$( "#premiery" ).tabs();
		});
	</script>
</section>
<?php endif; ?>
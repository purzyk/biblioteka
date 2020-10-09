<?php /** MULTIMEDIA **/
$logotypy = array(); // ACTIVE
$plakaty = array(); // ACTIVE
$rysunki = array();
$tapety = array(); // ACTIVE
$katalogi_festiwalowe = array();
$spoty = array();
$reklamy_prasowe = array();
$banery_reklamowe = array();

$download_button = $image_url = get_template_directory_uri().'/img/download-button.png';

$multimedia = 'multimedia';
if( have_rows( $multimedia ) )
{
	while ( have_rows( $multimedia ) )
	{
		the_row();
		$multimedia_single = 'dodaj';
		if( have_rows( $multimedia_single) )
		{
			while ( have_rows( $multimedia_single ) )
			{
				the_row();
				$typ = get_sub_field('typ'); 
				$plik = get_sub_field('plik');
				switch ($typ)
				{
					case "logotypy":
						$logotypy[] = $plik;
					break;
					case "plakaty":
						$plakaty[] = $plik;
					break;
					case "rysunki":
						$rysunki[] = $plik;
					break;
					case "tapety":
						$tapety[] = $plik;
					break;
					case "katalogi festiwalowe":
						$katalogi_festiwalowe[] = $plik;
					break;
					case "spoty":
						$spoty[] = $plik;
					break;
					case "reklamy prasowe":
						$reklamy_prasowe[] = $plik;
					break;
					case "banery reklamowe":
						$banery_reklamowe[] = $plik;
					break;
				}					
			}					
		}					
	}
}


if( have_rows( $multimedia ) ) : ?>
<style type="text/css">
.multimedia{
	margin-top: 20px;
	text-align: justify;
}
/* item styles */
.item-image {
	position: relative;
	overflow: hidden;
}
.item-image-plakaty {
	height: 300px;
}
.item-image-logotypy {
	padding-bottom: 50%;
}
.item-image-tapety {
	height: 158px;
}
.item-image img {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.item-content {
  padding: 15px;
}
.item-text {
	position: relative;
	overflow: hidden;
	/*height: 33px;*/
	text-align: center;
	text-transform: uppercase;
}
.item-text p {
	padding: 5px 0;
	text-transform: lowercase;
}
.item-text a {
	vertical-align: top;
	color: black;
	letter-spacing: 1px;
    font-size: 22px;
}
    
.item-text a::before{
	content: "";
	background-image:url(<?php echo $download_button; ?>);
	height: 30px;
    width: 37px;
    display: inline-block;
    background-repeat: no-repeat;
    background-size: contain;
}
.single-multimedia-dbs {
	margin-bottom: 50px;
}
.single-multimedia-dbs h4 {
	text-transform: uppercase;
    padding: 20px 0 40px;
    border-top: 1px solid #444;
    margin: 0 15px;
    font-weight: 600;
}
.single-multimedia-dbs .border-radius {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #cacaca;
}
/*
@media (min-width: 1200px) {
  .rysunki .col-md-3:nth-child(4n+1) {
    clear: left;
  }
}
*/
</style>
<div id="multimedia" class="container multimedia lato-font">

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h3 class="wydarzenia__title"><?php _e( 'multimedia', 'biblioteka' ); ?></h3>
		</div>
	</div>

	<?php /** PLAKATY **/
	if ( ! empty($plakaty) ) : ?>
	<div class="row plakaty single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'plakaty', 'biblioteka' ); ?></h4>
			
			<?php foreach ($plakaty as $plakat) : ?>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="item-image item-image-plakaty">
						<img src="<?php echo $plakat['sizes']['medium']; ?>" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<?php /** <p>(<?php echo $plakat['width']; ?>x<?php echo $plakat['height']; ?>)</p> **/ ?>
							<a href="<?php echo $plakat['url']; ?>" download="<?php echo $plakat['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** PLAKATY **/ endif; ?>
   
    <?php /** RYSUNKI **/
	if ( ! empty($rysunki) ) : ?>
	<div class="row rysunki single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'rysunki', 'biblioteka' ); ?></h4>
			
			<?php $i = 0; foreach ($rysunki as $item) : ++$i; ?>
				<div class="<?php echo $i; ?> col-xs-12 col-sm-3 col-md-3">
					<div>
						<img src="<?php echo $item['sizes']['medium']; ?>" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<?php /** <p>(<?php echo $plakat['width']; ?>x<?php echo $plakat['height']; ?>)</p> **/ ?>
							<a href="<?php echo $item['url']; ?>" download="<?php echo $item['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
				<?php if ( $i%4 == 0 ) echo '<div class="clearfix visible-lg"></div>'; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** RYSUNKI **/ endif; ?>
    
    <?php /** REKLAMY PRASOWE **/
	if ( ! empty($reklamy_prasowe) ) : ?>
	<div class="row plakaty single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'reklamy prasowe', 'biblioteka' ); ?></h4>
			
			<?php foreach ($reklamy_prasowe as $reklama) : ?>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="item-image item-image-plakaty">
						<img src="<?php echo $reklama['sizes']['medium']; ?>" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<?php /** <p>(<?php echo $plakat['width']; ?>x<?php echo $plakat['height']; ?>)</p> **/ ?>
							<a href="<?php echo $reklama['url']; ?>" download="<?php echo $reklama['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** REKLAMY PRASOWE **/ endif; ?>
	
	<?php /** LOGOTYPY **/
	if ( ! empty($logotypy) ) : ?>
	<div class="row logotypy single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'logotypy', 'biblioteka' ); ?></h4>
			
			<?php foreach ($logotypy as $logotyp) : ?>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="item-image item-image-logotypy border-radius">
						<img src="<?php echo $logotyp['sizes']['medium']; ?>" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<a href="<?php echo $logotyp['url']; ?>" download="<?php echo $logotyp['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** LOGOTYPY **/ endif; ?>
	
	<?php /** TAPETY **/
	if ( ! empty($tapety) ) : ?>
	<div class="row tapety single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'tapety', 'biblioteka' ); ?></h4>
			
			<?php foreach ($tapety as $tapeta) : ?>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="item-image item-image-tapety">
						<img src="<?php echo $tapeta['sizes']['medium']; ?>" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<a href="<?php echo $tapeta['url']; ?>" title="<?php echo $tapeta['filename']; ?>" download="<?php echo $tapeta['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** TAPETY **/ endif; ?>
	
	<?php /** KATALOGI FESTIWALOWE **/
	if ( ! empty($katalogi_festiwalowe) ) : ?>
	<div class="row tapety single-multimedia-dbs">
		<div class="col-md-10 col-md-offset-1">
			<h4><?php _e( 'katalogi festiwalowe', 'biblioteka' ); ?></h4>
			
			<?php foreach ($katalogi_festiwalowe as $katalog) : ?>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="item-image item-image-tapety">
						<img src="https://placeholdit.imgix.net/~text?txtsize=41&txt=PDF&w=300&h=188" class="img-responsive">
					</div>
					<div class="item-content">
						<div class="item-text tungsten-semibold">
							<a href="<?php echo $katalog['url']; ?>" title="<?php echo $katalog['filename']; ?>" download="<?php echo $katalog['filename']; ?>"><?php _e( 'pobierz', 'biblioteka' ); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php /** KATALOGI FESTIWALOWE **/ endif; ?>
	
</div>
<?php endif; 
/** MULTIMEDIA **/ ?>
<?php
$premiery = false;

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
					$premiery = true;
				}			
			}
		}
	} 
}
?>
<style type="text/css">
#wydarzenia__program {
	margin-top: 0 !important;
}
#bilety-na-koncerty {
	background-color: #ededed;
}
#bilety-na-koncerty p {
	color: #444;
}
h2.niezbednik__title {
	color: #444;
	border: 0 none;
    text-align: left;
    padding: 40px 0px;
    font-weight: 900;
    font-size: 2.5em;
}
h2.niezbednik__title::after {
	content: '';
    border: 5px solid;
    display: block;
    width: 6.32%;
    margin-top: 5px;
}
h3.niezbednik__title {
    word-spacing: 9999999px;
    text-align: left;
    font-weight: 800;
    color: <?php the_field('event_color'); ?>;
    text-transform: lowercase;
    font-size: 2em;
    line-height: 1.2;
	margin: 0;	
}
.single-event-dbs h4 {
	color: #444;
	text-transform: uppercase;
    text-align: right;
    font-weight: 600;
    padding-left: 35%;
}
.single-event-dbs i {
	display: block;
    font-size: 3.3em;
    color: <?php the_field('event_color'); ?>;
}
.single-event-dbs i::after {
	content: '';
    border: 5px solid;
    display: block;
    width: 37.7px;
    margin-top: 15px;
}
.see-map-dbs {
    display: block;
    font-family: "Lato", "Arial", sans-serif;
    text-transform: lowercase;
    color: #444;
    font-weight: 900;
    margin-top: 25px;
    font-size: 1em;	
}
.see-map-dbs:visited {
	color: #444;
}
.go-to-adress,
.go-to-adress:visited {
	color: <?php the_field('event_color'); ?>;
}
.go-to-adress:hover {
	color:#444;
	text-decoration:none;
}
@media (min-width: 768px ) {
  .row {
      position: relative;
  }

  .bottom-align-text {
    position: absolute;
    bottom: 0;
    right: 0;
  }
}
</style>
<?php if ( $premiery == TRUE ) : ?>
<div class="navigation-btns lato-font">
	<div class="right">
		<a href="<?php echo get_permalink(); ?>?premiery">
		<span><?php _e( 'premiery', 'biblioteka' ); ?></span></a>
	</div>
</div>
<?php endif; ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="wydarzenia__program">
			<div class="container-fluid">
				<div id="niezbednik">
					<div class="row">
						<?php
                        if(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'transport')
						{
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_transport.php';
						}
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'miejsca')
						{
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_miejsca.php';
						}
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'noclegi')
						{
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_noclegi.php';
						}
						elseif(isset($_GET["sekcja"]) && trim($_GET["sekcja"]) == 'bilety')
						{
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_bilety.php';
						}
						else
						{
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_miejsca.php';
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_noclegi.php';
							require get_template_directory() . '/template-parts/wydarzenia-niezbednik_bilety.php';
						}
						?>						
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
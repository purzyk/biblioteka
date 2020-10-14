		<div class="logo">
			<a href="https://www.biuroliterackie.pl/biblioteka"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_2.png'?>"></a>
		</div>
		<div class="szukaj right">
		<span class="data"><strong><?php the_field('numer', 145767); ?></strong>/<?php the_field('rok', 145767); ?></span><!--<span class="od">W sieci od 1998 r.</span>-->
		<?php /*	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" placeholder="Archiwum" />
			<input type="submit" id="searchsubmit" value="Search" class="btn" />
			</div>
			</form> */ ?>
		</div>
		<div class="header__new__middle --mobile">
		<div class="header__new__middle__archiwum">
			<p>Archiwum numerów</p>
			<div id="archiwum2">
				<?php

// Check rows exists.
if( have_rows('archiwum', 'option') ):
	$i = 0;
?>
				<ul>
					<?php
    // Loop through rows.
	while( have_rows('archiwum', 'option') ) : the_row();
	$i++;
?>
					<li><a href="#tabs-<?php echo $i; ?>"><?php the_sub_field('rok', 'option'); ?></a></li>
					<?php       
    
    endwhile;
?>
				</ul>
				<?php
// No value.
else :
    // Do something...
endif;
?>

				<?php

// Check rows exists.
if( have_rows('archiwum', 'option') ):
	$i = 0;
?>

				<?php
    // Loop through rows.
	while( have_rows('archiwum', 'option') ) : the_row();
	$i++;
?>
				<div id="tabs-<?php echo $i; ?>">
					<?php

// Check rows exists.
if( have_rows('numery', 'option') ):

    // Loop through rows.
	while( have_rows('numery', 'option') ) : the_row();
	?>
					<a href="<?php the_sub_field('link', 'option'); ?>"><?php the_sub_field('numer', 'option'); ?></a>
					<?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>


				</div>

				<?php       
    
    endwhile;
?>

				<?php
// No value.
else :
    // Do something...
endif;
?>



			</div>
		</div>
		<div class="header__new__middle__search">
			<p>Szukaj</p>
			<form method="get" id="searchform_sidebar" action="<?php bloginfo('home'); ?>/">
				<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
					<input type="submit" id="searchsubmit_sidebar" value="Search" class="btn" />
				</div>
			</form>
		</div>
	</div>
		<div class="main-links">
			
	<?php wp_nav_menu( array('menu' => 'menu-links-left', 'container'=>'','items_wrap' => '%3$s' )); ?>
	<?php wp_nav_menu( array('menu' => 'menu-links-right', 'container'=>'','items_wrap' => '%3$s' )); ?>
	<li id="menu-item-144956" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-144956"><a
			href="#">leksykon</a></li>
		</div>
		
		<script>
	$(function () {
		$("#archiwum2").tabs();
	});
</script>
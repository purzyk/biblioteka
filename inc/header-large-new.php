<div class="header__new">
	<div class="header__new__top">
		<div class="logo">
			<a href="https://www.biuroliterackie.pl/biblioteka"><img
					src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_4.png'?>"></a>
		</div>
		<div class="w-sieci-od">
			<div class="line"><span class="data"><span class="nr">nr</span><span
						class="numer"><?php the_field('numer'); ?></span><span
						class="rok"><?php the_field('rok'); ?></span></div>
		</div>

	</div>
	<div class="header__new__middle">
		<div class="header__new__middle__archiwum">
		
			<p>Archiwum numerów</p>
			<div id="archiwum">
				<?php

// Check rows exists.
if( have_rows('archiwum', 'option') ):
	$i = 0;
?>
				<ul class="yearTop">
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
	$current_object_id = get_queried_object_id();
?>
				<div id="tabs-<?php echo $i; ?>">
					<?php

// Check rows exists.
if( have_rows('numery', 'option') ):

    // Loop through rows.
	while( have_rows('numery', 'option') ) : the_row();
	$post_link = get_sub_field('link', 'option');
	$permalink = get_permalink( $post_link );
	?>
					<a class="<?php if ($current_object_id == $post_link) echo "active";?>" href="<?php echo  $permalink; ?>"><?php the_sub_field('numer', 'option'); ?></a>
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
	<div class="header__new__bottom">


		<?php wp_nav_menu( array('menu' => 'menu-links-left', 'container'=>'','items_wrap' => '%3$s' )); ?>
		<?php wp_nav_menu( array('menu' => 'menu-links-right', 'container'=>'','items_wrap' => '%3$s' )); ?>

	</div>



</div>
<script>
	$(function () {
		$("#archiwum").tabs();
	});
</script>
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
		<div class="main-links">
			<?php wp_nav_menu( array('menu' => 'menu-links' )); ?>
		</div>
		
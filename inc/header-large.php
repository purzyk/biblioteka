		<div class="main-links left">
			<?php wp_nav_menu( array('menu' => 'menu-links-left' )); ?>
		</div>
		<div class="logo">
			<a href="https://www.biuroliterackie.pl/biblioteka"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_4.png'?>"></a>
		</div>
		<div class="main-links right">
			<?php wp_nav_menu( array('menu' => 'menu-links-right' )); ?>
		</div>
		<div class="w-sieci-od">
		<div class="line"><span class="data"><span class="nr">nr</span><span class="numer"><?php the_field('numer', 145767); ?></span><span class="rok"><?php the_field('rok', 145767); ?></span></div>
		</div>
		<div class="szukaj right">
		<?php /*
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" placeholder="Archiwum" />
			<input type="submit" id="searchsubmit" value="Search" class="btn" />
			</div>
			</form>
			*/?>
		</div>
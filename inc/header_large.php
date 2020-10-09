		<div class="main-links left">
			<?php wp_nav_menu( array('menu' => 'menu-links-left' )); ?>
		</div>
		<div class="logo">
			<a href="#"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka.png'?>"></a>
		</div>
		<div class="main-links right">
			<?php wp_nav_menu( array('menu' => 'menu-links-right' )); ?>
		</div>
		<div class="w-sieci-od">
			<span class="data">01/2016</span><span class="od">W sieci od 1998 r.</span>
		</div>
		<div class="szukaj right">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" placeholder="Archiwum" />
			<input type="submit" id="searchsubmit" value="Search" class="btn" />
			</div>
			</form>
		</div>
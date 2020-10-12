<div class="header__new">
<div class="header__new__top">
<div class="logo">
			<a href="https://www.biuroliterackie.pl/biblioteka"><img src="<?php echo  get_template_directory_uri().'/img/logo_biblioteka_4.png'?>"></a>
		</div>
		<div class="w-sieci-od">
		<div class="line"><span class="data"><span class="nr">nr</span><span class="numer"><?php the_field('numer'); ?></span><span class="rok"><?php the_field('rok'); ?></span></div>
		</div>

</div>
<div class="header__new__bottom">


			<?php wp_nav_menu( array('menu' => 'menu-links-left', 'container'=>'','items_wrap' => '%3$s' )); ?>
			<?php wp_nav_menu( array('menu' => 'menu-links-right', 'container'=>'','items_wrap' => '%3$s' )); ?>
			<li id="menu-item-144956" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-144956"><a href="#">leksykon</a></li>
		</div>

		
			
		

</div>
<div class="row"><div class="col-xs-12"><div class="flexsearch lato-font"><div class="flexsearch--wrapper"><form class="flexsearch--form" role="search" method="get" action="https://biuro.develop.name/"><div class="flexsearch--input-wrapper"><input class="flexsearch--input" type="search" placeholder="SZUKAJ" value="" name="s"></div><input type="hidden" name="post_type" value="ksiazki_lista"><input class="flexsearch--submit" type="submit" value=">"></form></div></div></div></div>



	<div class="archiwum__bl">
    <label for="cars">ARCHIWUM</label>

<select name="cars" id="cars">
  <option value="volvo">12 2020</option>
  <option value="saab">11 2020</option>
  <option value="mercedes">10 2020</option>
  <option value="audi">09 2020</option>
</select>
</div>
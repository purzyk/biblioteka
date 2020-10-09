<div class="autor__menu-links">
	<h1 class="playfair-display"><span><?php the_title(); ?></span></h1>
	<ul class="lato-font">
		<li><button onclick="window.location.href='<?php echo esc_url( add_query_arg( 'page', 'bibliografia' ) ) ?>'">bibliografia</button></li>
		<li><button onclick="window.location.href='<?php echo esc_url( add_query_arg( 'page', 'wiadomosci' ) ) ?>'">wiadomości</button></li>
		<li><button onclick="window.location.href='<?php echo esc_url( add_query_arg( 'page', 'biblioteka' ) ) ?>'">biblioteka</button></li>
		<li><button onclick="window.location.href='<?php echo esc_url( add_query_arg( 'page', 'wydarzenia' ) ) ?>'">wydarzenia</button></li>
		<li><button onclick="window.location.href='<?php echo esc_url( add_query_arg( 'page', 'kontakt' ) ) ?>'">kontakt</button></li>
	</ul>
</div>

<?php while ( have_posts() ) : the_post(); ?>
	<?php
	$slider_height = '45vw';
	$bg_img_id = get_post_thumbnail_id($post->ID);
	$bg_img_url = wp_get_attachment_image_src($bg_img_id,'full');
	if (empty($_GET))
	{
		$slider_height = '100vh';
		$bg_img_url = wp_get_attachment_image_src($bg_img_id,'full');
	}
	$bg_img_url = $bg_img_url[0];

	if (get_field('duze_zdjecie_na_tlo'))
	{
		$bg_img_url = get_field('duze_zdjecie_na_tlo');
	}
	?>

	<section class="autorzy__master_slider" style="height:<?php echo $slider_height; ?>">
		<img src="<?php echo $bg_img_url; ?>" alt="<?php the_title(); ?>">
	</section>

	<?php
	// PODSTRONY
	if ( !empty($_GET["page"]) )
	{
		get_template_part( 'template-parts/partials/autorzy_lista/al', 'module_top' );

		// BIBLIOGRAFIA
		if( isset($_GET["page"]) && trim($_GET["page"]) == 'bibliografia' )
		{
			get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_bibliografia' );
		}
		// WIADOMOŚCI
		elseif( isset($_GET["page"]) && trim($_GET["page"]) == 'wiadomosci' )
		{
			get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_wiadomosci' );
		}
        // BIBLIOTEKA
		elseif( isset($_GET["page"]) && trim($_GET["page"]) == 'biblioteka' )
		{
			get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_biblioteka' );
		}
        // WYDARZENIA
		elseif( isset($_GET["page"]) && trim($_GET["page"]) == 'wydarzenia' )
		{
			get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_wydarzenia' );
		}
        // KONTAKT
		elseif( isset($_GET["page"]) && trim($_GET["page"]) == 'kontakt' )
		{
			get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_kontakt' );
		}

		get_template_part( 'template-parts/partials/autorzy_lista/al', 'module_bottom' );
	}
    else
    {
        get_template_part( 'template-parts/partials/autorzy_lista/al', 'page_home' );
    }
	?>
<script type="text/javascript">
    $(function() {
        $(window).scroll(function() {
            console.log('scrolling ', $(window).scrollTop(), $(document).height());
            if($(window).scrollTop() >= 500 && $(window).scrollTop() <= ($(document).height() - 500)) {
                $('.navigation-btns').removeClass('hide');
            } else {
                $('.navigation-btns').addClass('hide');
            }
        });
    });
</script>

<?php endwhile; ?>

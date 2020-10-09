<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package biblioteka
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="inner">
		<section class="footer_menu">
		<?php wp_nav_menu( array('menu' =>'footer-links' )); ?>
		</section>
		<section class="newsletter">
		<div class="logo_foteer">
<a href="http://biuroliterackie.pl/"><img src="<?php echo  get_template_directory_uri().'/img/logo_stopka.png'?>"></a>
		</div>
		<div class="dane_kontaktowe">
<p>
<strong>Adres:</strong> Solna 1, 78-100 Kołobrzeg
<br><a href="mailto:poczta@biuroliterackie.pl" target="_blank">poczta@biuroliterackie.pl</a><br>

<p><span>NIP:</span> 881-110-93-38 / <span>Regon</span> 390738090<br>
<span>Konto bankowe:</span> ING Bank Śląski <br><br>
71 1050 1575 1000 0022 7732 9062</p></div><?php echo do_shortcode('[contact-form-7 id="142406" title="newsletter"]'); ?>

		</section>
		<section class="copyright">
			<a href="//www.biuroliterackie.pl/copyright/">Copyright © <?php echo date("Y"); ?> by Biuro Literackie</a>
		</section>

	</div>
	
	<?php /*
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'biblioteka' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'biblioteka' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'biblioteka' ), 'biblioteka', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
		*/ ?>
	</footer><!-- #colophon -->
	</div>
	</div><!-- .transformer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
if(is_archive()) {} elseif ( is_page() ) { } else  { ?>


<?php
if ( is_home() ) {
    // This is the blog posts index
   ?>
<section class="master_slider">
<div class="master_slider_slider">
<?php

// The Query
$the_query = new WP_Query( array(
'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
'posts_per_page' => '3') );

// The Loop
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
$the_query->the_post();
?>

<div class="slide">
sssddddddd
			</div>
<?php

	}

} 

/* Restore original Post Data */
wp_reset_postdata();
?>
</div>
</section>



		<?php
} else {
    // This is not the blog posts index
     ?>
     		<section class="master_slider">
			<div class="slide">
			sssddddddd
				<?php if ( is_single() ) { ?>
											<?php get_template_part( 'template-parts/img', 'xl_large' ); ?>
<?php 									} else { ?>
											<img src="http://testowy.biz/bl/wp-content/uploads/2015/11/01-1600x891.jpg">
									<?php }
?>

			</div>
		</section>
		<?php
}
?>
		<?php };
    // write your code here
?>

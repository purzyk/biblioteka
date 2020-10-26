<?php
/**
 * Template Name:Kartoteka
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package biblioteka
 */

get_header(); ?>
<div class="right_bck">

</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="archive_left">
			<div class="sidebar">
				<?php get_template_part( 'template-parts/sidebar', 'archive' ); ?>

			</div>
		</section>

		<section class="archive_right">


			<section class="top_articles">
				<?php get_template_part( 'template-parts/loop', 'archwiumtop' ); ?>
				<script type="text/javascript">
					$(".archwiumtop_carousell").carousel({
						show: {
							"740px": 3,
							"980px": 3
						},
						pagination: false
					});
				</script>
			</section>


			<div class="archive_breadcrumbs">
				<div class="bread_outside">
					<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
						<!-- Breadcrumb NavXT 6.5.0 -->
						<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"
								title="Go to Biuro Literackie." href="https://www.biuroliterackie.pl" class="home"><span
									property="name">Biuro Literackie</span></a>
							<meta property="position" content="1"></span> / <span property="itemListElement"
							typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Indeks Autorów."
								href="https://www.biuroliterackie.pl/leksykon/indeks-autorow/"
								class="post post-utwory-archive"><span property="name">Indeks Autorów</span></a>
							<meta property="position" content="2"></span> / <span property="itemListElement"
							typeof="ListItem"><span property="name">Bohdan Zadura</span>
							<meta property="position" content="3"></span> </div>
				</div>
			</div>


			<div class="przystan_o_autorze">
				<?php
 $queried_object = get_queried_object();
 ?>
				<div class="o_autorze_big">
					<div class="o_autorze_left">
						<?php 
				$image = get_field('zdjecie', $queried_object);
$size = 'bl_autor'; // (thumbnail, medium, large, full or custom size)

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}
?>
						<?php
$term = get_queried_object();
 if( get_field('strona_autora', $term) ): ?>
						<a class="strona_autora" href="<?php echo the_field('strona_autora', $term);?>">Strona
							AUTORA</a>
						<?php endif; ?>
					</div>
					<div class="o_autorze_right">

						<?php 
	 $queried_object = get_queried_object();
	$term = get_queried_object();
?>
						<h6><?php echo the_field('imie', $queried_object);?>&nbsp;<span><?php echo the_field('nazwisko', $term);?></span>
						</h6>
						<p class="o_autorze_bio"><?php echo $term->description;?></p>

					</div>
				</div>
			</div>
			<div class="przystan_o_autorze">
				<div class="o_autorze_big">


					<div class="listCat" id="filterOptions">
						<?php get_template_part( 'template-parts/count', 'autor' ); ?>
					</div>

					<div class="teksty_autora">
						<div id="ourHolder">
							<?php 
$term = get_queried_object();
$termidd = $term ->term_id;
// arguments
$posts_order = 'DESC';
if ( ! empty( $_GET['posts_order'] ) ) {
  $posts_order_raw = sanitize_key( $_GET['posts_order'] );
  if ( 'ASC' === $posts_order_raw ) {
    $posts_order = 'ASC';
  }
}
$args = array(
'post_type' => array('wywiady','ksiazki','utwory','recenzje','debaty','felietony','dzwieki','nagrania','zdjecia','kartoteka_25'),
'post_status' => 'publish',
'posts_per_page' => -1, // you may edit this number
'orderby' => 'date',
/*'order' => $_GET['posts_order'],*/
'order' => 'DESC',
'tax_query' => array(
    array(
        'taxonomy' => 'autor',
        'field' => 'id',
        'terms' => $termidd
    )
),
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
while ( $related_items->have_posts() ) : $related_items->the_post();?>
							<div class="item zasob <?php echo get_post_type( get_the_ID() ); ?>">
							<div class="itemRow">
							<div>
<p class="itemRow__data"><?php the_time('d/m/Y');?></p>
</div>
<div>
 <?php 
 if ($post->post_type == "wywiady") {
$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/wywiady/">wywiady</a>';

}
if ($post->post_type == "ksiazki") {
	$term_list = wp_get_post_terms($post->ID, 'ksiazki-kategorie', array("fields" => "all"));
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/ksiazki/">książki</a>';
	
	}
 if ($post->post_type == "recenzje") {
$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/recenzje/">recenzje</a>';
}
 if ($post->post_type == "debaty") {
$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/debaty/">debaty</a>';

}
 if ($post->post_type == "felietony") {
$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/cykle/">cykle</a>';
}
 if ($post->post_type == "dzwieki") {
$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/dzwieki/">dźwięki</a>';
}
 if ($post->post_type == "nagrania") {
$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/nagrania/">nagrania</a>';
}
 if ($post->post_type == "zdjecia") {
$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/zdjecia/">zdjecia</a>';
}
 if ($post->post_type == "utwory") {
$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
		echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/utwory/">utwory</a>';
}
if ($post->post_type == "kartoteka_25") {
	$term_list = wp_get_post_terms($post->ID, 'kartoteka_25-kategorie', array("fields" => "all"));
			echo '<a class="itemRow__cat" href="https://www.biuroliterackie.pl/biblioteka/kartoteka_25/">kartoteka 25</a>';
	}
?>
</div>
<div class="itemRow__autorzy">
<?php 
$terms = get_the_terms( $post->ID , 'autor' );
if($terms) {
	foreach( $terms as $term ) { ?>
	<?php $term_link = get_term_link( $term ); ?>
		<a class="itemRow__autor" href="<?php echo $term_link; ?>"><span><?php echo the_field('imie', $term);?><span> <?php echo the_field('nazwisko', $term);?></span></span></a>
		<?php 
	}
	
} 
?>
</div>
</div>

<span class="itemRow__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
 </span>
 <div class="itemRow__excerpt">
 <?php
 the_excerpt();
 ?>
 </div>


		
							</div>
							<?php
endwhile;

endif;
// Reset Post Data
?>
							<?php
wp_reset_postdata();
?>
						</div>
					</div>






				</div>
			</div>







	</main><!-- #main -->
</div><!-- #primary -->

<script type="text/javascript">
	$(document).ready(function () {
		$('#filterOptions span a').click(function () {
			// fetch the class of the clicked item
			var ourClass = $(this).attr('class');

			// reset the active class on all the buttons
			$('#filterOptions span').removeClass('active');
			// update the active state on our clicked button
			$(this).parent().addClass('active');

			if (ourClass == 'all') {
				// show all our items
				$('#ourHolder').children('div.item').show();
			} else {
				// hide all elements that don't share ourClass
				$('#ourHolder').children('div:not(.' + ourClass + ')').hide();
				// show all elements that do share ourClass
				$('#ourHolder').children('div.' + ourClass).show();
			}
			return false;
		});
	});
</script>

<?php get_footer(); ?>
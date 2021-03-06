<section class="master_slider">
	<div class="master_slider_slider">
		<?php

		// The Query
		$current_year = date('Y');
		$current_month = date('m');
		$the_query = new WP_Query( array(
			'post_type' => array( 'utwory','debaty','nagrania','wywiady','recenzje','felietony','dzwieki'),
			'orderby'        => 'date',
			'order' => 'desc',
			'posts_per_page' => '25') );

			// The Loop
			if ( $the_query->have_posts() ) {

				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					?>

					<?php if (has_post_thumbnail( $post->ID ) ): ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'bl_xl_large' );
						$image = $image[0]; ?>
					<?php else :
						$image = 'https://www.biuroliterackie.pl/biblioteka/wp-content/uploads/2016/01/zaslepka-1541x725.jpg' ?>
					<?php endif; ?>
					<div class="slide">
						<figure><a href="<?php the_permalink();?>">
							<img src="<?php echo $image; ?>">

							<div class="wrapperr">
								<div class="wrapper_slide">
									<div class="info_o_poscie">
										<span class="cat">
											<?php
											if ($post->post_type == "wywiady") {
												$term_list = wp_get_post_terms($post->ID, 'wywiady-kategorie', array("fields" => "all"));
												echo 'wywiady';
											}
											if ($post->post_type == "recenzje") {
												$term_list = wp_get_post_terms($post->ID, 'recenzje-kategorie', array("fields" => "all"));
												echo 'recenzje';
											}
											if ($post->post_type == "debaty") {
												$term_list = wp_get_post_terms($post->ID, 'debaty-kategorie', array("fields" => "all"));
												echo 'debaty';
											}
											if ($post->post_type == "felietony") {
												$term_list = wp_get_post_terms($post->ID, 'felietony-kategorie', array("fields" => "all"));
												echo 'cykle';
											}
											if ($post->post_type == "dzwieki") {
												$term_list = wp_get_post_terms($post->ID, 'dzwieki-kategorie', array("fields" => "all"));
												echo 'dźwięki';
											}
											if ($post->post_type == "nagrania") {
												$term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array("fields" => "all"));
												echo 'nagrania';
											}
											if ($post->post_type == "zdjecia") {
												$term_list = wp_get_post_terms($post->ID, 'zdjecia-kategorie', array("fields" => "all"));
												echo 'zdjęcia';
											}
											if ($post->post_type == "utwory") {
												$term_list = wp_get_post_terms($post->ID, 'utwory-kategorie', array("fields" => "all"));
												echo 'utwory';
											}
											?>
										</span><br>
										<span class="title">
											<?php the_title();?>
										</span>
										<span class="auth">
											<?php
											$terms = get_the_terms( $post->ID , 'autor' );
											if($terms) {
												foreach( $terms as $term ) {?>
													<span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
													<?php
												}
											}?>
										</span>
									</div>
								</div>
							</a>
						</figure>
					</div>
					<?php
				}
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			?>
		</div>
	</section>

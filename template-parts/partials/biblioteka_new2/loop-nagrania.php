<?php
$featured_posts = get_field('nagrania');
if( $featured_posts ): ?>
    <div class="js-nagrania">

    <?php foreach( $featured_posts as $post ):
setup_postdata($post); 
            $term_list = wp_get_post_terms($post->ID, 'nagrania-kategorie', array( "fields" => "all" ));
            $terms = get_the_terms($post->ID, 'autor');
            ?>
            <div class="item">
                <article class="row custom-type-1 posRel">
                    <?php get_template_part( 'template-parts/img', 'large' ); ?>
                    <div class="reveal rec_nagr">
                        <div class="inner_black">
                            <div class="black_tran">
                                <div class="aaa">                                   
                                    <span class="category">
                                        <a class="cat_lin" href="<?php echo get_term_link($term_list[0]->term_id); ?>"><b><?php echo $term_list[0]->name; ?></b></a>
                                    </span>
                                    <h4><a class="post-url" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>

                                    <?php if($terms): foreach( $terms as $term ) : ?>
                                    <span class="imie"><?php echo the_field('imie', $term);?> <span class="nazwisko"><?php echo the_field('nazwisko', $term);?></span></span>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article> 
            </div>
        <?php  endforeach; ?>
        <?php wp_reset_postdata(); ?>

    </div>
   
<?php endif; ?>
<script>
$('.js-nagrania').slick({
    infinite: true,
    dots: false,
});
</script>
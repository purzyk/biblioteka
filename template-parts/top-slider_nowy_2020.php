<section class="biblioteka-top">
    <div class="row">

<?php if( have_rows('slider', 'option') ): ?>
    <div class="bl-slider">
    <?php while( have_rows('slider', 'option') ): the_row(); 
        ?>

        <div class="item">
                <article>
                    <a href="<?php the_sub_field('link', 'option'); ?>" target="_blank">
                    <?php 
                    $image = get_sub_field('zdjecie', 'option');
                    $size = 'bl_1645x600'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                        echo wp_get_attachment_image( $image, $size );
                    }
                    ?>
                    </a>
                </article>
                </div>
    <?php endwhile; ?>
    </div>
    
<?php endif; ?>


        </div>
        </section>

        <script>
$('.bl-slider').slick({
    infinite: true,
    dots: false,
});
</script>
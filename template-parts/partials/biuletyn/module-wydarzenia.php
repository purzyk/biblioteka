<?php
/*
* 
* OBECNE I NADCHODZĄCE WYDARZENIA
* 
* loop-biuletyn.php (archive)
* 
*/

$post_type = get_query_var( 'post_type' );
$wydarzenia_args = array(
  'post_type' => 'wydarzenia',
  'posts_per_page'=> 1
);

$wydarzenia_query = new WP_Query( $wydarzenia_args );

if ( $wydarzenia_query->have_posts() )
{
?>
<section id="<?php echo $post_type; ?>__wydarzenia" class="<?php echo $post_type; ?>_wydarzenia">

  <h2 class="<?php echo $post_type; ?>__module-subtitle"><span>FESTIWAL</span></h2>

  <ul>
  <?php
  while ( $wydarzenia_query->have_posts() )
  {
    $wydarzenia_query->the_post();
    $k = $post->ID;
    $link = get_permalink( $k );
    $title = get_the_title();
    $image_id = get_post_thumbnail_id( $k);
    $image_url = wp_get_attachment_image_src($image_id,'bl_biuletyn_wydarzenia');
    $image_url = $image_url[0];
    if ( empty($image_url) )
    {
      $image_url = get_template_directory_uri().'/img/placeholders/autor-placeholder.jpg';
    }
  ?>
    <li>
      <a href="<?php echo $link; ?>" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
        <img src="<?php echo $image_url; ?>" />
        <div class="playfair-display"><span class="transition-300-ease"><?php echo $title; ?></span></div>
      </a>
    </li>
  <?php
  } //while have_posts()
  ?>
  </ul>

</section>
<script type="text/javascript">
  $("#biuletyn__wydarzenia ul").carousel({
    show: 1,
    pagination: false
  });
</script>
<?php
wp_reset_postdata();
} //if have_posts()
?>

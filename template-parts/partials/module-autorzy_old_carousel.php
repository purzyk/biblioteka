<?php
/* STARA BAZA AUTORÓW */
$old_db = new wpdb('literackie_db8','XyODXSNCTn','literackie_db8','localhost');
$old_db->set_prefix('wp_');

$querystr = "
	SELECT * FROM $old_db->posts
	LEFT JOIN $old_db->postmeta ON($old_db->posts.ID = $old_db->postmeta.post_id)
	LEFT JOIN $old_db->term_relationships ON($old_db->posts.ID = $old_db->term_relationships.object_id)
	LEFT JOIN $old_db->term_taxonomy ON($old_db->term_relationships.term_taxonomy_id = $old_db->term_taxonomy.term_taxonomy_id)
	LEFT JOIN $old_db->terms ON($old_db->term_taxonomy.term_id = $old_db->terms.term_id)
	WHERE $old_db->terms.slug = 'nasi-autorzy'
	AND $old_db->term_taxonomy.taxonomy = 'bli-autorzy-kategoria'
	AND $old_db->posts.post_status = 'publish'
	AND $old_db->posts.post_type = 'bli-autorzy'
	AND $old_db->postmeta.meta_key = 'nazwisko'
	ORDER BY $old_db->postmeta.meta_value ASC
  LIMIT 100
";

$autorzy_old = $old_db->get_results($querystr, OBJECT);

$post_type = get_query_var( 'post_type' );
if ( $autorzy_old )
{
?>
<section id="<?php echo $post_type; ?>__autorzy" class="<?php echo $post_type; ?>_autorzy">

    <h2 class="<?php echo $post_type; ?>__module-subtitle">
        <span><a href="<?php echo get_post_type_archive_link('autorzy_lista'); ?>"><?php _e( 'autorzy', 'biblioteka' ); ?></a></span>
    </h2>

    <ul>
    <?php
    foreach ($autorzy_old as $autorzy => $value )
    {

        $id = $value->ID;
        $name = $value->post_title;
        $name_nazwisko = explode(' ', trim($value->post_title));
        $thumb_id = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = '_thumbnail_id' and post_id = '$value->ID'");
        $wp_attached_file = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = '_wp_attached_file' and post_id = '$thumb_id'");

        $thumb_file = explode(".jpg", $wp_attached_file);
        $thumb_file_ext = ".jpg";
        if (strpos($wp_attached_file, '.png') !== false)
        {
        $thumb_file = explode(".png", $wp_attached_file);
            $thumb_file_ext = ".png";
        }


        $thumb_url = "http://biuroliterackie.pl/wp-content/uploads/";
        $thumb_url .= $thumb_file[0];
        $thumb_url .= "-440x274";
        $thumb_url .= $thumb_file_ext;

        //$thumb_url .= $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = '_wp_attached_file' and post_id = '$thumb_id'");
        $biogram = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'biogram' and post_id = '$value->ID'");

        $get_autor = get_page_by_title( $name, OBJECT, 'autorzy_lista' );
        $new_id = $get_autor->ID;
        $new_post_content = $get_autor->post_content;
        $new_nazwa = $get_autor->post_title;

        $new_img_id = get_post_thumbnail_id($new_id);
        $new_img_url = wp_get_attachment_image_src($new_img_id,'medium');
        $new_img_url = $new_img_url[0];
        ?>
        <li>
      <a href="http://biuroliterackie.pl/autorzy/<?php echo $value->post_name; ?>/" title="<?php _e( 'Zobacz więcej', 'biblioteka' ); ?>" target="_blank">
        <img src="<?php echo $thumb_url; ?>" />
        <div class="playfair-display autor"><span><?php echo $name_nazwisko[0]; ?> <?php echo mb_strtoupper($name_nazwisko[1], 'UTF-8'); ?></span></div>
      </a>
    </li>
    <?php
    } //endwhile have_posts()
    ?>
    </ul>
</section>

<script type="text/javascript">
  $("#<?php echo $post_type; ?>__autorzy ul").carousel({
    show: 3,
    pagination: false
  });
</script>

<?php
} //endif have_posts()
?>

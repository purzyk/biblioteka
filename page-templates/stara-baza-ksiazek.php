<?php
/**
* Template Name: Stara Baza Książek
*/

ini_set('memory_limit', '1024M'); // or you could use 1G
ini_set('max_execution_time', 1000); //300 seconds = 5 minutes

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<style>
    body {
        background-color: #FAFAFA;
        margin: 40px auto;
        max-width: 650px;
        line-height: 1.6;
        font-size: 18px;
        color: #444;
        padding: 0 10px;
    }
    a {
        text-decoration: none;
        color: #444;
    }
    a:hover {
        font-weight: bold;
        color: #d01117;
    }
    ol li {
       color: #d01117; 
    }
</style>
<?php

/* STARA BAZA KSIĄŻEK */
$old_db = new wpdb('literackie_db8','XyODXSNCTn','literackie_db8','localhost');
$old_db->set_prefix('wp_');

$querystr = "
	SELECT * FROM $old_db->posts
    INNER JOIN $old_db->postmeta m1
        ON ( $old_db->posts.ID = m1.post_id )
    INNER JOIN $old_db->postmeta m2
        ON ( $old_db->posts.ID = m2.post_id )
    INNER JOIN $old_db->postmeta m4
        ON ( $old_db->posts.ID = m4.post_id )
	WHERE $old_db->posts.post_status = 'publish'
	AND $old_db->posts.post_type = 'bli-ksiazki'
    AND ( m1.meta_key = 'bli_book' AND m1.meta_value = 'nie' )
    AND ( m2.meta_key = 'bli_gatunek' AND m2.meta_value != '' )
    AND ( m4.meta_key = 'wydawca' AND m4.meta_value != 'Biuro Literackie' )
LIMIT 5000
";

$autorzy_old = $old_db->get_results($querystr, OBJECT);

$i = 0;
?>

<ol>
<?php foreach ($autorzy_old as $autorzy => $value ) : ?>
    
    <?php
    set_time_limit(10);
    
    $thumb_id = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = '_thumbnail_id' and post_id = '$value->ID'");
    $wp_attached_file = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = '_wp_attached_file' and post_id = '$thumb_id'");
    
    // OLD BOOK FIELDS
    $autor = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'autor' and post_id = '$value->ID'");
    $autor_imie = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'autor_imie' and post_id = '$value->ID'");
    $autor_nazwisko = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'autor_nazwisko' and post_id = '$value->ID'");
    $wydawca = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'wydawca' and post_id = '$value->ID'");
    $miejsce = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'miejsce' and post_id = '$value->ID'");
    $wydanie = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'wydanie' and post_id = '$value->ID'");
    $data = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'data' and post_id = '$value->ID'");
    $strony = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'strony' and post_id = '$value->ID'");
    $gatunek = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'gatunek' and post_id = '$value->ID'");
    $seria = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'seria' and post_id = '$value->ID'");
    $format = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'format' and post_id = '$value->ID'");
    $oprawa = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'oprawa' and post_id = '$value->ID'");
    $papier = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'papier' and post_id = '$value->ID'");
    $autor_okladki = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'autor_okladki' and post_id = '$value->ID'");
    $autor_opracowanie = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'autor_opracowanie' and post_id = '$value->ID'");
    $isbn = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'isbn' and post_id = '$value->ID'");
    $bli_gatunek = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'bli_gatunek' and post_id = '$value->ID'");
    $tlumacze = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'tlumacz' and post_id = '$value->ID'");
    $cat_bibliografie = $old_db->get_var("SELECT meta_value FROM $old_db->postmeta where meta_key = 'cat_bibliografie' and post_id = '$value->ID'");
    
    $value_tlumacze = array();
    
    $value_autor = array();
    
    if ( !empty($autor_imie) )
    {
        $value_autor[0]["imie"] = $autor_imie;
    }
    
    if ( !empty($autor_nazwisko) )
    {
        $value_autor[0]["nazwisko"] = $autor_nazwisko;
    }
    
    if ( !empty($tlumacze) )
    {
        $tlumacze = explode(', ', $tlumacze);
        
        foreach ( $tlumacze as $tlumacz )
        {
            $t = explode(' ', $tlumacz);
            $value_tlumacze[$i]['imie'] = (!empty($t[0])) ? $t[0] : NULL;
            $value_tlumacze[$i]['nazwisko'] = (!empty($t[1])) ? $t[1] : NULL;
            ++$i;
        }
    }
    
    
    //print_r($value_autor);
    
    // vars
    $new_book = array(
        'post_title'	=> $value->post_title,
        'post_type'		=> 'ksiazki_lista',
        'post_status'	=> 'publish'
    );
    
    
    $args_c_b = array(
	'post_type'  => 'ksiazki_lista',
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key'     => 'old_book_id',
			'value'   => $value->ID,
			'compare' => '=',
            )
        ),
    );
    $query_c_b = new WP_Query( $args_c_b );
       
    //if (strpos($autor, ',') !== false) :
    ?>
    <li>
        <a href="http://biuroliterackie.pl/wp-admin/post.php?post=<?php echo $value->ID; ?>&action=edit" target="_blank">
            <?php echo $value->post_title; ?>
        </a>
    </li>
    <?php //endif; ?>
<?php endforeach; ?>
</ol>

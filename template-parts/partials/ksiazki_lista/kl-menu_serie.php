<?php
//$g->slug == get_query_var('gatunek')
$serie = get_terms( 'ksiazki_serie', array(
    'orderby'    => 'id',
    'hide_empty' => 0
) );
$current = array();
$archiwalne = array();
foreach ( $serie as $seria )
{
    if ( !get_field('archiwalne', $seria->taxonomy.'_'.$seria->term_id) )
    {
        $current[] = $seria->term_id;
    }
    else
    {
        $archiwalne[] = $seria->term_id;
    }
}


?>

<?php if ( !empty($current) ) : ?>
<ul class="ksiazki-lista__serie row">
    <?php
    $i = 1;
    foreach ( $current as $id ) :

    $term = get_term_by('term_id', $id, 'ksiazki_serie');
    $active = "";
    if ( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $id || $term->slug == get_query_var('show') )
    {
        $active = "active ";
    }
    ?>
        <li class="<?php echo $active; ?>playfair-display col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
            <a href="<?php echo get_term_link($term); ?>" title=""><?php echo $term->name; ?></a>
            <div><?php echo $term->description; ?></div>
        </li>
        <?php if ( $i % 4 == 0 ) : ?>
        <div class="clearfix"></div>
        <?php endif; ?>
    <?php ++$i; endforeach; //close foreach ?>
</ul>
<?php endif; ?>

<?php if ( !empty($archiwalne) ) : ?>
<a class="toggle-seria-archive lato-font" data-toggle="collapse" data-target="#ksiazki-lista__serie-archive"><?php _e( 'archiwalne', 'biblioteka' ); ?></a>
<ul id="ksiazki-lista__serie-archive" class="collapse in ksiazki-lista__serie row">
    <?php
    $i = 1;
    foreach ( $archiwalne as $id ) :
    $term = get_term_by('term_id', $id, 'ksiazki_serie');
    $active = "";
    if ( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $id || $term->slug == get_query_var('show') )
    {
        $active = "active ";
    }
    ?>
        <li class="<?php echo $active; ?>playfair-display col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0">
            <a href="<?php echo get_term_link($term); ?>" title=""><?php echo $term->name; ?></a>
            <div><?php echo $term->description; ?></div>
        </li>
        <?php if ( $i % 4 == 0 ) : ?>
        <div class="clearfix"></div>
        <?php endif; ?>
    <?php ++$i; endforeach; //close foreach ?>
</ul>
<?php endif; ?>

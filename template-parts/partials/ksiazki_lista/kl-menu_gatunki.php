<?php $gatunki = array('epika','dramat','liryka','esej','przeklady','wywiady','monografie'); ?>

<ul class="ksiazki-litsa__gatunki row">
    <?php
    foreach ( $gatunki as $gatunek ) :
    $g = get_term_by('slug', $gatunek, 'ksiazki_lista_kategorie');
    $active = "";

    if ( $g->term_id == isset(get_queried_object()->term_id) || $g->slug == get_query_var('show') )
    {
        $active = "active ";
    }
    
    ?>
    <li class="<?php echo $active; ?>playfair-display col-xs-6 col-sm-3 col-lg-3 col-lg-offset-0">
        <a href="<?php echo get_term_link($g->term_id); ?>" title=""><?php echo $g->name; ?></a>
        <div><?php echo $g->description; ?></div>
    </li>
    <?php endforeach; //close foreach ?>
</ul>
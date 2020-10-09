<?php
//NAV
$next = array();
if( isset($_GET["page"]) )
{
    switch(trim($_GET["page"]))
    {
        case 'bibliografia':
            $next['url'] = get_permalink().'?page=wiadomosci';
            $next['title'] = 'wiadomości';
            break;
        case 'wiadomosci':
            $next['url'] = get_permalink().'?page=biblioteka';
            $next['title'] = 'biblioteka';
            break;
        case 'biblioteka':
            $next['url'] = get_permalink().'?page=wydarzenia';
            $next['title'] = 'wydarzenia';
            break;
        case 'wydarzenia':
            $next['url'] = get_permalink().'?page=kontakt';
            $next['title'] = 'kontakt';
            break;
        default:
            $next['url'] = get_permalink().'?page=bibliografia';
            $next['title'] = 'bibliografia';
    }
        
}

// SET UP FIELDS
$imie = get_field('imie');
$nazwisko = get_field('nazwisko');
$nazwisko = mb_strtoupper($nazwisko, 'UTF-8');

$menu = array('bibliografia', 'wiadomości', 'biblioteka', 'wydarzenia', 'kontakt');

$subpage_class = "";
if ( !empty($_GET["page"]) )
{
    $subpage_class = "autorzy__subpage-";
    $subpage_class .= $_GET["page"];
}
?>

<div id="content-dbs" class="site-content-dbs">
  <div id="primary" class="autorzy__content-area">
    <main id="main-dbs" class="site-main" role="main">
     
     <!-- NAWIGACJA -->
        <div class="navigation-btns lato-font hide">
            <div class="left">
                <a href="<?php the_permalink(); ?>">
                    <span><?php _e( 'powrót do strony autora', 'biblioteka' ); ?></span>
                </a>
            </div>
            <div class="right">
                <a href="<?php echo $next['url']; ?>">
                    <span><?php _e( $next['title'], 'biblioteka' ); ?></span>
                </a>
            </div>
        </div>
      <section class="biuletyn <?php echo $subpage_class; ?>">

        <figure class="playfair-display">
          <a href="<?php the_permalink(); ?>">
            <span><img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/red-slash.png" alt=""></span>
            <?php echo $imie; ?> <?php echo $nazwisko; ?>
          </a>
        </figure>

        <div class="playfair-display biogram">
          <?php echo strip_tags( get_the_content(), '<em>' ); ?>
        </div>

        <div class="autor_menu-links">
          <ul class="lato-font">
            <?php foreach ( $menu as $item ) : ?>
              <?php
              $active = "";
              $url = $item;
              if ( $item == 'wiadomości' )
              {
                $url = 'wiadomosci';
              }
              if ( isset($_GET["page"]) && trim($_GET["page"]) == $url )
              {
                $active = "class='active'";
              }
              ?>
              <li <?php echo $active; ?>><a href="<?php echo get_permalink(); ?>?page=<?php echo rawurlencode($url); ?>"><span class="red">/</span> <?php echo $item; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

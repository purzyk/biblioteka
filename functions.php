<?php
/**
 * biblioteka functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package biblioteka
 */

if ( ! function_exists( 'biblioteka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function biblioteka_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on biblioteka, use a find and replace
	 * to change 'biblioteka' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'biblioteka', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'biblioteka' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'biblioteka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // biblioteka_setup
add_action( 'after_setup_theme', 'biblioteka_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function biblioteka_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'biblioteka_content_width', 640 );
}
add_action( 'after_setup_theme', 'biblioteka_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function biblioteka_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'biblioteka' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'biblioteka_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'biblioteka_scripts' );
function biblioteka_scripts() {
	
    if ( !is_admin() )
    {
        wp_enqueue_style( 'biblioteka-style-css', get_stylesheet_uri() );
        wp_enqueue_style( 'biblioteka-bootstrap-rwd', get_template_directory_uri().'/css/bootstrap/bootstrap.min.css' );
        wp_enqueue_style( 'biblioteka-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );
        wp_enqueue_style( 'biblioteka-style-css-carousel', get_template_directory_uri().'/css/carousel.css' );
        wp_enqueue_style( 'biblioteka-style-css-lightbox', get_template_directory_uri().'/css/lightbox.css' );
        wp_enqueue_style( 'biblioteka-style-css-magnific-popup', get_template_directory_uri().'/css/magnific-popup.css' );
        wp_enqueue_style( 'biblioteka-style-css-tabs', get_template_directory_uri().'/css/tabs.css' );
        wp_enqueue_style( 'biblioteka-style-css-main', get_template_directory_uri().'/css/main.css' );
        wp_enqueue_style( 'biblioteka-primary', get_template_directory_uri().'/css/primary.css' );
        wp_enqueue_style( 'biblioteka-slick', get_template_directory_uri().'/css/slick.css' );
        wp_enqueue_style( 'biblioteka-slick-theme', get_template_directory_uri().'/css/slick-theme.css' );
        wp_enqueue_style( 'biblioteka-new-css', get_template_directory_uri().'/static/css/styles.css' );
        //wp_enqueue_style( 'biblioteka-style-css-main-dubas', get_template_directory_uri().'/css/main-dubas.css' );

        wp_enqueue_script( 'biblioteka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

        wp_enqueue_style( 'biblioteka-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,400i,700,900|Playfair+Display:400,400i,700,700i,900,900i&amp;subset=latin-ext');

        wp_enqueue_script( 'biblioteka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        wp_enqueue_script( 'biblioteka-jquery', get_template_directory_uri() . '/js/jquery-2.1.4.min.js' );
        wp_enqueue_script( 'biblioteka-core', get_template_directory_uri() . '/js/core.js' );
        wp_enqueue_script( 'biblioteka-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.js' );
        wp_enqueue_script( 'biblioteka-carousel', get_template_directory_uri() . '/js/carousel.js' );
        wp_enqueue_script( 'biblioteka-lightbox', get_template_directory_uri() . '/js/lightbox.js' );
        wp_enqueue_script( 'biblioteka-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js' );
        wp_enqueue_script( 'biblioteka-swap', get_template_directory_uri() . '/js/swap.js' );
        wp_enqueue_script( 'biblioteka-tabs', get_template_directory_uri() . '/js/tabs.js' );
        wp_enqueue_script( 'biblioteka-transition', get_template_directory_uri() . '/js/transition.js' );
        wp_enqueue_script( 'biblioteka-mediaquery', get_template_directory_uri() . '/js/mediaquery.js' );
        wp_enqueue_script( 'biblioteka-touch', get_template_directory_uri() . '/js/touch.js' );
        wp_enqueue_script( 'biblioteka-mixitup', 'https://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js' );
        wp_enqueue_script( 'biblioteka-list', get_template_directory_uri() . '/js/list.min.js' );
        wp_enqueue_script( 'biblioteka-js', get_template_directory_uri() . '/js/script.js' );
        wp_enqueue_script( 'biblioteka-uj', '//code.jquery.com/ui/1.11.4/jquery-ui.js' );
        wp_enqueue_script( 'biblioteka-slickmin-js', get_template_directory_uri() . '/js/slick.min.js'  );
        wp_enqueue_script( 'biblioteka-main-js', get_template_directory_uri() . '/js/main.js'  );
            
        //wp_enqueue_script( 'biblioteka-smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js' );
        //wp_enqueue_script( 'biblioteka-live-reload', 'http://localhost:35729/livereload.js');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Inline scripts and styles in footer.
 */
add_action( 'wp_footer', 'bl_inline_footer_styles' );
function bl_inline_footer_styles() {

    if ( is_page(153803) && is_user_logged_in() )
    {
        echo '<script type="text/javascript">';
        echo 'jQuery( ".page-template-default .wrap-dbs .formularz-propozycji .bl-attach-file .ginput_container_fileupload" ).append( "<label for=\"input_1_11\" class=\"bl-file-upload\">Wybierz plik</label>" );';
        echo '</script>';
    }
    
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
add_image_size( 'blog_small', 124, 124, true );
add_image_size( 'bl_small', 470, 213, true );
add_image_size( 'bl_medium', 730, 331, true );
add_image_size( 'bl_large', 950, 430, true );
add_image_size( 'bl_xl_large', 1600, 725, true );
add_image_size( 'bl_autor_xl_large', 1600, 1200, true );
add_image_size( 'bl_blog', 200, 200, true );
add_image_size( 'bl_autor', 300, 300, true );
add_image_size( 'bl_ksiazka', 708, 321, true );
add_image_size( 'bl_ksiazka_okladka', 265, 500);
add_image_size( 'bl_biuletyn', 615, 415, true);
add_image_size( 'bl_biuletyn2', 712, 415, true);
add_image_size( 'bl_biuletyn_ksiazka', 226, 295);
add_image_size( 'bl_biuletyn_autor', 390, 216, true);
add_image_size( 'bl_biuletyn_wydarzenia', 1230, 340, true);
add_image_size( 'bl_biuletyn_ikona', 368, 207, true);
add_image_size( 'bl_biuletyn_ksiazka2', 285, 400, true);
add_image_size( 'bl_wydarzenia', 1600, 578, true);
add_image_size( 'bl_1645x600', 1645, 600, true);


if (function_exists('register_sidebar')) {
register_sidebar(array(
		'name'=> 'premiera',
		'id' => 'premiera',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=> 'wydarzenie',
		'id' => 'wydarzenie',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'right_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name'=> 'numer',
		'id' => 'numer',
	));


}

add_filter( 'embed_defaults', 'bigger_embed_size' );

function bigger_embed_size()
{
  return array( 'width' => 941, 'height' => 674 );
}
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
     	echo "<div class=\"pagination_links\"><div class=\"pagination\"><span>";

         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><div class=\"next\"></div></a>";
         echo $paged."/<span>".$pages."</span>";
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"><div class=\"prev\"></div></a>";
         echo "</span></div>\n";
         echo "</div>\n";

     }
}
/*
function the_post_thumbnail_caption() {
  global $post;
  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<p>'.$thumbnail_image[0]->post_content.'</p>';
  }
}

*/



function wpbeginner_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}


function wiersz_shortcode( $atts, $content = null ) {
	return '<span class="wiersz">' . $content . '</span>';
}
add_shortcode( 'wiersz', 'wiersz_shortcode' );
function przypis_shortcode( $atts, $content = null ) {
	return '<span class="przypis">' . $content . '</span>';
}
add_shortcode( 'przypis', 'przypis_shortcode' );
add_filter( 'xmlrpc_enabled', '__return_false' );
/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */
add_filter( 'wp_headers', 'AH_remove_x_pingback' );
 function AH_remove_x_pingback( $headers )
 {
 unset( $headers['X-Pingback'] );
 return $headers;
 }

function custom_field_excerpt($opis) {
    $text = the_sub_field($opis);
    return apply_filters('the_content', $text );
}

/**
 * Funkcja dodaje zaplanowane "Projekty" do globalnych zapytań.
 */
if ( !is_admin() )
{
    add_filter( 'pre_get_posts', '__include_future' );
    function __include_future( $query )
    {
        if ( $query->is_single() && $query->query['post_type'] === 'projekty' )
            $GLOBALS[ 'wp_post_statuses' ][ 'future' ]->public = true;
    }
}

function my_post_queries( $query ) {
    // do not alter the query on wp-admin pages and only alter it if it's the main query
    if (!is_admin() && $query->is_main_query())
    {
        global $wp_query;

        $post_type = get_query_var('post_type');
        $view_var = get_query_var('view');
        $taxonomy_var = get_query_var('taxonomy');
        $term_var = get_query_var('show');

        //--Custom Post Type Archive PROJEKTY
        //--//PROJEKTY

        /** AUTORZY */
        if( is_post_type_archive('autorzy_lista') )
        {
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'autorzy_lista_kategorie',
                    'field' => 'slug',
                    'terms' => array('nasi-autorzy'),
                ),
            );

            $meta_query = array(
                array(
                    'key' => 'nazwisko',
                    'value'   => array(''),
                    'compare' => 'NOT IN'
                )
            );

            $query->set('posts_per_page', 40);
            $query->set('meta_key', 'nazwisko');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
            $query->set('meta_query', $meta_query);
            $query->set('tax_query', $tax_query );
        }

        if( is_tax('autorzy_lista_kategorie') )
        {
            $meta_query = array(
                array(
                    'key' => 'nazwisko',
                    'value'   => array(''),
                    'compare' => 'NOT IN'
                )
            );
            $query->set('posts_per_page', 40);
            $query->set('meta_key', 'nazwisko');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
            $query->set('meta_query', $meta_query);
        }

        if( is_tax('autorzy_litera') )
        {
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'autorzy_lista_kategorie',
                    'field' => 'slug',
                    'terms' => array('nasi-autorzy','leksykon-tworcow'),
                ),
            );

            $query->set('posts_per_page', 20);
            $query->set('meta_key', 'nazwisko');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
            $query->set('tax_query', $tax_query );
        }
      
        /** KSIĄŻKI-LISTA biblioteka/ksiazki_lista */
        if( is_post_type_archive('ksiazki_lista') )
        {
            $meta_query = array(
                array(
                    'key'     => 'data',
                    'value'   => date("Y-m-d"),
                    'compare' => '<='
                )
            );
            $tax_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'ksiazki_wydawca',
                    'field' => 'slug',
                    'terms' => 'biuro-literackie'
                ),
                array(
                    'taxonomy' => 'ksiazki_wydawca',
                    'field' => 'slug',
                    'terms' => 'biuro-literackie-instytut-kultury-miejskiej'
                ),
            );
            $query->set('meta_query', $meta_query );
            $query->set('tax_query', $tax_query );
            $query->set('meta_key', 'data');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'DESC');
        }
        if ( is_tax( 'ksiazki_lista_nowosc', 'nowosci' ) || is_post_type_archive('ksiazki_lista') && $view_var == 'nowosci' )
        {
            $meta_query = array(
                array(
                    'key' => 'data',
                    'value' => date("Y-m-d", strtotime("-6 months")),
                    'compare' => '>='
                ),
                array(
                    'key'     => 'data',
                    'value'   => date("Y-m-d"),
                    'compare' => '<='
                )
            );
            $tax_query = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'ksiazki_wydawca',
                    'field' => 'slug',
                    'terms' => 'biuro-literackie'
                ),
                array(
                    'taxonomy' => 'ksiazki_wydawca',
                    'field' => 'slug',
                    'terms' => 'biuro-literackie-instytut-kultury-miejskiej'
                ),
            );
            
            $query->set('tax_query', $tax_query );
            $query->set('posts_per_page', 20);
            $query->set('meta_key', 'data');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'DESC');
            $query->set('meta_query', $meta_query );
        }
        if( is_tax('ksiazki_litera') )
        {
            $meta_query = array(
                array(
                    'key'     => 'data',
                    'value'   => date("Y-m-d"),
                    'compare' => '<='
                )
            );
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'ksiazki_litera',
                    'field' => 'term_id',
                    'terms' => get_queried_object()->term_id
                ),
                array(
                'relation' => 'OR',
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie'
                    ),
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie-instytut-kultury-miejskiej'
                    ),
                ),
            );
            $query->set('tax_query', $tax_query );
            $query->set('meta_query', $meta_query );
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
        if( is_tax('ksiazki_lista_kategorie') )
        {
            $meta_query = array(
                array(
                    'key'     => 'data',
                    'value'   => date("Y-m-d"),
                    'compare' => '<='
                )
            );
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'ksiazki_lista_kategorie',
                    'field' => 'term_id',
                    'terms' => get_queried_object()->term_id
                ),
                array(
                'relation' => 'OR',
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie'
                    ),
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie-instytut-kultury-miejskiej'
                    ),
                ),
            );
            $query->set('meta_query', $meta_query );
            $query->set('tax_query', $tax_query );
            $query->set('meta_key', 'data');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'DESC');
        }
        if( is_tax('ksiazki_serie') )
        {
            $meta_query = array(
                array(
                    'key'     => 'data',
                    'value'   => date("Y-m-d"),
                    'compare' => '<='
                )
            );
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'ksiazki_serie',
                    'field' => 'term_id',
                    'terms' => get_queried_object()->term_id
                ),
                array(
                'relation' => 'OR',
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie'
                    ),
                    array(
                        'taxonomy' => 'ksiazki_wydawca',
                        'field' => 'slug',
                        'terms' => 'biuro-literackie-instytut-kultury-miejskiej'
                    ),
                ),
            );
            $query->set('tax_query', $tax_query );
            $query->set('meta_query', $meta_query );
            $query->set('meta_key', 'data');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'DESC');
        }
        // KSIĄŻKI LISTA GATUNKI 
        if( is_post_type_archive('ksiazki_lista') && $view_var == 'gatunki' || $wp_query->is_search && $post_type == 'ksiazki_lista' && $taxonomy_var == 'gatunki' )
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'ksiazki_lista_kategorie',
                    'field' => 'term_id',
                    'terms' => wp_list_pluck( get_terms( 'ksiazki_lista_kategorie' ), 'term_id' )
                )
            );
            $query->set('tax_query', $tax_query );
        }
        if ( $wp_query->is_search && $post_type == 'ksiazki_lista' && $taxonomy_var == 'gatunki' && $term_var )
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'ksiazki_lista_kategorie',
                    'field' => 'slug',
                    'terms' => $term_var
                )
            );
            $query->set('tax_query', $tax_query );
        }
        // KSIĄŻKI LISTA SERIE
        if( is_post_type_archive('ksiazki_lista') && $view_var == 'serie' || $wp_query->is_search && $post_type == 'ksiazki_lista' && $taxonomy_var == 'serie' )
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'ksiazki_serie',
                    'field' => 'term_id',
                    'terms' => wp_list_pluck( get_terms( 'ksiazki_serie' ), 'term_id' )
                )
            );
            $query->set('tax_query', $tax_query );
        }
        if ( $wp_query->is_search && $post_type == 'ksiazki_lista' && $taxonomy_var == 'serie' && $term_var )
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'ksiazki_serie',
                    'field' => 'slug',
                    'terms' => $term_var
                )
            );
            $query->set('tax_query', $tax_query );
        }
        // KSIĄŻKI LISTA TYTUŁY
        if( is_post_type_archive('ksiazki_lista') && $view_var == 'tytuly' || $wp_query->is_search && $post_type == 'ksiazki_lista' && $taxonomy_var == 'tytuly' )
        {
            $query->set('orderby', 'title' );
            $query->set('order', 'ASC' );
        }
    }
}
add_action( 'pre_get_posts', 'my_post_queries' );

function biblioteka_search($template)
{
    global $wp_query;
    $post_type = get_query_var('post_type');
    
    if( $wp_query->is_search && $post_type == 'biuletyn' )
    {
        return locate_template('search-biuletyn.php');  //  redirect to archive-search.php
    }
    elseif( $wp_query->is_search && $post_type == 'autorzy_lista' )
    {
        return locate_template('search-autorzy_lista.php');  //  redirect to archive-search.php
    }
    elseif( $wp_query->is_search && $post_type == 'ksiazki_lista' )
    {
        return locate_template('search-ksiazki_lista.php');  //  redirect to archive-search.php
    }
    
    return $template;
}
add_filter('template_include', 'biblioteka_search');

function wpse_11826_search_by_title( $search, $wp_query ) {
    
    $post_type = get_query_var('post_type');
    if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) && $wp_query->is_search && $post_type == 'autorzy_lista' ) {
        global $wpdb;

        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';

        $search = array();

        foreach ( ( array ) $q['search_terms'] as $term )
            $search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );

        if ( ! is_user_logged_in() )
            $search[] = "$wpdb->posts.post_password = ''";

        $search = ' AND ' . implode( ' AND ', $search );
    }

    return $search;
}

//add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );

/**
 * Pagination links for search and archives
 */

function get_pagination_links() {
    global $wp_query;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $big = 999999999;

    return paginate_links( array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $wp_query->max_num_pages,
        'prev_next'    => false
    ) );
}

/* Pagination fix for custom loops on pages */
add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {
    if ( is_paged() && is_singular('autorzy_lista') && isset($_GET["page"]) )
    {
        if ( trim($_GET["page"]) == 'wiadomosci' || trim($_GET["page"]) == 'biblioteka' )
        {
            $redirect_url = false;
        }
    }
    if( $wp_query->is_search && $post_type == 'biuletyn' )
    {
        $redirect_url = false;
    }
    
    return $redirect_url; 
}

if ( ! function_exists( 'my_remove_meta_boxes' ) )
{
    function my_remove_meta_boxes() {

        remove_meta_box( 'ksiazki_wydawcadiv', 'ksiazki_lista', 'side' );
        remove_meta_box( 'ksiazki_literadiv', 'ksiazki_lista', 'side' );

    }
}

add_action( 'admin_menu', 'my_remove_meta_boxes' );


//if ( ! function_exists( 'myfirsttheme_setup' ) ) 

// filter autorzy_r
if ( ! function_exists( 'autorzy_filter_meta_key' ) )
{
    function autorzy_filter_meta_key( $where )
    {
        $where = str_replace("meta_key = 'autorzy_r_%", "meta_key LIKE 'autorzy_r_%", $where);

        return $where;
    }   
}
add_filter('posts_where', 'autorzy_filter_meta_key');

// filter translation
if ( ! function_exists( 'kl_translation_filter_meta_key' ) )
{
    function kl_translation_filter_meta_key( $where )
    {
        $where = str_replace("meta_key = 'translation_%", "meta_key LIKE 'translation_%", $where);

        return $where;
    }   
}
add_filter('posts_where', 'kl_translation_filter_meta_key');


if ( ! function_exists( 'bl_my_search_form' ) )
{
    function bl_my_search_form( $custom_post_type, $custom_taxonomy = NULL, $custom_term = NULL)
    {
        $taxonomy = "";
        $term = "";
        if ( isset($custom_taxonomy) )
        {
            $taxonomy = '<input type="hidden" name="taxonomy" value="'.$custom_taxonomy.'" />';
            
            if ( isset($custom_term) )
            {
                $term = '<input type="hidden" name="show" value="'.$custom_term.'" />';
            }
            if ( isset($custom_taxonomy) == 'biuletyn_kategorie' )
            {
                $term = '<input type="hidden" name="biuletyn_kategorie" value="'.$custom_term.'" />';
            }   
        }
        $form = '<div class="row"><div class="col-xs-12"><div class="flexsearch lato-font"><div class="flexsearch--wrapper">';
        $form .= '<form class="flexsearch--form" role="search" method="get" action="'.home_url( '/' ).'">';
        $form .= '<div class="flexsearch--input-wrapper"><input class="flexsearch--input" type="search" placeholder="SZUKAJ" value="'.get_query_var('s').'" name="s"></div>';
        $form .= '<input type="hidden" name="post_type" value="'.$custom_post_type.'" />';
        $form .= $taxonomy;
        $form .= $term;
        $form .= '<input class="flexsearch--submit" type="submit" value=">"/>';
        $form .= '</form>';
        $form .= '</div></div></div></div>';

        return $form;
    }   
}

add_filter( 'body_class', 'bl_my_body_classes' );
if ( ! function_exists( 'bl_my_body_classes' ) )
{
    function bl_my_body_classes( $classes )
    {
        if ( is_post_type_archive('projekty') )
        {
            $classes[] = 'custom-biuletyn-top';
        }
        //get_query_var('view')
        if ( is_post_type_archive('ksiazki_lista') && get_query_var('view') )
        {
            $classes[] = 'post-type-archive-ksiazki_lista-view_' . get_query_var('view');
        }
        if ( is_page_template( 'archive-biuletyn.php' ) )
        {
            $classes[] = 'post-type-archive-biuletyn';
        }
        if ( is_page_template( 'page-biblioteka.php' ) )
        {
            $classes[] = 'home';
        }
        
        return $classes;
    }
}

add_filter( 'wpseo_title', function ( $title ) {

    if ( is_post_type_archive() )
    {
        $title = post_type_archive_title( '', false ).' :: '.get_bloginfo('name');
    }

    return $title;

});

add_filter( 'wpseo_separator_options', 'bl_custom_title_separator' );
function bl_custom_title_separator( $sep ) {

    $sep['bl'] = "::";

    return $sep;

}

add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
    return "<div class='validation_error'>Uzupełnij brakujące pola</div>";
}
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Opcje serwisu',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}
<?php
/**
 * Aqua Theme functions and definitions
 *
 * @package Aqua Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

function custom_login() { ?>
    <style type="text/css">
		#login h1 a {
			background-image:url(<?php echo get_template_directory_uri(); ?>/images/logo-aqua.png) !important;
			padding-bottom: 60px;
			background-size: 230px 107px;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login' );

if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'aqua_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function aqua_theme_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Aqua Theme, use a find and replace
	 * to change 'aqua-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aqua-theme', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'colecao-thumb', 150, 200, true );
	add_image_size( 'colecao-medium', 400 );
	add_image_size( 'colecao-full', 700 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aqua-theme' ),
		'colecao' => __( 'Colecao Menu', 'aqua-theme' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'aqua_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // aqua_theme_setup
add_action( 'after_setup_theme', 'aqua_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function aqua_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'aqua-theme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
		'after_widget'  => '<div class="line"></div>',
	) );
}
add_action( 'widgets_init', 'aqua_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function aqua_theme_scripts() {
	wp_enqueue_style( 'aqua-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tewenty-eleven-style', get_stylesheet_directory_uri() . '/twentyeleven-style.css' );
	wp_enqueue_style( 'paralelo-style', get_stylesheet_directory_uri() . '/style-paralelo.css' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.css' );

	wp_enqueue_script( 'aqua-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'jquery.magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array( 'jquery' ), '', true);

	wp_enqueue_script( 'aqua-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'aqua-theme-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'aqua_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Custom Post Type Itens
 */
require get_template_directory() . '/inc/custom-itens.php';
require get_template_directory() . '/inc/metabox-itens.php';

// Redirect admins to the dashboard and other users elsewhere
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
function my_login_redirect( $redirect_to, $request, $user ) {
    // Is there a user?
    if ( is_array( $user->roles ) ) {
        // Is it an administrator?
        if ( in_array( 'administrator', $user->roles ) )
            return home_url( '/wp-admin/' );
        else
            return home_url();
            // return get_permalink( 83 );
    }
}

/**
 * Hide wrong login names
 * 
 * @return string
 */
function no_login_error() {
    return __('');
}
//add_filter( 'login_errors', 'no_login_error' );

//add_action('init','to_login');
function to_login() {

}

function list_posts_by_taxonomy( $post_type, $taxonomy, $get_terms_args = array(), $wp_query_args = array() ){
    $tax_terms = get_terms( $taxonomy, $get_terms_args );
    if( $tax_terms ){
        foreach( $tax_terms  as $tax_term ){
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true
            );
            $query_args = wp_parse_args( $wp_query_args, $query_args );

            $my_query = new WP_Query( $query_args );
            if( $my_query->have_posts() ) { ?>
                <h3 id="<?php echo $tax_term->slug; ?>" class="tax_term-heading"><?php echo $tax_term->name; ?></h3>
                <ul>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>
                    </a>
                    </li>
                <?php endwhile; ?>
                </ul>
                <?php
            }
            wp_reset_query();
        }
    }
}
function get_top_level_term($term,$taxonomy){
    if($term->parent==0) return $term;
    $parent = get_term( $term->parent,$taxonomy);
    return get_top_level_term( $parent , $taxonomy );
}

// hook failed login
add_action('wp_login_failed', 'my_front_end_login_fail'); 
 
function my_front_end_login_fail($username){
    // Get the reffering page, where did the post submission come from?
    $referrer = $_SERVER['HTTP_REFERER'];
 
    // if there's a valid referrer, and it's not the default log-in screen
    if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
        // let's append some information (login=failed) to the URL for the theme to use
        wp_redirect($referrer . '/entrar'); 
    exit;
    }
}

add_filter('logout_url', 'logout_home', 10, 2);

add_filter('login_redirect', '_catch_login_error', 10, 3);
 
function _catch_login_error($redir1, $redir2, $wperr_user)
{
    if(!is_wp_error($wperr_user) || !$wperr_user->get_error_code()) return $redir1;
	$referrer = $_SERVER['HTTP_REFERER'];
    switch($wperr_user->get_error_code())
    {
        case 'incorrect_password':
        case 'empty_password':
        case 'invalid_username':
        default:
            wp_redirect($referrer . '/entrar'); // modify this as you wish
    }
 
    return $redir1;
}
 
function logout_home($logouturl, $redir)
{
$redir = get_option('siteurl') . "/entrar";
return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}

add_action( 'admin_init', 'redirect_non_admin_users' );
/**
 * Redirect non-admin users to home page
  * This function is attached to the 'admin_init' action hook.
 */
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}

//Adiciona as Minhas Opções
require_once (get_stylesheet_directory() . '/options/admin_options.php');

add_action('init', 'mo_options'); 
function mo_options( $option ){
	echo get_option( $option );
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

function id_por_slug( $slug ) {

    $page = get_page_by_path( $slug );
    if ( $page ) {
        return $page->ID;
    } else {
        return null;
    }

}

/*require get_template_directory() . '/inc/metabox-contato.php';*/
require_once (get_stylesheet_directory() . '/inc/metabox-itens.php');

if ( !function_exists( 'wp_print_r' ) ) {
    function wp_print_r( $args, $die = true ) {
        $echo = '<pre>' . print_r( $args, true ) . '</pre>';
        if ( $die ) die( $echo );
        else echo $echo;
    }
}


add_filter('wp_list_categories', 'add_slug_class_wp_list_categories');
function add_slug_class_wp_list_categories($list) {
$args = array(
'type'                     => 'itens',
'child_of'                 => 0,
'parent'                   => '',
'orderby'                  => 'name',
'order'                    => 'ASC',
'hide_empty'               => 1,
'hierarchical'             => 1,
'exclude'                  => '',
'include'                  => '',
'number'                   => '',
'taxonomy'                 => 'tipos',
'pad_counts'               => false );
$cats = get_categories($args);
	foreach($cats as $cat) {
	$find = 'cat-item-' . $cat->term_id . '"';
	$replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . '"';
	$list = str_replace( $find, $replace, $list );
	$find = 'cat-item-' . $cat->term_id . ' ';
	$replace = 'cat-item-' . $cat->slug . ' cat-item-' . $cat->term_id . ' ';
	$list = str_replace( $find, $replace, $list );
	}
return $list;
}




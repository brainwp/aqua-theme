<?php
/**
 * Aqua Theme functions and definitions
 *
 * @package Aqua Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
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

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aqua-theme' ),
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
	) );
}
add_action( 'widgets_init', 'aqua_theme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function aqua_theme_scripts() {
	wp_enqueue_style( 'aqua-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tewenty-eleven-style', get_stylesheet_directory_uri() . '/twentyeleven-style.css' );
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
    $isLoginPage = strpos($_SERVER['REQUEST_URI'], "wp-login.php") !== false;   
    if(!is_user_logged_in() && !is_admin() &&  !$isLoginPage) {
        header( 'Location:http://beta.brasa.art.br/aqua/entrar' ) ;
        die();
    }
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
<?php
    if(!is_user_logged_in() && !is_page('entrar')) {
		wp_redirect( 'http://beta.brasa.art.br/aqua/entrar' ); exit;
    }
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Aqua Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>

<script>
// Example 1: From an element in DOM
jQuery(function() {
	jQuery('.open-popup-link').magnificPopup({
	  type:'inline',
	  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});
});

</script>

</head>

<body <?php body_class(); ?>>

<div class="sair"><?php wp_loginout( home_url( '/' ) ); ?></div><!-- .sair -->

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="logo">
			<a class="a-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
		</div><!-- .logo -->

    <div class="menu">

	<?php if (is_user_logged_in() ) { ?>
		<?php get_template_part( 'menu' ); ?>
    <?php } ?>
	</div><!-- .menu -->

	</header><!-- #masthead -->

	<div class="site-content">

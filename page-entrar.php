<?php
/**
 * Template Name: Entrar
 * Template Page para apresentar o formulário de login para entrar no site.
 * @package Aqua Theme
 */

get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<div class="form-entrar">

<form name="loginform" id="loginform" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
	<input type="hidden" name="log" id="user_login" value="agnos" />
	
	<label>
	<h3>password</h3>
		
	<div class="pass">
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
	</div><!-- .pass -->
	
	</label>
		<div class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Entrar" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>/" />
		</div>
</form>
			</div><!-- .form-entrar -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
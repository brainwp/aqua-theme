<?php
/**
 * Template Name: Entrar
 * Template Page para apresentar o formulário de login para entrar no site.
 * @package Aqua Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<div class="form-entrar">
				<?php
				$args = array(
						'echo' => true,
						'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
						'form_id' => 'loginform',
						'label_username' => NULL,
						'label_password' => __( 'Password' ),
						'label_remember' => __( 'Remember Me' ),
						'label_log_in' => __( 'Log In' ),
						'id_username' => NULL,
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => NULL,
						'value_remember' => false ); 
				wp_login_form( $args );
				?> 
			</div><!-- .form-entrar -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
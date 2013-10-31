<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
		<main id="main" class="site-main" role="main">
        
        <div class="esquerda-single-item">
			<?php echo do_shortcode('[satellite post_id='.$post->ID.' thumbs=fullleft caption=on auto=on]'); ?>
        </div><!-- .esquerda-single-item -->

        <div class="direita-single-item">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php aqua_theme_content_nav( 'nav-below' ); ?>

		<?php endwhile; // end of the loop. ?>
        </div><!-- .direita-single-item -->

		</main><!-- #main -->
	</div><!-- #primary-colecao -->

<?php get_footer(); ?>
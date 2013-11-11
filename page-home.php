<?php
/**
 * Template Name: Home
 */

get_header(); ?>


		<main id="main" class="site-main" role="main">
<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content-home">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
					<?php edit_post_link( __( 'Edit', 'aqua-theme' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->


<?php get_footer(); ?>

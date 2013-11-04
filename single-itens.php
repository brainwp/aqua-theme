<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
			<div id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>        


				<?php echo do_shortcode('[gallery]'); ?>


			<div class="direita-single-item">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php aqua_theme_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'aqua-theme' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<div class="tamanhos">
						<div class="tamanho-pp">
							pp
						</div><!-- .tamanho-pp -->
						<div class="tamanho-p">
							p
						</div><!-- .tamanho-p -->
						<div class="tamanho-m">
							m
						</div><!-- .tamanho-m -->
						<div class="tamanho-g">
							g
						</div><!-- .tamanho-g -->
					</div><!-- .tamanhos -->

					<?php edit_post_link( __( 'Edit', 'aqua-theme' ), '<span class="edit-link">', '</span>' ); ?>

				</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>
			</div><!-- .direita-single-item -->

			</div><!-- #main -->
	</div><!-- #primary-colecao -->

<?php get_footer(); ?>
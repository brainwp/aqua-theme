<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
			<div id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="loop-fotos">
	            	<?php
	            		$c = 0;
		            	$galeria_images = get_field( 'galeria_imagens_box', $post->ID );
						$galeria_images = explode(',', $galeria_images);
		                foreach ( $galeria_images as $galeria_images_id ) : ?>
		                
		                <?php 
							if ( $c == 0 || $c == 2 ) {
								$class = "each-foto left";
							} else {
								$class = "each-foto";
							}
						?>

						<div class="<?php echo $class; ?>">
							<?php echo wp_get_attachment_image( $galeria_images_id, 'medium' ); ?>
						</div><!-- each-foto -->

						<?php if ( $c == 1 ) { ?>
							<div class="clear-loop"></div>
							<?php $c = 0; ?>
						<?php } ?>

						<?php $c++; ?>

						<?php endforeach; ?>

				</div><!-- .loop-fotos -->

				<div class="entry-header-single-item">

					<?php if (get_field('item_referencia')): ?>
						<span>Referência <?php echo get_field('item_referencia'); ?></span><br />				
					<?php endif; ?>

					<?php if (get_field('item_preco')): ?>
						<span><?php echo get_field('item_preco'); ?></span>						
					<?php endif; ?>

				</div><!-- .entry-header-single-item -->

				<div class="entry-content-single-item">
					<?php the_content(); ?>
				</div><!-- .entry-content-single-item"-->

				<?php edit_post_link( __( 'Edit', 'aqua-theme' ), '<span class="edit-link">', '</span>' ); ?>

			</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #main -->
	</div><!-- #primary-colecao -->

<?php get_footer(); ?>
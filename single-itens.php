<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
			<div id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php
	        	$args = array(
	                'post_type' => 'attachment',
	                'numberposts' => -1,
	                'post_status' => null,
	                'post_parent' => $post->ID,
	                );
            
            	$anexos = get_posts ( $args );
            	?>
            	<?php
		            if ( $anexos ) : ?>

				<div class="loop-fotos">
	            	<?php
		            	$c = 1;
		                foreach ( $anexos as $anexo ) : ?>
		                
		                <?php 
		                    $attachment_id = $anexo->ID;
		                    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'galeria' );
		                    $attachment_page = get_attachment_link( $attachment_id ); 
							$url = wp_get_attachment_url( $attachment_id ); 
							if ( $c == 1 || $c == 3 ) {
								$class = "each-foto left";
							} else {
								$class = "each-foto";
							}
						?>

						<div class="<?php echo $class; ?>">
							<a href="<?php echo $url; ?>" rel="lightbox"><img src="<?php echo $url; ?>" alt=""></a>
						</div><!-- each-foto -->

						<?php if ( $c == 2 ) { ?>
							<div class="clear-loop"></div>
						<?php } ?>

						<?php $c++; ?>

						<?php endforeach; ?>

				</div><!-- .loop-fotos -->

				<?php endif; ?>

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
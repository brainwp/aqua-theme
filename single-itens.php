<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
			<div id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				$pp = get_post_meta(get_the_ID(),'meta_pp');
				$p = get_post_meta(get_the_ID(),'meta_p');
				$m = get_post_meta(get_the_ID(),'meta_m');
				$g = get_post_meta(get_the_ID(),'meta_g');

				if( ! empty( $pp ) ) {
				  $marcado_pp = "marcado-pp";
				}
				if( ! empty( $p ) ) {
				  $marcado_p = "marcado-p";
				}
				if( ! empty( $m ) ) {
				  $marcado_m = "marcado-m";
				}
				if( ! empty( $g ) ) {
				  $marcado_g = "marcado-g";
				}
			?>

			<?php echo do_shortcode('[gallery]'); ?>

			<div class="direita-single-item">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
							<?php global $post;
								$terms = wp_get_post_terms( $post->ID, 'tipos');
							 ?> 
						<h2 class="entry-single"><?php echo $terms[1]->name; ?></h2>

						<h2 class="entry-title-single-item"><?php the_title(); ?></h2>

						<!-- <div class="entry-meta">
							<?php // aqua_theme_posted_on(); ?>
						</div> .entry-meta -->

					</header><!-- .entry-header -->

					<div class="entry-content-single-item">
						<?php
                        	$args = array(
                                'post_type' => 'attachment',
                                'numberposts' => -1,
                                'post_status' => null,
                                'post_parent' => $post->ID,
                                );
                            
                            $anexos = get_posts ( $args );
                            
                            if ( $anexos ) :
                                foreach ( $anexos as $anexo ) : ?>
                                
                                <?php 
                                    $attachment_id = $anexo->ID;
                                    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'galeria' );
                                    $attachment_page = get_attachment_link( $attachment_id ); 
                                    $description = $anexo->post_content;
									$url = wp_get_attachment_url( $attachment_id ); 
								?>

								<div class="each-foto">
									<a href=""><img src="<?php echo $image_attributes[0]; ?>" alt=""></a>
								</div><!-- each-foto -->
								Everaaaaa

								<?php endforeach; ?>

							<?php endif; ?>

						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'aqua-theme' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<div class="tamanhos">
						<div class="tamanho">
							<div class="<?php echo $marcado_pp; ?>">
							<span>pp</span>
							</div>
						</div><!-- .tamanho-pp -->
						<div class="tamanho">
							<div class="<?php echo $marcado_p; ?>">
							<span>p</span>
							</div>
						</div><!-- .tamanho-p -->
						<div class="tamanho">
							<div class="<?php echo $marcado_m; ?>">
							<span>m</span>
							</div>
						</div><!-- .tamanho-m -->
						<div class="tamanho">
							<div class="<?php echo $marcado_g; ?>">
							<span>g</span>
							</div>
						</div><!-- .tamanho-g -->
					</div><!-- .tamanhos -->

					<?php edit_post_link( __( 'Edit', 'aqua-theme' ), '<span class="edit-link">', '</span>' ); ?>

				</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>
			</div><!-- .direita-single-item -->

			</div><!-- #main -->
	</div><!-- #primary-colecao -->

<?php get_footer(); ?>
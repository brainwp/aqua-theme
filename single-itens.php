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

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header-single-item">
					<?php
						global $post;
						$terms = wp_get_post_terms( $post->ID, 'tipos');
					 ?> 
					<h2 class="entry-single"><?php echo $terms[1]->name; ?></h2>

					<h2 class="entry-title-single-item"><?php the_title(); ?></h2>

				</header><!-- .entry-header-single-item -->

				<div class="entry-content-single-item">

					<?php the_content(); ?>

				</div><!-- .entry-content-single-item"-->

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

				<div class="loop-fotos">

				<?php
        	$args = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID,
                );
            
            $anexos = get_posts ( $args );
            
            if ( $anexos ) :
            	$c = 1;
                foreach ( $anexos as $anexo ) : ?>
                
                <?php 
                    $attachment_id = $anexo->ID;
                    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'galeria' );
                    $attachment_page = get_attachment_link( $attachment_id ); 
					$url = wp_get_attachment_url( $attachment_id ); 
					if ( $c == 1 || $c == 5 ) {
						$class = "each-foto left";
					} else {
						$class = "each-foto";
					}
				?>

				<div class="<?php echo $class; ?>">
					<a href="<?php echo $url; ?>" rel="lightbox"><img src="<?php echo $url; ?>" alt=""></a>
				</div><!-- each-foto -->

				<?php if ( $c == 4 ) { ?>
					<div class="clear-loop"></div>
				<?php } ?>

				<?php $c++; ?>

				<?php endforeach; ?>

			<?php endif; ?>

			</div><!-- .loop-fotos -->

				<?php edit_post_link( __( 'Edit', 'aqua-theme' ), '<span class="edit-link">', '</span>' ); ?>

			</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #main -->
	</div><!-- #primary-colecao -->

<?php get_footer(); ?>
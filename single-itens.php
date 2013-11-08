<?php get_header(); ?>

<?php get_sidebar( 'itens' ); ?>

	<div id="primary-colecao" class="content-area">
			<div id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

<?php 
$checkboxes = get_post_meta(get_the_ID(),'meta_tamanhos');
$pp = $checkboxes[0][0];
$p = $checkboxes[0][1];
$m = $checkboxes[0][2];
$g = $checkboxes[0][3];

$tamanhos = "tamanho";
if( ! empty( $pp ) ) {
  $marcado_pp = " marcado-pp";
}
if( ! empty( $p ) ) {
  $marcado_p = " marcado-p";
}
if( ! empty( $m ) ) {
  $marcado_m = " marcado-m";
}
if( ! empty( $g ) ) {
  $marcado_g = " marcado-g";
}

/*
if(empty($checkboxes)) {
    echo("None.");
  } else {
	$array = $checkboxes[0];
	$class_tamanhos = "tamanhos";
	$marcado = " marcado";
	$n = count($array);
		for($i=0; $i < $n; $i++){
		  $class_tamanhos .= $marcado;
		}
	}
*/
?>

				<?php echo do_shortcode('[gallery]'); ?>

			<div class="direita-single-item">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h2 class="entry-categoria"><?php the_terms(get_the_ID() , 'tipos'); ?></h2>
						<h2 class="entry-title"><?php the_title(); ?></h2>

						<!-- <div class="entry-meta">
							<?php // aqua_theme_posted_on(); ?>
						</div> .entry-meta -->

					</header><!-- .entry-header -->

					<div class="entry-content-single-item">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'aqua-theme' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<div class="tamanhos">
						<div class="<?php echo $tamanhos; ?>">
							<div class="<?php echo $marcado_pp; ?>">
							<span>pp</span>
							</div>
						</div><!-- .tamanho-pp -->
						<div class="<?php echo $tamanhos; ?>">
							<div class="<?php echo $marcado_p; ?>">
							<span>p</span>
							</div>
						</div><!-- .tamanho-p -->
						<div class="<?php echo $tamanhos; ?>">
							<div class="<?php echo $marcado_m; ?>">
							<span>m</span>
							</div>
						</div><!-- .tamanho-m -->
						<div class="<?php echo $tamanhos; ?>">
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
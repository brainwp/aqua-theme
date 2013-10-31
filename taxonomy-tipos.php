<?php get_header(); ?>

<?php get_sidebar( 'colecao' ); ?>

	<div id="primary-colecao" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
			<?php
			$term = $wp_query->queried_object;
			$id = $term->parent;
			$array = get_term_by('id', $id, "tipos", 'ARRAY_A'); ?><?php $taxo_pai = $array[name];
			?>
			<div class="titulo-taxonomy"><h1 class="colecao-title"><?php echo $taxo_pai .' / '. $term->name; ?></h1></div>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<div class="cada-item">
				<a class="a-cada-item" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'colecao-thumb' ); ?>
				</a><!-- a-cada-item -->
				<div class="titulo-cada-item"><?php the_title(); ?></div>
			</div><!-- cada-item -->

			<?php endwhile; ?>

			<?php aqua_theme_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary-colecao -->
<?php get_footer(); ?>

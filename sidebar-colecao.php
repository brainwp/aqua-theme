<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Aqua Theme
 */
?>
	<div id="secondary-colecao" class="widget-area" role="complementary">

<ul>
		<?php $args = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'hide_empty'         => 1,
			'child_of'           => 0,
			'hierarchical'       => 1,
			'title_li'           => '',
			'show_option_none'   => '',
			'number'             => null,
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 1,
			'taxonomy'           => 'tipos',
			'walker'             => null
		); ?>
		 <?php wp_list_categories( $args ); ?>
</ul>

	</div><!-- #secondary-colecao -->

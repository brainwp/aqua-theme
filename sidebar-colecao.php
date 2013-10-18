<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Aqua Theme
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php list_posts_by_taxonomy( 'colecao', 'tipos' ); ?>
	</div><!-- #secondary -->

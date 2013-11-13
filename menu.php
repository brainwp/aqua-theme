<?php
	if( ! is_page('quem-somos')) {
		$pop = "#test-popup";
	} else {
		$pop = "/quem-somos";
	}
?>    

	<a class="a-item-menu open-popup-link" href="<?php echo $pop; ?>">
    <div class="item-menu i-quem-somos">
        <span>quem somos</span>
    </div><!-- .item-menu .quem-somos -->
	</a>

	<a class="a-item-menu" href="<?php echo home_url('/blog/'); ?>">
    <div class="item-menu i-blog">
        <span>blog</span>
    </div><!-- .item-menu .blog -->
    </a>
    
	<a class="a-item-menu" href="<?php echo home_url('/itens/'); ?>">
    <div class="item-menu i-colecao">
        <span>cole&ccedil;&atilde;o</span>
    </div><!-- .item-menu .colecao -->
    </a>
    
    <a class="a-item-menu open-popup-link" href="#contato-popup">
    <div class="item-menu i-contato">
        <span>contato</span>
    </div><!-- .item-menu .contato-->
    </a>
    
    <div id="test-popup" class="white-popup mfp-hide">
		<?php $quem_somos = get_post( $id = 49 );
			echo "<h2 class='titulo-popup'>" . $quem_somos->post_title . "</h2><br />";
			echo apply_filters( 'the_content', $quem_somos->post_content);
		?>
	</div>

    <div id="contato-popup" class="white-popup mfp-hide">
		<?php $contato = get_post( $id = 83 ); ?>
			<?php echo "<h2 class='titulo-popup'>" . $contato->post_title . "</h2><br />"; ?>
			<div style="margin-right:20px; float:left;"><?php echo do_shortcode('[google-map-sc id="83" width="430" height="260" align="left" zoom="15"]'); ?></div>
			<?php echo apply_filters( 'the_content', $contato->post_content); ?>
	</div>
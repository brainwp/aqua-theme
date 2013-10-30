    <a class="a-item-menu open-popup-link" href="#test-popup">
    <div class="item-menu i-quem-somos">
        <span>quem somos</span>
    </div><!-- .item-menu .quem-somos -->
	</a>

	<a class="a-item-menu" href="<?php echo home_url('/blog/'); ?>">
    <div class="item-menu i-blog">
        <span>blog</span>
    </div><!-- .item-menu .blog -->
    </a>
    
	<a class="a-item-menu" href="<?php echo home_url('/colecao/'); ?>">
    <div class="item-menu i-colecao">
        <span>cole&ccedil;&atilde;o</span>
    </div><!-- .item-menu .colecao -->
    </a>
    
    <a class="a-item-menu" href="<?php echo home_url('/contato/'); ?>">
    <div class="item-menu i-contato">
        <span>contato</span>
    </div><!-- .item-menu .contato-->
    </a>
    
    <div id="test-popup" class="white-popup mfp-hide">
		<?php $page = get_post( $id = 49 );
			echo $page->post_title . "<br />";
			echo apply_filters( 'the_content', $page->post_content);
		?>
	</div>
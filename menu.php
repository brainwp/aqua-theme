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

			<div class="esquerda-pop-contato">
				<iframe width="360" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?oe=utf-8&amp;client=firefox-a&amp;q=R+Professor+Cesare+Lombroso+117++Bom+Retiro&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Prof.+Cesare+Lombroso,+117+-+Bom+Retiro,+S%C3%A3o+Paulo,+01122-021&amp;ll=-23.53152,-46.640331&amp;spn=0.00901,0.016512&amp;t=m&amp;z=14&amp;output=embed"></iframe>
			</div>
			<div class="direita-pop-contato">
				<?php echo apply_filters( 'the_content', $contato->post_content); ?>
				<?php echo do_shortcode("[contact-form][contact-field label='E-mail' type='text' required='1'/][contact-field label='Mensagem' type='textarea' required='1'/][/contact-form]"); ?>
			</div>
	</div>
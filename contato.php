		<?php $contato = get_post( $id = 83 ); ?>

			<div class="esquerda-pop-contato">
				<?php echo do_shortcode('[google-map-sc id="83" width="380" height="260" zoom="15"]'); ?>
			</div>
			<div class="direita-pop-contato">
				<?php echo apply_filters( 'the_content', $contato->post_content); ?>
				<?php echo do_shortcode("[contact-form][contact-field label='E-mail' type='text' required='1'/][contact-field label='Mensagem' type='textarea' required='1'/][/contact-form]"); ?>
			</div>
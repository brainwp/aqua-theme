<?php if(function_exists("register_field_group")){	register_field_group(array (		'id' => 'acf_itens',		'title' => 'Itens',		'fields' => array (			array (				'key' => 'field_53a46218ec169',				'label' => 'Referência',				'name' => 'item_referencia',				'type' => 'text',				'instructions' => 'Preencha com o número de referência do produto',				'default_value' => '',				'placeholder' => '',				'prepend' => '',				'append' => '',				'formatting' => 'html',				'maxlength' => '',			),			array (				'key' => 'field_53a46272ec16b',				'label' => 'Preço',				'name' => 'item_preco',				'type' => 'text',				'instructions' => 'Adicione o preço desse item. Lembre-se de adicionar a a moeda, exemplo R$',				'default_value' => '',				'placeholder' => '',				'prepend' => '',				'append' => '',				'formatting' => 'html',				'maxlength' => '',			),		),		'location' => array (			array (				array (					'param' => 'post_type',					'operator' => '==',					'value' => 'itens',					'order_no' => 0,					'group_no' => 0,				),			),		),		'options' => array (			'position' => 'side',			'layout' => 'default',			'hide_on_screen' => array (			),		),		'menu_order' => 0,	));}require get_template_directory() . '/inc/odin-metabox.php';$galeria_imagens = new Odin_Metabox(    'galeria_imagens', // Slug/ID do Metabox (obrigatório)    'Galeria de Imagens', // Nome do Metabox  (obrigatório)    'itens', // Slug do Post Type, sendo possível enviar apenas um valor ou um array com vários (opcional)    'advanced', // Contexto (opções: normal, advanced, ou side) (opcional)    'high' // Prioridade (opções: high, core, default ou low) (opcional));$galeria_imagens->set_fields(    array(        array(            'id' => 'galeria_imagens_box', // *            'label' => 'Selecione ou faça upload das imagens desse produto', // *            'type' => 'image_plupload', // *            'default' => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)            'description' => '', // Opcional        )    ));
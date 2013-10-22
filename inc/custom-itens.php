<?php

/**
 * Adicionamos uma ação no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_itens' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_itens() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Cole&ccedil;&atilde;o', 'post type general name'),
	    'singular_name' => _x('Item', 'post type singular name'),
	    'add_new' => _x('Novo Item', 'itens'),
	    'add_new_item' => __('Novo Item'),
	    'edit_item' => __('Editar Item'),
	    'new_item' => __('Novo Item'),
	    'all_items' => __('Todos Itens'),
	    'view_item' => __('Ver Item'),
	    'search_items' => __('Procurar Item'),
	    'not_found' =>  __('Nenhum Item Encontrado'),
	    'not_found_in_trash' => __('Nenhum Item encontrado no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Cole&ccedil;&atilde;o'
    );
    
    /**
     * Registamos o tipo de post colecoes através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'itens', array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    /*'has_archive' => 'itens',*/
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'itens',
		 'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => null,
	    'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	    )
    );

	flush_rewrite_rules();

}
   
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies_itens', 0 );

// create two taxonomies, tipos for the post type "colecoes"
function create_taxonomies_itens() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Cole&ccedil;&atilde;o', 'taxonomy general name' ),
		'singular_name'     => _x( 'Cole&ccedil;&atilde;o', 'taxonomy singular name' ),
		'search_items'      => __( 'Procurar Cole&ccedil;&atilde;o' ),
		'all_items'         => __( 'Todas Cole&ccedil;&atilde;o' ),
		'view_item'  	    => __( 'Ver Cole&ccedil;&atilde;o' ),
		'parent_item'       => __( 'Cole&ccedil;&atilde;o pai' ),
		'parent_item_colon' => __( 'Cole&ccedil;&atilde;o pai:' ),
		'edit_item'         => __( 'Editar Cole&ccedil;&atilde;o' ),
		'update_item'       => __( 'Salvar Cole&ccedil;&atilde;o' ),
		'add_new_item'      => __( 'Adicionar Novo' ),
		'new_item_name'     => __( 'Novo' ),
		'menu_name'         => __( 'Cole&ccedil;&otilde;es' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'colecao' ),
	);

	register_taxonomy( 'tipos', array( 'itens' ), $args );

}  
   
// Adiciona a coluna Categorias ao Custom Post Type colecoes
add_filter( 'manage_itens_posts_columns', 'itens_cpt_columns' );
add_action( 'manage_itens_posts_custom_column', 'itens_cpt_custom_column', 10, 2 );

function itens_cpt_columns($defaults) {
    $defaults['colecao'] = 'Cole&ccedil;&atilde;o';
    return $defaults;
}

function itens_cpt_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);
 
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>Sem Cole&ccedil;&atilde;o.</i>';
}
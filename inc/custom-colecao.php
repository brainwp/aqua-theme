<?php

/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_colecao' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_colecao() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Cole&ccedil;&atilde;o', 'post type general name'),
	    'singular_name' => _x('Cole&ccedil;&atilde;o', 'post type singular name'),
	    'add_new' => _x('Nova Cole&ccedil;&atilde;o', 'colecao'),
	    'add_new_item' => __('Nova Cole&ccedil;&atilde;o'),
	    'edit_item' => __('Editar Cole&ccedil;&atilde;o'),
	    'new_item' => __('Nova Cole&ccedil;&atilde;o'),
	    'all_items' => __('Todos Cole&ccedil;&otilde;es'),
	    'view_item' => __('Ver Cole&ccedil;&atilde;o'),
	    'search_items' => __('Procurar Cole&ccedil;&atilde;o'),
	    'not_found' =>  __('Nenhuma Cole&ccedil;&atilde;o Encontrada'),
	    'not_found_in_trash' => __('Nenhuma Cole&ccedil;&atilde;o encontrada no Lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Cole&ccedil;&atilde;o'
    );
    
    /**
     * Registamos o tipo de post colecoes através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'colecao', array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    /*'has_archive' => 'colecao',*/
	    'query_var' => true,
		'rewrite' => array(
		 'slug' => 'colecao',
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
add_action( 'init', 'create_taxonomies_colecao', 0 );

// create two taxonomies, tipos for the post type "colecoes"
function create_taxonomies_colecao() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Tipos', 'taxonomy general name' ),
		'singular_name'     => _x( 'Tipo', 'taxonomy singular name' ),
		'search_items'      => __( 'Procurar tipos' ),
		'all_items'         => __( 'Todos tipos' ),
		'view_item'  	    => __( 'Ver tipo' ),
		'parent_item'       => __( 'Tipo pai' ),
		'parent_item_colon' => __( 'Tipo pai:' ),
		'edit_item'         => __( 'Editar tipo' ),
		'update_item'       => __( 'Salvar tipo' ),
		'add_new_item'      => __( 'Adicionar Novo' ),
		'new_item_name'     => __( 'Nome' ),
		'menu_name'         => __( 'Tipos' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tipos' ),
	);

	register_taxonomy( 'tipos', array( 'colecao' ), $args );

}  
   
// Adiciona a coluna Categorias ao Custom Post Type colecoes
add_filter( 'manage_colecoes_posts_columns', 'ilc_cpt_columns' );
add_action( 'manage_colecoes_posts_custom_column', 'ilc_cpt_custom_column', 10, 2 );

function ilc_cpt_columns($defaults) {
    $defaults['tipo'] = 'Tipo';
    return $defaults;
}

function ilc_cpt_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);
 
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>No terms.</i>';
}
<?php
class Simplewoo_CPT {

	public static function init() {
		self::register_product_cpt();
		
		// Tax
		self::register_taxonomies();
	}

	public static function register_product_cpt() {
	    $labels = array(
	        'name'                  => _x( 'Productos', 'Post Type General Name', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'singular_name'         => _x( 'Producto', 'Post Type Singular Name', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'menu_name'             => __( 'Productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'name_admin_bar'        => __( 'Productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'archives'              => __( 'Listado productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'attributes'            => __( 'Atributos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'parent_item_colon'     => __( 'Producto padre:', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'all_items'             => __( 'Todos los productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_new_item'          => __( 'Añadir nuevo producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_new'               => __( 'Añadir nuevo', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'new_item'              => __( 'Nuevo producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'edit_item'             => __( 'Editar producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'update_item'           => __( 'Actualizar producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'view_item'             => __( 'Ver producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'view_items'            => __( 'Ver productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'search_items'          => __( 'Buscar producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'not_found'             => __( 'No encontrado', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'not_found_in_trash'    => __( 'No encontrado en la papelera', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'featured_image'        => __( 'Imagen destacada', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'set_featured_image'    => __( 'Establecer imagen destacada', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'remove_featured_image' => __( 'Borrar imagen destacada', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'use_featured_image'    => __( 'Usar como imagen destacada', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'insert_into_item'      => __( 'Insertar en productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'uploaded_to_this_item' => __( 'Subir a productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'items_list'            => __( 'Listado productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'items_list_navigation' => __( 'Listado productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'filter_items_list'     => __( 'Filtrado productos', SIMPLEWOO_PLUGIN_DOMAIN ),
	    );
	    
	    $rewrite = array(
	        'slug'                  => 'producto',
	        'with_front'            => true,
	        'pages'                 => true,
	        'feeds'                 => true,
	    );
	    
	    $args = array(
	        'label'                 => __( 'Producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'description'           => __( 'Producto', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'labels'                => $labels,
	        'supports'              => array( 'title', 'editor', 'thumbnail' ),
	        'taxonomies'            => array(),
	        'hierarchical'          => false,
	        'public'                => true,
	        'show_ui'               => true,
	        'show_in_menu'          => true,
	        'menu_position'         => 5,
	        'menu_icon'             => 'dashicons-store',
	        'show_in_admin_bar'     => true,
	        'show_in_nav_menus'     => true,
	        'can_export'            => true,
	        'has_archive'           => true,
	        'exclude_from_search'   => false,
	        'publicly_queryable'    => true,
	        'rewrite'               => $rewrite,
	        'capability_type'       => 'page',
	        'show_in_rest'          => true,
	    );

	    register_post_type( 'product', $args );

	}
	
	public static function register_taxonomies() {
	    // Categorías de productos
	    $labels = array(
	        'name' => _x( 'Categorías', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'singular_name' => _x( 'Categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'search_items' =>  __( 'Buscar categorías', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'popular_items' => __( 'Categorías frecuentes', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'all_items' => __( 'Todas las categorías', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'parent_item' => null,
	        'parent_item_colon' => null,
	        'edit_item' => __( 'Editar categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'update_item' => __( 'Actualizar categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_new_item' => __( 'Añadir nueva categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'new_item_name' => __( 'Nuevo nombre de categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'separate_items_with_commas' => __( 'Separar categorías por comas', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_or_remove_items' => __( 'Añadir o eliminar categoría', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'choose_from_most_used' => __( 'Elegir entre los cargos más frecuentes', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'menu_name' => __( 'Categorías', SIMPLEWOO_PLUGIN_DOMAIN ),
	    );
	    register_taxonomy( 'product_cat',
	        'product', array(
	            'hierarchical'      => true,
	            'labels'            => $labels,
	            'show_ui'           => true,
	            'show_admin_column' => true,
	            'query_var'         => true,
	            'show_in_rest'      => true,
	            'rewrite'           => array( 'slug' => 'categoria-producto', 'hierarchical' => true ),
	        ));
	    
	    // Etiquetas de productos
	    $labels = array(
	        'name' => _x( 'Etiquetas', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'singular_name' => _x( 'Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'search_items' =>  __( 'Buscar Etiquetas', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'popular_items' => __( 'Etiquetas frecuentes', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'all_items' => __( 'Todas las Etiquetas', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'parent_item' => null,
	        'parent_item_colon' => null,
	        'edit_item' => __( 'Editar Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'update_item' => __( 'Actualizar Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_new_item' => __( 'Añadir nueva Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'new_item_name' => __( 'Nuevo nombre de Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'separate_items_with_commas' => __( 'Separar Etiquetas por comas', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'add_or_remove_items' => __( 'Añadir o eliminar Etiqueta', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'choose_from_most_used' => __( 'Elegir entre los cargos más frecuentes', SIMPLEWOO_PLUGIN_DOMAIN ),
	        'menu_name' => __( 'Etiquetas', SIMPLEWOO_PLUGIN_DOMAIN ),
	    );
	    register_taxonomy( 'product_tag',
	        'product', array(
	            'hierarchical'      => true,
	            'labels'            => $labels,
	            'show_ui'           => true,
	            'show_admin_column' => true,
	            'query_var'         => true,
	            'show_in_rest'      => true,
	            'rewrite'           => array( 'slug' => 'etiqueta-producto', 'hierarchical' => true ),
	        ));
	    
	}
}
Simplewoo_CPT::init();

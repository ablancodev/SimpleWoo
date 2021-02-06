<?php
class Simplewoo_Metabox {
    
    /**
     * Constructor.
     */
    public static function init() {
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_metabox'  )        );
        add_action( 'save_post',      array( __CLASS__, 'save_metabox' ), 10, 2 );
    }
    
    /**
     * Adds the meta box.
     */
    public static function add_metabox() {
        add_meta_box(
            'my-meta-box',
            __( 'Datos básicos', SIMPLEWOO_PLUGIN_DOMAIN ),
            array( __CLASS__, 'render_metabox' ),
            'product',
            'advanced',
            'default'
            );
    }
    
    /**
     * Renders the meta box.
     */
    public static function render_metabox( $post ) {
        wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
        $outline = '<label for="title_field" style="width:150px; display:inline-block;">'. esc_html__('Precio', SIMPLEWOO_PLUGIN_DOMAIN) .'</label>';
        $title_field = get_post_meta( $post->ID, '_price', true );
        $outline .= '<input type="text" name="_price" id="title_field" class="title_field" value="'. esc_attr($title_field) .'" />';
        echo $outline;
    }
    
    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
        
        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }
        
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
        
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        $precio   = isset( $_POST['_price'] ) ? sanitize_text_field( $_POST['_price'] ) : '';
        update_post_meta( $post_id, '_price', $precio );
    }
}

Simplewoo_Metabox::init();
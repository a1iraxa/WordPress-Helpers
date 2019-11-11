<?php 

if ( is_admin() ) {
    add_action( 'load-post.php',     'digitsol_call_offer_expire_date_class' );
    add_action( 'load-post-new.php', 'digitsol_call_offer_expire_date_class' );
}


/**
 * Calls the class on the post edit screen.
 */
function digitsol_call_offer_expire_date_class() {
    new OfferExpireDateInWoocommerceMetaBox();
}


/**
 * The Class.
 */
class OfferExpireDateInWoocommerceMetaBox {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'digitsol_enqueue_datepicker') );
    }
 
    /**
     * Adds the meta box container.
     */
    public function digitsol_enqueue_datepicker() {
        // Load the datepicker script (pre-registered in WordPress).
        wp_enqueue_script( 'jquery-ui-datepicker' );
    
        // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
        wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );  
        
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'product' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'specification_meta_box_in_woo',
                __( 'Offer Expiry Date ', 'textdomain' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
 
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if ( ! isset( $_POST['product_offer_expiry_box_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['product_offer_expiry_box_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'product_offer_expiry_box' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['woocommerce_product_offer_expiry_tab'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_product_offer_expiry_tab_key', $mydata );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'product_offer_expiry_box', 'product_offer_expiry_box_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_product_offer_expiry_tab_key', true );
 
        // Display the form, using the current value.
        ?>
        <label for="woocommerce_product_offer_expiry_tab">
            <?php _e( 'Enter product offer expiry date. ', 'digitsol' ); ?> <a href="<?php echo admin_url( 'admin.php?page=wc-settings&tab=products&section=digitsol_global_expiry' ); ?>"> Override this option.</a>
        </label>
        <input
            type="text"
            id="woocommerce_product_offer_expiry_tab" 
            name="woocommerce_product_offer_expiry_tab" 
            style="width: 100%"
            value="<?php echo esc_attr( $value ); ?>"
        /> 
        <script>
            jQuery(document).ready(function($) {
                $("#woocommerce_product_offer_expiry_tab").datepicker({
                    dateFormat: 'd MM yy'
                });
            });
        </script>
        
        <?php
    }
    

}
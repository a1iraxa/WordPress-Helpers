<?php 
if (class_exists('WC_Booking_Form')) {
    class DigitSol_Booking_Form extends WC_Booking_Form { 

    	public function __construct($product) { 
    		parent::__construct($product);
    		add_action( 'wp_ajax_digitsol_calculate_costs', array($this,'digitsol_calculate_costs') );
    		add_action( 'wp_ajax_nopriv_digitsol_calculate_costs', array($this,'digitsol_calculate_costs') );

    		add_action( 'wp_footer', array($this, 'checkout_script') );
        }
        public function digitsol_calculate_costs() {
            $posted = array();
        
            parse_str( $_POST['form'], $posted );
            
        
            $product_id = $posted['add-to-cart'];
            
            $product = wc_get_product( $product_id );
        
            if ( ! $product ) {
                wp_send_json( array(
                    'result' => 'ERROR',
                    'html'   => '<span class="booking-error">' . __( 'This booking is unavailable.', 'woocommerce-bookings' ) . '</span>',
                ) );
            }
        
            $booking_form     = new DigitSol_Booking_Form( $product );
            $cost             = $booking_form->calculate_booking_cost( $posted );
        
            if ( is_wp_error( $cost ) ) {
                wp_send_json( array(
                    'code' => 'ERROR',
                    'html'   => '<span class="booking-error">' . $cost->get_error_message() . '</span>',
                ) );
            }
        
            $tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
        
            if ( 'incl' === get_option( 'woocommerce_tax_display_shop' ) ) {
                if ( function_exists( 'wc_get_price_excluding_tax' ) ) {
                    $display_price = wc_get_price_including_tax( $product, array( 'price' => $cost ) );
                } else {
                    $display_price = $product->get_price_including_tax( 1, $cost );
                }
            } else {
                if ( function_exists( 'wc_get_price_excluding_tax' ) ) {
                    $display_price = wc_get_price_excluding_tax( $product, array( 'price' => $cost ) );
                } else {
                    $display_price = $product->get_price_excluding_tax( 1, $cost );
                }
            }
        
            if ( version_compare( WC_VERSION, '2.4.0', '>=' ) ) {
                $price_suffix = $product->get_price_suffix( $cost, 1 );
            } else {
                $price_suffix = $product->get_price_suffix();
            }
            // do_action( 'woocommerce_checkout_update_order_review', $_POST['form'] );
            
            wp_send_json( array(
                'code' => 'SUCCESS',
                'html'   => $display_price,
            ) );
            wp_die();
        }
        public function checkout_script() {
            if (is_cart()) : ?>
                <script>
                    var digitSol_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                    jQuery(document).ready(function($) {
					    $('.woocommerce-checkout').on('change', '.field_perseons_child, .field_perseons_adults', function( e ) {
					        
					        $form = $(this).closest('form');
					        // $form.find('.your-class-name').block({message: null, overlayCSS: {background: '#fff', backgroundSize: '16px 16px', opacity: 0.6}}).show(); // block form inner div
					        $.ajax({
					            type:       'POST',
					            url:        digitSol_ajaxurl, // e.g: var digitSol_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
					            dataType:   "html",
					            data:       {
					                action: 'digitsol_calculate_costs', // form action in php file
					                form:   $form.serialize() // getting all form data
					            },
					            success:    function( code ) {
					                
					                if ( code.charAt(0) !== '{' ) {
					                    console.log( code );
					                    code = '{' + code.split(/\{(.+)?/)[1];
					                }

					                result = $.parseJSON( code );
					                
					                if ( result.code == 'ERROR' ) {
					                    
					                   console.log("error");
					                    
					                } else if ( result.code == 'SUCCESS' ) {
					                    
					                    console.log("success");
					                    // $form.find('.your-class-name').unblock(); // unblock class
					                    
					                } else {
					                    // console.log( result );
					                    
					                }
					            },
					            error: function() {
					                
					            },
					            
					        });
					        
					    });
					    
					});
                </script>
            <?php endif;
        }
    }    
}
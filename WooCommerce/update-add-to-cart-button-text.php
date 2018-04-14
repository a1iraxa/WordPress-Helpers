<?php 

add_filter( 'woocommerce_product_single_add_to_cart_text', 'digitsol_woo_custom_cart_button_text' );  
add_filter( 'woocommerce_product_add_to_cart_text', 'digitsol_woo_custom_cart_button_text' );  

function digitsol_woo_custom_cart_button_text() {
    
    return __( 'Buy Now', 'woocommerce' );
    
}
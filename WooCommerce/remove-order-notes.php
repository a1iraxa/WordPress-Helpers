<?php 
// removes Order Notes Title - Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'digitsol_remove_order_notes' );
function digitsol_remove_order_notes( $fields ) {
    
    unset($fields['order']['order_comments']);
    
    return $fields;
    
}
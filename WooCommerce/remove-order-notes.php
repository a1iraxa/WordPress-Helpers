<?php 
// removes Order Notes Title - Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'digitsol_remove_order_notes' );
function digitsol_remove_order_notes( $fields ) {
    
    unset($fields['order']['order_comments']); // for removing
    $fields['order']['order_comments']['label'] = 'Hotel Information'; // change label
    $fields['order']['order_comments']['placeholder'] = 'Hotel Information'; // change placeholder
    $fields['order']['order_comments']['required'] = true; // make it required
    
    return $fields;
    
}
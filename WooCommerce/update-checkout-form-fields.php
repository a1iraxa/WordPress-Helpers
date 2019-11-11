<?php 
add_filter( 'woocommerce_checkout_fields' , 'digitsol_remove_checkout_fields' );
 
function digitsol_remove_checkout_fields( $fields ) {
    
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_city']);

    $fields['order']['order_comments']['placeholder'] = 'If the course has been purchased for another or multiple persons please enter their first and last name and email address of the learner(s) here.';

    return $fields;
}

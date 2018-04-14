<?php 

// Change content positions

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 11 );


add_action('woocommerce_after_single_product_summary', 'digitsol_add_buy_now_button_after_description', 1);
function digitsol_add_buy_now_button_after_description() {
    
    global $product, $post;
    
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( 'Buy Now' )
	),
    $product );
}
add_action( 'woocommerce_single_product_summary', 'add_content_after_summry', 15 );

function add_content_after_summry(){
    
    global $product, $post;
    
    $cusotm_meta = get_post_meta( $product->get_id(), '_product_offer_expiry_tab_key', true );

    echo '<p class="offer-expiry-date"> Offer Ends: '. $expiry_date .'</p>';
    
}
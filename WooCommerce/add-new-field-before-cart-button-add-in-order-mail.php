<?php 
/*Add custom field in add to cart form*/
add_action( 'woocommerce_before_add_to_cart_button', 'digitSol_update_variation_form' );
function digitSol_update_variation_form() {
	global $post;
	$terms = wp_get_post_terms( $post->ID, 'product_cat' );
	foreach ( $terms as $term ) $categories[] = $term->slug;
	if ( in_array( 'precurated', $categories ) ) {
		?>
		<textarea id="digitSol_text" class="digitSol_text" name="digitSol_text" placeholder="Enter your card message here. 350 characters max."></textarea>
		<?php	
	}
}

/*Add the field into items cart */
add_filter( 'woocommerce_add_cart_item_data', 'digitSol_text_to_cart_item', 10, 3 );
function digitSol_text_to_cart_item( $cart_item_data, $product_id, $variation_id ) {

    $card_message = $_POST['digitSol_text'];
 
    if ( empty( $card_message ) ) {
        return $cart_item_data;
    }
 
    $cart_item_data['digitSol_text'] = $card_message;
 
    return $cart_item_data;
}

/*Add into order email*/
add_action( 'woocommerce_checkout_create_order_line_item', 'digitSol_add_text_to_order_items', 10, 4 );
function digitSol_add_text_to_order_items( $item, $cart_item_key, $values, $order ) {
    if ( empty( $values['digitSol_text'] ) ) {
        return;
    }
 
    $item->add_meta_data( __( 'Card Message', 'iconic' ), $values['digitSol_text'] );
}

/*Display on cart, checkout and order view pages*/
// add_filter( 'woocommerce_get_item_data', 'digitSol_display_text_cart', 10, 2 );
function digitSol_display_text_cart( $item_data, $cart_item ) {

    if ( empty( $cart_item['digitSol_text'] ) ) {
        return $item_data;
    }
 
    $item_data[] = array(
        'key'     => __( 'Card Message', 'iconic' ),
        'value'   => wc_clean( $cart_item['digitSol_text'] ),
        'display' => '',
    );
 
    return $item_data;
}

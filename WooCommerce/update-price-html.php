<?php 
add_filter('woocommerce_get_price_html', 'update_woocommerce_price_html', 100, 2);

function update_woocommerce_price_html($price, $product)
{
    if( is_single() ){
        
        $price = str_replace( '<del>', ' <span class="price-was"><strong>Was:</strong><br><del>', $price );
        $price = str_replace( '</del>', ' </span></del>', $price );
    
        $price = str_replace( '<ins>', ' <span class="price-now"><strong>Now:</strong><br><ins>', $price );
        $price = str_replace( '</ins>', ' </span></ins>', $price );
        $price = force_balance_tags( $price );
    }
    
    return force_balance_tags( $price );
}
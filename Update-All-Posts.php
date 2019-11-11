<?php

add_action('init', 'update_all_post_content');
function update_all_post_content()
{
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'product'
    );
    $products = get_posts( $args );
    foreach($products as $product)
    {
    	$product->post_content = get_post_meta( $product->ID, $key = '_dodo_product_long_description', $single = true );
    	wp_update_post( $product );
    }
}

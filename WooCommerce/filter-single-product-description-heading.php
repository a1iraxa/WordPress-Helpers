<?php

/**
 * Change on single product panel "Product Description"
 * since it already says "features" on tab.
 */
function YOUR_PREFIX_product_description_heading() {
    return __('YOUR CUSTOM TITLE', 'woocommerce');
}

add_filter('woocommerce_product_description_heading',
'YOUR_PREFIX_product_description_heading');

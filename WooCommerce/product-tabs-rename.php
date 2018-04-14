<?php 

add_filter( 'woocommerce_product_tabs', 'digitsol_woo_rename_tabs', 98 );
function digitsol_woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'Course Details' );		// Rename the description tab

	return $tabs;

}

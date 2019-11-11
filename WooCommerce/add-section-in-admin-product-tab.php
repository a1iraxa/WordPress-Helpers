<?php 

/**
 * Create the section beneath the products tab
 **/
add_filter( 'woocommerce_get_sections_products', 'digitsol_add_section_for_expiry' );
function digitsol_add_section_for_expiry( $sections ) {
	
	$sections['digitsol_global_expiry'] = __( 'Expiry for All Products', 'woocommerce' );
	return $sections;
	
}

/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_products', 'digitsol_global_product_expiry_date', 10, 2 );

function digitsol_global_product_expiry_date( $settings, $current_section ) {
    
	/**
	 * Check the current section is product date
	 **/
	if ( $current_section == 'digitsol_global_expiry' ) {
	    
		$settings_for_expiry_date = array();
		// Add Title to the Settings
		$settings_for_expiry_date[] = array( 
		                    'name' => __( 'Offer Expiry Date', 'woocommerce' ), 
		                    'type' => 'title', 
		                    'desc' => __( 'Please select expiry date for all products.', 'woocommerce' ), 
		                    'id' => 'digitsol_global_expiry_title' 
		                    );
		                    
		// Add datapicker
		$settings_for_expiry_date[] = array(
			'name'     => __( 'Select Date', 'woocommerce' ),
			'desc_tip' => __( 'This can be overridden from each product.', 'woocommerce' ),
			'id'       => 'digitsol_global_expiry_date',
			'type'     => 'text',
			'placeholder'     => '28 September 2018',
			'desc'     => __( 'Please add expiry date in this format: <code> 28 September 2018 </code>', 'woocommerce' ),
		);
		
		$settings_for_expiry_date[] = array( 
		                    'type' => 'sectionend', 
		                    'id' => 'digitsol_global_expiry'
		                    );
		return $settings_for_expiry_date;
	
	/**
	 * If not, return the standard settings
	 **/
	} else {
		return $settings;
	}
}
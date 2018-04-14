<?php 

add_filter('wp_nav_menu_args', 'digitsol_add_filter_to_menus');

function digitsol_add_filter_to_menus($args) {
    add_filter( 'wp_setup_nav_menu_item', 'digitsol_filter_menu_items_for_images' );
    return $args;
}

function digitsol_filter_menu_items_for_images($item) {
    
    // if the menu item is taxonomy
    if( $item->type == 'taxonomy') {
	    /*
	    Check current item is:
	    	post_type { $item->object == 'prouct/post/page' }
	    	taxonomy { $item->type == 'taxonomy' }
	    	custom link { $item->type == 'custom' }
	    We can get current item object ID by { $item->object_id }
	    */
        
        // get the thumbnail id using the queried category term_id
        $thumbnail_id = get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true ); 
    
        // get the image URL
        $image = wp_get_attachment_url( $thumbnail_id );
        
        if( !empty($image) ) {
            
            $item->title = $item->title . '<span class="digitsol-menu-image"><img src="' . $image . '" alt=""></span>';
            
        }
        
    }
    
    return $item;
}

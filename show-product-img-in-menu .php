<?php 

add_filter('wp_nav_menu_args', 'digitsol_add_filter_to_menus');

function digitsol_add_filter_to_menus($args) {
    add_filter( 'wp_setup_nav_menu_item', 'digitsol_filter_menu_items_for_images' );
    return $args;
}

function digitsol_filter_menu_items_for_images($item) {
    /*
    Check current item is:
    	post_type { $item->object == 'prouct/post/page' }
    	taxonomy { $item->type == 'taxonomy' }
    	custom link { $item->type == 'custom' }
    We can get current item object ID by { $item->object_id }
    */
   
    // if the menu item is product    
    if( $item->object == 'product') {
        
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $item->object_id ), 'single-post-thumbnail' );
    
        // $image = "http://placehold.it/600/1ee8a4";
        if( !empty($image) ) {
            
            $item->title = '<span class="digitsol-menu-image"><img src="' . $image[0] . '" alt=""></span>' . $item->title;
            
        }
        
    }
    
    return $item;
}

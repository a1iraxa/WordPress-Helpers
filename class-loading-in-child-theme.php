<?php 

add_action( 'wp_loaded', 'digitsol_load_classes', 10 );

function digitsol_load_classes()
{
    /**
     * locate_template( string|array $template_names, bool $load = false, bool $require_once = true ) 
     * 
     * $template_names (string|array) (Required) Template file(s) to search for, in order.
     * 
     * $load (bool) (Optional) If true the template file will be loaded if it is found.
     * Default value: false
     * 
     * $require_once (bool) (Optional) Whether to require_once or require. Has no effect if $load is false.
     * Default value: true
     */
    
    locate_template( "inc/class/class.hall.php", TRUE, TRUE );
}


add_action( 'after_setup_theme', 'digitsol_extending_parent_classes' );

function digitsol_extending_parent_classes () {
    require_once  get_stylesheet_directory() . '/inc/admin/class.admin.hall.php';
    require_once  get_stylesheet_directory() . '/inc/shortcodes/hotel_hall/hotel_hall.php';
}
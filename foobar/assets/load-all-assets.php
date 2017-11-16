<?php 
if(!is_admin())
{
    // All css
    wp_enqueue_style( 'foobar-animate-wow', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css', array(), true);
    
    $style_sheets_name = array(
        'style',
    );

    foreach($style_sheets_name as $style){

    	$css_name = 'foobar-' . $style;
    	$css_path = FOOBAR_CONSTANT_ASSETS . 'css/' . $style . '.css';
        wp_enqueue_style( $css_name, $css_path, array(), true);

    }
    
    // All scripts

    wp_enqueue_script('jquery-ui-widget');
    $scripts_name = array(
    'custom',
    );

    foreach($scripts_name as $script){

    	$js_name = 'foobar-'. $script;
    	$js_path = FOOBAR_CONSTANT_ASSETS . 'js/' . $script .'.js';
        wp_enqueue_script( $js_name, $js_path, array('jquery'), '1.0', true );
    }
    
    wp_localize_script( 'foobar-custom', 'plugin_data', array(
          'theme_url' => get_template_directory_uri(),
          'home_url' => esc_url(home_url('/')),
          'ajax_url' => admin_url( 'admin-ajax.php' )
    ) ); 
}
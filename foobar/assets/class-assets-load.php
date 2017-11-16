<?php

/**
 * Class for managing plugin assets
 */
class FooBarAssets {

	/**
	 * Set of queried assets
	 *
	 * @var array
	 */
	static $assets = array( 'css' => array(), 'js' => array() );

	/**
	 * Constructor
	 */
	function __construct() {
		// Register
		add_action( 'wp_head',                     array( __CLASS__, 'register' ) );
		add_action( 'admin_head',                  array( __CLASS__, 'register' ) );
		
		// Enqueue
		add_action( 'wp_footer',                   array( __CLASS__, 'enqueue' ) );
		add_action( 'admin_footer',                array( __CLASS__, 'enqueue' ) );
		
	}

	/**
	 * Register assets
	 */
	public static function register() {

		$style_sheets_name = array(
	        'style',
	    );

	    foreach($style_sheets_name as $style){

	    	$css_name = 'foobar-' . $style;
	    	$css_path = FOOBAR_CONSTANT_ASSETS . 'css/' . $style . '.css';
	        wp_register_style( $css_name, $css_path, array(), true);

	    }
	    $scripts_name = array(
	    	'custom',
	    );

	    foreach($scripts_name as $script){

	    	$js_name = 'foobar-'. $script;
	    	$js_path = FOOBAR_CONSTANT_ASSETS . 'js/' . $script .'.js';
	        wp_register_script( $js_name, $js_path, array('jquery'), '1.0', true );
	    }
	    
	    wp_localize_script( 'foobar-custom', 'plugin_data', array(
	          'theme_url' => get_template_directory_uri(),
	          'home_url' => esc_url(home_url('/')),
	          'ajax_url' => admin_url( 'admin-ajax.php' )
	    ) );
	}

	/**
	 * Enqueue assets
	 */
	public static function enqueue() {
		// Get assets query and plugin object
		$assets = self::assets();
		// Enqueue stylesheets
		foreach ( $assets['css'] as $style ) wp_enqueue_style( $style );
		// Enqueue scripts
		foreach ( $assets['js'] as $script ) wp_enqueue_script( $script );
	}

	/**
	 * Add asset to the query
	 */
	public static function add( $type, $handle ) {
		// Array with handles
		if ( is_array( $handle ) ) { foreach ( $handle as $h ) self::$assets[$type][$h] = $h; }
		// Single handle
		else self::$assets[$type][$handle] = $handle;
	}

	/**
	 * Get queried assets
	 */
	public static function assets() {
		// Get assets query
		$assets = self::$assets;
		// Apply filters to assets set
		$assets['css'] = array_unique( ( array ) apply_filters( 'su/assets/css', ( array ) array_unique( $assets['css'] ) ) );
		$assets['js'] = array_unique( ( array ) apply_filters( 'su/assets/js', ( array ) array_unique( $assets['js'] ) ) );
		// Return set
		return $assets;
	}
}

new FooBarAssets;

/**
 * Helper function to add asset to the query
 *
 * @param string  $type   Asset type (css|js)
 * @param mixed   $handle Asset handle or array with handles
 */
function foobar_query_asset( $type, $handle ) {
	FooBarAssets::add( $type, $handle );
}
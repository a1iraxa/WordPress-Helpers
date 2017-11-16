<?php
/**
 * Plugin Name: Foobar
 * Version: 1.0
 * Description: Complete foobar
 * Author: al1raxa
 * Author URI: https://profiles.wordpress.org/al1raxa/
 * Text Domain: foobar
 * Domain Path: /languages/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package Foobar
 */

if ( ! class_exists( 'FooBar' ) ) {

	/**
	 * Class FooBar
	 *
	 * @class FooBar
	 * @package Foobar
	 * @author Pragmatic Mates
	 */
	final class Foobar {
		/**
		 * Initialize Foobar plugin
		 */
		public function __construct() {
			$this->constants();
			$this->libraries();
			$this->includes();
	        $this->load_plugin_textdomain();
	        add_action( 'wp_enqueue_scripts', array( $this, 'my_scripts_method' ) );
		}
		
		/**
		  * Ajax url constastants
		 */
		public function my_scripts_method() {
			// require_once FOOBAR_CONSTANT . 'assets/load-all-assets.php';
			require_once FOOBAR_CONSTANT . '/assets/class-assets-load.php';
		}

		/**
		 * Defines constastants
		 *
		 * @access public
		 * @return void
		 */
		public function constants() {
			define( 'FOOBAR_CONSTANT', plugin_dir_path( __FILE__ ) );
			define( 'FOOBAR_CONSTANT_ASSETS', FOOBAR_CONSTANT . 'assets/' );
			define( 'FOOBAR_CONSTANT_INCLUDES', FOOBAR_CONSTANT . 'includes/' );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once FOOBAR_CONSTANT . 'includes/class-user-email-send.php';
		}

		/**
		 * Loads third party libraries
		 *
		 * @access public
		 * @return void
		 */
		public static function libraries() {
			// require_once FOOBAR_CONSTANT . '/libraries/cmb2/init.php';
		}

	    /**
	     * Loads localization files
		 *
		 * @access public
		 * @return void
	     */
	    public function load_plugin_textdomain() {
		    load_plugin_textdomain( 'Foobar', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	    }
	}

	new FooBar();
}

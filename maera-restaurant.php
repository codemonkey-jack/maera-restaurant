<?php
/**
 * Plugin Name:       Maera Restaurant Shell
 * Plugin URI:        https://press.codes
 * Description:       Restaurant shell for the Maera theme.
 * Version:           1.0.0-dev
 * Author:            Brian C. Welch
 * Author URI:        http://briancwelch.com
 * Requires at least: 4.0
 * Tested up to:      4.0
 * License:           MIT
 *
 * Text Domain:       maera-restaurant
 * Domain Path:       /languages/
 *
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define Globals
define( 'MAERA_RES_VER', '1.0' );
define( 'MAERA_RES_SHELL_URL', plugins_url( '', __FILE__ ) );
define( 'MAERA_RES_SHELL_PATH', dirname( __FILE__ ) );


/**
 * Include the restaurant shell in the list of available shells.
 */
function maera_include_restaurant_shell( $shells ) {

	$shells[] = array(
		'value' => 'restaurant',
		'label' => 'Restaurant',
		'class' => 'Maera_Restaurant',
	);

	return $shells;

}
add_filter( 'maera/shells/available', 'maera_include_restaurant_shell' );


/**
* Maera Restaurant Main Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant(), Maera_Restaurant::method()
* @since         Class available since Release 1.0.0
*
*/

if ( ! class_exists( 'Maera_Restaurant' ) ) {

	class Maera_Restaurant {

		private static $instance;
		public $customizer;
		public $scripts;
		public $settings;
		public $structure;


		/**
		 * Main class constructor
		 */
		public function __construct() {

			if ( ! defined( 'MAERA_SHELL_PATH' ) ) {
				define( 'MAERA_SHELL_PATH', dirname( __FILE__ ) );
			}

			// Require or include any additional files that may be needed.
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Customizer.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Scripts.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Structure.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Data.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_PostTypes.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Widget_Areas.php');
			require_once( __DIR__ . '/includes/class-Maera_Restaurant_Meta_Box.php');

			// Instantiate additional classes.
			$this->customizer       = new Maera_Restaurant_Customizer();
			$this->scripts          = new Maera_Restaurant_Scripts();
			$this->structure        = new Maera_Restaurant_Structure();
			$this->data             = new Maera_Restaurant_Data();
			$this->posttype         = new Maera_Restaurant_PostTypes();
			$this->widgetareas      = new Maera_Restaurant_Widget_Areas();
			$this->metabox          = new Maera_Restaurant_Widget_Box();

			// Add Actions
			add_action( 'after_setup_theme', array( $this, 'required_plugins' ) );

			// Add Filters
			// NULL

			// Theme Supports
			add_theme_support( 'tonesque' );
			add_theme_support( 'site-logo' );
			add_theme_support( 'infinite-scroll', array(
				'type'      => 'click',
				'container' => 'content',
				'footer'    => false,
			) );

		}


		/**
		 * Singleton
		 * @return self::$instance
		 */
		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}


		/**
		* Build the array of required plugins.
		* You can use the 'maera/required_plugins' filter to add or remove plugins.
		*/
		function required_plugins( $plugins = array() ) {
			if ( ! $plugins || empty( $plugins ) ) {
				$plugins = array();
			}

			$plugins[] = array(
				'name' => 'Restaurant',
				'file' => 'restaurant.php',
				'slug' => 'restaurant',
			);

			$plugins = new Maera_Required_Plugins( $plugins );
		}


		// End Methods
	}  // End Class
}     // End If


/**
 * Licensing handler
 */
function maera_restaurant_licensing() {

	if ( is_admin() && class_exists( 'Maera_Updater' ) ) {
		$maera_res_license = new Maera_Updater( 'plugin', __FILE__, 'Maera Restaurant Shell', MAERA_RES_VER, '@briancwelch' );
	}

}
add_action( 'init', 'maera_restaurant_licensing' );



/**
 * Register the slider widget.
 */

include_once( __DIR__ . '/includes/class-Maera_Restaurant_Slider_Widget.php');

function maera_res_slider_widgets() {
	register_widget( 'Maera_Restaurant_Slider_Widget' );
}
add_action( 'widgets_init', 'maera_res_slider_widgets' );

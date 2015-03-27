<?php
/**
 * Plugin Name:       Maera Restaurant Shell
 * Plugin URI:        https://press.codes
 * Description:       Restaurant shell for the Maera theme.
 * Version:           0.1.0
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
define( 'MAERA_RES_VER', '0.1.0' );
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
 * Plugin textdomains
 */
function maera_restaurant_texdomain() {
	$lang_dir    = get_template_directory() . '/languages';
	$custom_path = WP_LANG_DIR . '/maera-' . get_locale() . '.mo';
	if ( file_exists( $custom_path ) ) {
		load_plugin_textdomain( 'maera-restaurant', $custom_path );
	} else {
		load_plugin_textdomain( 'maera-restaurant', false, $lang_dir );
	}
}
add_action( 'plugins_loaded', 'maera_restaurant_texdomain' );


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
		public $structure;
		public $data;
		public $styles;
		public $posttype;
		public $widgetareas;
		public $taxonomies;

		/**
		 * Main Class Constructor
		 */
		public function __construct() {

			if ( ! defined( 'MAERA_SHELL_PATH' ) ) {
				define( 'MAERA_SHELL_PATH', dirname( __FILE__ ) );
			}

			// Require or include any additional files that may be needed.
			require_once( __DIR__ . '/includes/class-maera-restaurant-customizer.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-scripts.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-structure.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-data.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-styles.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-posttypes.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-widget-areas.php');
			require_once( __DIR__ . '/includes/class-maera-restaurant-taxonomies.php');

			// Instantiate additional classes.
			$this->customizer       = new Maera_Restaurant_Customizer();
			$this->scripts          = new Maera_Restaurant_Scripts();
			$this->structure        = new Maera_Restaurant_Structure();
			$this->data             = new Maera_Restaurant_Data();
			$this->styles           = new Maera_Restaurant_Styles();
			$this->posttype         = new Maera_Restaurant_PostTypes();
			$this->widgetareas      = new Maera_Restaurant_Widget_Areas();
			$this->taxonomies       = new Maera_Restaurant_Taxonomies();

			// Add Actions
			add_action( 'after_setup_theme', array( $this, 'required_plugins' ) );
			add_action( 'do_meta_boxes', array( $this, 'slides_image_box' ) );

			// Add Filters
			add_filter( 'kirki/config', array( $this, 'customizer_config' ) );

			// Theme Supports
			add_theme_support( 'kirki' );
			add_theme_support( 'restaurant' );
			add_theme_support( 'tonesque' );
			add_theme_support( 'site-logo' );

			if ( '1' == get_theme_mod( 'enable_breadcrumbs' , '1' ) ) {
				add_theme_support( 'breadcrumbs' );
			}
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
		 * Customize Kirki
		 * @return [type] [description]
		 */
		function customizer_config() {

			$colors = Maera_Restaurant_Styles::palette_colors();

			$args = array(
				'stylesheet_id' => 'maera-res',
				'color_active'  => $colors[2],
				'color_light'   => $colors[0],
				'color_select'  => $colors[1],
				'color_accent'  => $colors[3],
				'color_back'    => $colors[4],
				'logo_image'    => MAERA_RES_SHELL_URL . '/assets/img/maera_restaurant_logo.png',
				'description'   => '<p>The Maera restaurant shell allows you to easily create restaurant sites with ease and includes a wealth of customization options.</p>',
			);
			return $args;
		}


		/**
		 * Build the array of required plugins
		 * You can use the 'maera/required_plugins' filter to add or remove plugins.
		 * @param  array  $plugins [description]
		 * @return [type]          [description]
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

			// Check to see if the user has ACF Pro installed, if not, require the free version.
			if ( ! class_exists( 'acf_pro' ) ) {
				$plugins[] = array(
					'name' => 'Advanced Custom Fields',
					'file' => 'acf.php',
					'slug' => 'advanced-custom-fields',
				);
			}

			$plugins = new Maera_Required_Plugins( $plugins );
		}


		/**
		 * Move the featured image box from the side to the main area when editing slides.
		 * @return [type] [description]
		 */
		function slides_image_box() {

			$screen = get_current_screen();

			if ( 'slide' == $screen->post_type ) {
				remove_meta_box( 'postimagediv', 'slide', 'side' );
				add_meta_box( 'postimagediv', __( 'Slide - Background Image' ), 'post_thumbnail_meta_box', 'slide', 'normal', 'high' );
			}
		}

		// End Methods
	} // End Class
} // End if


/**
 * Licensing handler.
 * @return [type] [description]
 */
function maera_restaurant_licensing() {

	if ( is_admin() && class_exists( 'Maera_Updater' ) ) {
		$maera_res_license = new Maera_Updater( 'plugin', __FILE__, 'Maera Restaurant Shell', MAERA_RES_VER, '@brianwelch' );
	}
}
add_action( 'init', 'maera_restaurant_licensing' );


/**
 * Load Maera Restaurant widgets.
 */
include_once( __DIR__ . '/includes/widgets/class-maera-restaurant-slider-widget.php');
include_once( __DIR__ . '/includes/widgets/class-maera-restaurant-menu-widget.php');


/**
 * Register the slider widget.
 * @return [type] [description]
 */
function maera_res_slider_widgets() {

	register_widget( 'Maera_Restaurant_Slider_Widget' );
}
add_action( 'widgets_init', 'maera_res_slider_widgets' );


/**
 * Register the menu widget.
 * @return [type] [description]
 */
function maera_res_menu_widgets() {

	register_widget( 'Maera_Restaurant_Menu_Widget' );
}
add_action( 'widgets_init', 'maera_res_menu_widgets' );


/**
 * Add the secondary slider image to Advanced Custom Fields
 */
if ( function_exists( 'register_field_group' ) ){
	register_field_group( array(
		'id' => 'acf_slider-second-image-1',
		'title' => 'Slider - Second Image',
		'fields' => array(
			array(
				'key' => 'field_54ff77a3c04fb',
				'label' => 'Slider - Second Image',
				'name' => 'slider_-_second_image',
				'type' => 'image',
				'instructions' => 'Enter the secondary image for the slider.	This is the image that is displayed over the background.',
				'required' => 1,
				'save_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array(
				0 => 'comments',
				1 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

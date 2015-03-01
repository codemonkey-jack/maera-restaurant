<?php

/**
* Maera Restaurant Scripts Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Scripts(), Maera_Restaurant_Scripts::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Scripts' ) ) {

	class Maera_Restaurant_Scripts {

		/**
		 * Class Constructor
		 */
		function __construct() {

			// Add Actions
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 100 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 100 );

			// Add Filters
			// NULL

		}


		/**
		 * Add any necessary scripts and stylesheets.
		 * @return [type] [description]
		 */
		function scripts() {

			// CSS
			// Load Bootstrap.
			wp_register_style( 'bootstrap', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/bootstrap.min.css' );
			wp_enqueue_style( 'bootstrap' );

			// Load FontAwesome.
			wp_register_style( 'fontawesome', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/font-awesome.min.css' );
			wp_enqueue_style( 'fontawesome' );

			// Load Animations
			wp_register_style( 'animate', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/animate.min.css' );
			wp_enqueue_style( 'animate' );

			// Load App CSS.
			wp_register_style( 'maera-res', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/app.css' );
			wp_enqueue_style( 'maera-res' );


			// Javascript
			// Load Bootstrap.
			wp_register_script( 'bootstrap', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/bootstrap.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'bootstrap' );

			// Load jQuery UI.
			wp_register_script( 'jquery_ui', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/jquery-ui.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'jquery_ui' );

			// Isotope
			wp_register_script( 'isotope', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/isotope.pkgd.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'isotope' );

			// Load App JS
			wp_register_script( 'maera-res', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/app.js', array('jquery'), time(), false );
			wp_enqueue_script( 'maera-res' );

		}

		/**
		 * Add admin area scripts.
		 */
		function admin_scripts() {

			// Add any additional scripts to the WordPress Admin area here.

		}

		// End Methods
	}  // End Class
}     // End If

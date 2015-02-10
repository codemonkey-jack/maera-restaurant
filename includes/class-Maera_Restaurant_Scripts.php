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

			// Load Bootstrap from the CDN for now.
			wp_register_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css' );
			wp_enqueue_style( 'bootstrap' );

			// Ugly.  Change to an appropriate method using the compiler before release.
			if ( 1 == get_theme_mod( 'gradients' , '0' ) ) {
				wp_register_style( 'bootstrap-theme', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css' );
				wp_enqueue_style( 'bootstrap-theme' );
			}

			// Load FontAwesome from the CDN for now.
			wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
			wp_enqueue_style( 'fontawesome' );

			wp_register_style( 'maera-res', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/app.css' );
			wp_enqueue_style( 'maera-res' );

			wp_register_style( 'animate', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/vendor/animate.css' );
			wp_enqueue_style( 'animate' );

			// Javascript

			// Load Bootstrap JS from the CDN for now.
			wp_register_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'bootstrap' );

			// Load jQuery UI from the CDN for now.
			wp_register_script( 'jquery_ui', '//code.jquery.com/ui/1.11.2/jquery-ui.js', array('jquery'), time(), false );
			wp_enqueue_script( 'jquery_ui' );

			// May end up removing this
			wp_register_script( 'smoothscroll', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/vendor/smooth-scroll.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'smoothscroll' );

			// Filterable.js
			wp_register_script( 'filterable', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/vendor/filterable.js', array('jquery'), time(), false );
			wp_enqueue_script( 'filterable' );

			wp_register_script( 'maera-res', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/app.js', array('jquery'), time(), false );
			wp_enqueue_script( 'maera-res' );

		}

		/**
		 * Add admin area scripts.
		 * We must ensure that certain metaboxes we add to the Restaurant plugin are required and validated.
		 */
		function admin_scripts() {

			wp_register_style( 'maera-res', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/css/admin.css' );
			wp_enqueue_style( 'maera-res' );

			// Load jQuery Validate from the CDN.
			wp_register_script( 'jquery_validate', '//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js', array('jquery'), time(), false );
			wp_enqueue_script( 'jquery_validate' );

			wp_register_script( 'maera_res_admin', trailingslashit( MAERA_RES_SHELL_URL ) . 'assets/js/admin.js', array('jquery'), time(), false );
			wp_enqueue_script( 'maera_res_admin' );

		}


		// End Methods
	}  // End Class
}     // End If

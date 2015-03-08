<?php

/**
* Maera Restaurant Structure Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Structure(), Maera_Restaurant_Structure::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Structure' ) ) {

	class Maera_Restaurant_Structure {


		/**
		 * Class Constructor
		 */
		function __construct() {

			// Add actions.
			// NULL

			// Add filters.
			add_filter( 'maera/wrapper/class', array( $this, 'site_layout' ) );
			add_filter( 'maera/section_class/content', array( $this, 'page_layout' ) );

		}


		/**
		 * Add and remove classes to the main wrapper.
		 */
		function site_layout( $classes ) {
			$site_layout = get_theme_mod( 'site_layout', 'wide' );
			if ( 'boxed' == $site_layout ) {
				$classes = 'container boxed';
			} else {
				$classes = 'container-fluid wide';
			}

			return $classes;
		}


		/**
		 * Add and remove classes to the content wrapper.
		 */
		function page_layout( $classes ) {
			$page_layout = get_theme_mod( 'page_layout', 0 );
			if ( 1 == $page_layout ) {
				$classes = 'col-md-8';
			} else {
				$classes = 'col-md-12';
			}
			return $classes;
		}

		// End Methods
	}  // End Class
}     // End If

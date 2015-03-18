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
			add_filter( 'maera/section_class/content', array( $this, 'page_layout' ) );
			add_filter( 'maera/restaurant/menu_class', array( $this, 'menu_layout' ) );

		}

		/**
		 * Change the page class based on layout selected.
		 * @param  [type] $classes [description]
		 * @return [type]          [description]
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

		/**
		 * Change the item classes on the menu page based on page layout.
		 * If the layout doesn't have a sidebar, change the items to 2x1; else 1x1.
		 * @param  [type] $classes [description]
		 * @return [type]          [description]
		 */
		function menu_layout( $classes ) {
			$page_layout = get_theme_mod( 'page_layout', 0 );
			if ( 1 == $page_layout ) {
				$classes = 'col-md-12';
			} else {
				$classes = 'col-md-6';
			}
			return $classes;
		}

		// End Methods
	}  // End Class
}     // End If

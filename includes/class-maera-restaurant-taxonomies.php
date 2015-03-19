<?php

/**
* Maera Restaurant Taxonomies
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Taxonomies(), Maera_Restaurant_Taxonomies::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Taxonomies' ) ) {

	class Maera_Restaurant_Taxonomies {


		/**
		 * Class Constructor
		 */
		public function __construct() {

			// Add Actions
			add_action( 'init', array( $this, 'restaurant_item_menu_section_taxonomy' ) );

			// Add Filters
			// NULL
		}


		/**
		 * Add menu section taxonomies to Restaurant.
		 * @return [type] [description]
		 */
		function restaurant_item_menu_section_taxonomy() {

			$labels = array(
				'name'                       => _x( 'Menu Sections', 'Taxonomy General Name', 'maera-restaurant' ),
				'singular_name'              => _x( 'Menu Section', 'Taxonomy Singular Name', 'maera-restaurant' ),
				'menu_name'                  => __( 'Menu Sections', 'maera-restaurant' ),
				'all_items'                  => __( 'All Menu Sections', 'maera-restaurant' ),
				'parent_item'                => __( 'Parent Menu Sections', 'maera-restaurant' ),
				'parent_item_colon'          => __( 'Parent Menu Section:', 'maera-restaurant' ),
				'new_item_name'              => __( 'New Menu Section Name', 'maera-restaurant' ),
				'add_new_item'               => __( 'Add New Menu Section', 'maera-restaurant' ),
				'edit_item'                  => __( 'Edit Menu Section', 'maera-restaurant' ),
				'update_item'                => __( 'Update Menu Section', 'maera-restaurant' ),
				'separate_items_with_commas' => __( 'Separate Menu Sections with commas', 'maera-restaurant' ),
				'search_items'               => __( 'Search Menu Sections', 'maera-restaurant' ),
				'add_or_remove_items'        => __( 'Add or remove Menu Sections', 'maera-restaurant' ),
				'choose_from_most_used'      => __( 'Choose from the most used Menu Sections', 'maera-restaurant' ),
				'not_found'                  => __( 'Menu Section Not Found', 'maera-restaurant' ),
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => false,
			);
			register_taxonomy( 'restaurant_item_menu_section', array( 'restaurant_item' ), $args );
		}

		// End Methods
	} // End Class
} // End if

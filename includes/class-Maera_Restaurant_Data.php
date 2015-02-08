<?php

/**
* Maera Restaurant Data Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch. Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Data(), Maera_Restaurant_Data::method()
* @since         Class available since Release 1.0.0
*
* Add any data methods needed to this class.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Data' ) ) {

	class Maera_Restaurant_Data {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			// Add actions.

			// Add filters.
			add_filter( 'maera/timber/context', array( $this, 'maera_res_context' ) );
		}


		/**
		* Modify Timber global context
		*/
		function maera_res_context( $context ) {

			$args = array(
				'post_type' => 'slide',
			);

			$context['slides'] = Timber::get_posts( $args );

			return $context;
		}



		/**
		 * Retrieive a list of currencies to use.
		 * @param  [type] $currency_url [description]
		 * @return [type]          [description]
		 * @since  1.0.0
		 */
		public static function get_currencies() {

			$currencies_url = 'http://www.freecurrencyconverterapi.com/api/v3/currencies';

			$currencies = json_decode( file_get_contents( $currencies_url ), true );

			$currencylist = array();

			foreach ( $currencies['results'] as $currency ) {
				$currencylist = array(
					'id'      => $currency['id'],
					'name'    => $currency['currencyName'],
					'symbol'  => $currency['currencySymbol'],
				);
			}

			print_r( $currencylist ); // Debug
		}


		/**
		 * Get the list of categories to return to the customizer.
		 * @return [type] [description]
		 * Original method by @arisath
		 */
		public function get_categories() {

			$cats = array();
			$cats['all'] = __( 'All Categories', 'maera-restaurant' );

			$args = array(
				'type'                     => 'post',
				'orderby'                  => 'count',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 0,
				'number'                   => 20,
				'taxonomy'                 => 'category',
				'pad_counts'               => false,
			);

			$categories = get_categories( $args );

			foreach ( $categories as $category ) {
				$cats[$category->term_id] = $category->name;
			}

			return $cats;

		}


		// End Methods
	} // End Class
} // End if

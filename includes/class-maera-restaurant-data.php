<?php

/**
* Maera Restaurant Data Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Data(), Maera_Restaurant_Data::method()
* @since         Class available since Release 1.0.0
*
* Add any data methods needed to this class.
* Also include any WordPress actions or filters that do not apply to other classes.
* This file's purpose is to control how all data is handled.
*
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
			add_action( 'admin_head', array( $this, 'maera_res_live_rename_quotes' ) );

			// Add filters.
			add_filter( 'maera/timber/context', array( $this, 'maera_res_context' ) );
			add_filter( 'esc_html', array( $this, 'maera_res_rename_quotes' ) );
		}


		/**
		* Modify Timber global context
		*/
		function maera_res_context( $context ) {

			$slide_args = array(
				'post_type' => 'slide',
			);

			$restaurant_args = array(
				'post_type' => 'restaurant_item',
				'tax_query' => 'restaurant_tag',
			);

			$context['slides']                    = Timber::get_posts( $slide_args );
			$context['restaurant_items']          = Timber::get_posts( $restaurant_args );
			$context['menu_sections']             = Timber::get_terms( 'restaurant_item_menu_section' );
			$context['sidebar']['section_1']      = Timber::get_widgets( 'section_1' );
			$context['sidebar']['section_2']      = Timber::get_widgets( 'section_2' );
			$context['sidebar']['section_3']      = Timber::get_widgets( 'section_3' );
			$context['sidebar']['section_4']      = Timber::get_widgets( 'section_4' );
			$context['sidebar']['section_5']      = Timber::get_widgets( 'section_5' );
			$context['sidebar']['footer']         = Timber::get_widgets( 'footer' );

			return $context;
		}

		/**
		 * Return an array of all available currencies.
		 * @return [type] [description]
		 */
		public static function get_currencies() {
			// Get the list of fonts from our json file and convert to an array
			$currencies = json_decode( file_get_contents( MAERA_RES_SHELL_URL . '/assets/json/currencies.json' ), true );
			$currencytype = array();
			foreach ( $currencies['results'] as $currency ) {
				$currencytype[] = array(
					'name'   => $currency['currencyName'],
					'id'     => $currency['id'],
					'symbol' => $currency['currencySymbol'],
				);
			}
			return $currencytype;
		}

		/**
		 * Package the currencies together for use in the customizer.
		 * @return [type] [description]
		 */
		public static function get_currency_choices() {
			$currencies   = self::get_currencies();
			$choices = array();
			foreach ( $currencies as $key => $currency ) {
				$choices[ $key ] = $currency['name'];
			}
			return $choices;
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
				$cats[ $category->term_id ] = $category->name;
			}

			return $cats;

		}


		/**
		 * Rename "Quotes" post type to "Testimonials"
		 * @param  [type] $safe_text [description]
		 * @return [type]            [description]
		 */
		function maera_res_rename_quotes( $type_text ) {
			if ( 'Quote' == $type_text ){
				return 'Testimonials';
			}

			return $type_text;
		}


		/**
		 * Live rename "Quotes" post type to "Testimonials"
		 * @return [type] [description]
		 */
		function maera_res_live_rename_quotes() {
			global $current_screen;

			if ( 'edit-post' == $current_screen->id ) { ?>
				<script type="text/javascript">
				jQuery('document').ready(function() {

					jQuery("span.post-state-format").each(function() {
						if ( jQuery(this).text() == "Quote" )
							jQuery(this).text("Testimonial");
					});

				});
				</script>
		<?php }
		}

		// End Methods
	} // End Class
} // End if

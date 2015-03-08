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

			// $restaurant_args = array(
			// 	'post_type'        => 'restaurant_item',
			// 	'posts_per_page'   => -1,
			// );

			$context['currency']                  = get_theme_mod( 'currency', '&#36;' );
			// $context['posts']                     = Timber::get_posts( $restaurant_args );
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

			$currencies = array(
				'&#36;'     => __( 'US Dollars (&#36;)', 'maera-restaurant' ),
				'&euro;'    => __( 'Euros (&euro;)', 'maera-restaurant' ),
				'&pound;'   => __( 'Pounds Sterling (&pound;)', 'maera-restaurant' ),
				'AUD'       => __( 'Australian Dollars (&#36;)', 'maera-restaurant' ),
				'R&#36;'    => __( 'Brazilian Real (R&#36;)', 'maera-restaurant' ),
				'CAD'       => __( 'Canadian Dollars (&#36;)', 'maera-restaurant' ),
				'CZK'       => __( 'Czech Koruna', 'maera-restaurant' ),
				'DKK'       => __( 'Danish Krone', 'maera-restaurant' ),
				'HKD'       => __( 'Hong Kong Dollar (&#36;)', 'maera-restaurant' ),
				'HUF'       => __( 'Hungarian Forint', 'maera-restaurant' ),
				'&#8362;'   => __( 'Israeli Shekel (&#8362;)', 'maera-restaurant' ),
				'&yen;'     => __( 'Japanese Yen (&yen;)', 'maera-restaurant' ),
				'MYR'       => __( 'Malaysian Ringgits', 'maera-restaurant' ),
				'MXN'       => __( 'Mexican Peso (&#36;)', 'maera-restaurant' ),
				'NZD'       => __( 'New Zealand Dollar (&#36;)', 'maera-restaurant' ),
				'NOK'       => __( 'Norwegian Krone', 'maera-restaurant' ),
				'PHP'       => __( 'Philippine Pesos', 'maera-restaurant' ),
				'PLN'       => __( 'Polish Zloty', 'maera-restaurant' ),
				'SGD'       => __( 'Singapore Dollar (&#36;)', 'maera-restaurant' ),
				'SEK'       => __( 'Swedish Krona', 'maera-restaurant' ),
				'CHF'       => __( 'Swiss Franc', 'maera-restaurant' ),
				'TWD'       => __( 'Taiwan New Dollars', 'maera-restaurant' ),
				'&#3647;'   => __( 'Thai Baht (&#3647;)', 'maera-restaurant' ),
				'&#8377;'   => __( 'Indian Rupee (&#8377;)', 'maera-restaurant' ),
				'&#8378;'   => __( 'Turkish Lira (&#8378;)', 'maera-restaurant' ),
				'&#65020;'  => __( 'Iranian Rial (&#65020;)', 'maera-restaurant' ),
				'RUB'       => __( 'Russian Rubles', 'maera-restaurant' )
				);

			return $currencies;
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
				'type'           => 'post',
				'orderby'        => 'count',
				'order'          => 'ASC',
				'hide_empty'     => 1,
				'hierarchical'   => 0,
				'number'         => 20,
				'taxonomy'       => 'category',
				'pad_counts'     => false,
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

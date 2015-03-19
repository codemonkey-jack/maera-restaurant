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
		 * Modify the Timber global context
		 * @param  [type] $context [description]
		 * @return [type]          [description]
		 */
		function maera_res_context( $context ) {

			$context['currency']               = get_theme_mod( 'currency', '&#36;' );
			$context['facebook_link']          = get_theme_mod( 'facebook_link', 'http://facebook.com/' );
			$context['twitter_link']           = get_theme_mod( 'twitter_link', 'http://twitter.com/' );
			$context['googleplus_link']        = get_theme_mod( 'googleplus_link', 'http://plus.google.com/' );
			$context['youtube_link']           = get_theme_mod( 'youtube_link', 'http://youtube.com' );

			$context['menu_sections']          = Timber::get_terms( 'restaurant_item_menu_section' );
			$context['sidebar']['section_1']   = Timber::get_widgets( 'section_1' );
			$context['sidebar']['section_2']   = Timber::get_widgets( 'section_2' );
			$context['sidebar']['section_3']   = Timber::get_widgets( 'section_3' );
			$context['sidebar']['section_4']   = Timber::get_widgets( 'section_4' );
			$context['sidebar']['section_5']   = Timber::get_widgets( 'section_5' );
			$context['sidebar']['footer']      = Timber::get_widgets( 'footer' );

			if ( is_post_type_archive( 'restaurant_item' ) && rp_is_restaurant() ) {
				$query_args = array(
					'post_type'      => 'restaurant_item',
					'posts_per_page' => 999,  // We want to display every single menu item and let the user categorically filter them.
					'order'          => get_theme_mod( 'restaurant_order', 'ASC' ),
					'order_by'       => get_theme_mod( 'restaurant_order_by', 'ID' ),
				);

				$context['menu_item']    = Timber::query_post();
				$context['menu_items']   = Timber::get_posts( $query_args );

			}

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

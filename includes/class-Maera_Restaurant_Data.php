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
			$context['sidebar']['section_1']      = Timber::get_widgets( 'section_1' );
			$context['sidebar']['section_2']      = Timber::get_widgets( 'section_2' );
			$context['sidebar']['section_3']      = Timber::get_widgets( 'section_3' );
			$context['sidebar']['section_4']      = Timber::get_widgets( 'section_4' );
			$context['sidebar']['section_5']      = Timber::get_widgets( 'section_5' );
			$context['default_featured_image']    = TimberHelper::function_wrapper( 'res_default_featured_image' );

			return $context;
		}


		/**
		 * Retrieive a list of currencies to use.
		 * @param  [type] $currency_url [description]
		 * @return [type]          [description]
		 * @since  1.0.0
		 * @todo   Broken.  Mustfix.
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


		/**
		 * Specify widget widths classes.
		 * @return [type] [description]
		 */
		public static function widget_widths() {
			$depths = array(
				'1'  => array( 'label' => '1/12', 'classes' => 'col-md-1' ),
				'2'  => array( 'label' => '2/12', 'classes' => 'col-md-2' ),
				'3'  => array( 'label' => '3/12', 'classes' => 'col-md-3' ),
				'4'  => array( 'label' => '4/12', 'classes' => 'col-md-4' ),
				'5'  => array( 'label' => '5/12', 'classes' => 'col-md-5' ),
				'6'  => array( 'label' => '6/12', 'classes' => 'col-md-6' ),
				'7'  => array( 'label' => '7/12', 'classes' => 'col-md-7' ),
				'8'  => array( 'label' => '8/12', 'classes' => 'col-md-8' ),
				'9'  => array( 'label' => '9/12', 'classes' => 'col-md-9' ),
				'10' => array( 'label' => '10/12', 'classes' => 'col-md-10' ),
				'11' => array( 'label' => '11/12', 'classes' => 'col-md-11' ),
				'12' => array( 'label' => '12/12', 'classes' => 'col-md-12' ),
				'13' => array( 'label' => 'Full Width', 'classes' => '.container-full' ),
			);

			return $depths;
		}


		// End Methods
	} // End Class
} // End if

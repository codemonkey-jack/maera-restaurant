<?php

/**
* Maera Restaurant Styles Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Styles(), Maera_Restaurant_Styles::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Styles' ) ) {

	class Maera_Restaurant_Styles {


		/**
		 * Class Constructor
		 */
		function __construct() {

			// Add actions.
			add_action( 'wp_enqueue_scripts', array( $this, 'inline_css' ), 101 );

			// Add filters.
			// NULL
		}


		/**
		 * Inline CSS
		 * @since  1.0.0
		 */
		function inline_css() {

			if ( 1 == get_theme_mod( 'color_calc', 0 ) ) {

				// Set variables for Tonesque
				$section1_src    = get_theme_mod( 'section_1_background_image', '' );
				$section2_src    = get_theme_mod( 'section_2_background_image', '' );
				$section3_src    = get_theme_mod( 'section_3_background_image', '' );
				$section4_src    = get_theme_mod( 'section_4_background_image', '' );
				$section5_src    = get_theme_mod( 'section_5_background_image', '' );
				$body_src        = get_theme_mod( 'body_background_image', '' );
				$content_src     = get_theme_mod( 'content_background_image', '' );

				// Set variables for Jetpack Color
				$navbar_color    = get_theme_mod( 'navbar_color', '#ffffff' );
				$section1_color  = get_theme_mod( 'section_1_background_color', '#ffffff' );
				$section2_color  = get_theme_mod( 'section_2_background_color', '#ffffff' );
				$section3_color  = get_theme_mod( 'section_3_background_color', '#ffffff' );
				$section4_color  = get_theme_mod( 'section_4_background_color', '#ffffff' );
				$section5_color  = get_theme_mod( 'section_5_background_color', '#ffffff' );
				$body_color      = get_theme_mod( 'body_background_color', '#ffffff' );
				$content_color   = get_theme_mod( 'content_background_color', '#ffffff' );

				// Create a Tonesque instance for each section background
				$section1_tone   = new Tonesque( $section1_src );
				$section2_tone   = new Tonesque( $section2_src );
				$section3_tone   = new Tonesque( $section3_src );
				$section4_tone   = new Tonesque( $section4_src );
				$section5_tone   = new Tonesque( $section5_src );
				$body_tone       = new Tonesque( $body_src );
				$content_tone    = new Tonesque( $content_src );

				// Create a Jetpack Color instance for each section background that does not have a background image set.
				$navbar_jet      = new Jetpack_Color( $navbar_color );
				$section1_jet    = new Jetpack_Color( $section1_color );
				$section2_jet    = new Jetpack_Color( $section2_color );
				$section3_jet    = new Jetpack_Color( $section3_color );
				$section4_jet    = new Jetpack_Color( $section4_color );
				$section5_jet    = new Jetpack_Color( $section5_color );
				$body_jet        = new Jetpack_Color( $body_color );
				$content_jet     = new Jetpack_Color( $content_color );

				if ( $section1_src ) {
					$section1_bg         = $section1_tone->color();
					$section1_font       = $section1_tone->contrast();
					$section1_link       = $section1_tone->contrast();
					$section1_font_calc  = new Jetpack_Color( $section1_bg );
					$section1_link_calc  = new Jetpack_Color( $section1_bg );
					$section1_font_color = '#' . $section1_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$section1_link_color = '#' . $section1_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$section1_font_color = '#' . $section1_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$section1_link_color = '#' . $section1_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $section2_src ) {
					$section2_bg         = $section2_tone->color();
					$section2_font       = $section2_tone->contrast();
					$section2_link       = $section2_tone->contrast();
					$section2_font_calc  = new Jetpack_Color( $section2_bg );
					$section2_link_calc  = new Jetpack_Color( $section2_bg );
					$section2_font_color = '#' . $section2_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$section2_link_color = '#' . $section2_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$section2_font_color = '#' . $section2_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$section2_link_color = '#' . $section2_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $section3_src ) {
					$section3_bg         = $section3_tone->color();
					$section3_font       = $section3_tone->contrast();
					$section3_link       = $section3_tone->contrast();
					$section3_font_calc  = new Jetpack_Color( $section3_bg );
					$section3_link_calc  = new Jetpack_Color( $section3_bg );
					$section3_font_color = '#' . $section3_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$section3_link_color = '#' . $section3_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$section3_font_color = '#' . $section3_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$section3_link_color = '#' . $section3_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $section4_src ) {
					$section4_bg         = $section4_tone->color();
					$section4_font       = $section4_tone->contrast();
					$section4_link       = $section4_tone->contrast();
					$section4_font_calc  = new Jetpack_Color( $section4_bg );
					$section4_link_calc  = new Jetpack_Color( $section4_bg );
					$section4_font_color = '#' . $section4_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$section4_link_color = '#' . $section4_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$section4_font_color = '#' . $section4_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$section4_link_color = '#' . $section4_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $section5_src ) {
					$section5_bg         = $section5_tone->color();
					$section5_font       = $section5_tone->contrast();
					$section5_link       = $section5_tone->contrast();
					$section5_font_calc  = new Jetpack_Color( $section5_bg );
					$section5_link_calc  = new Jetpack_Color( $section5_bg );
					$section5_font_color = '#' . $section5_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$section5_link_color = '#' . $section5_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$section5_font_color = '#' . $section5_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$section5_link_color = '#' . $section5_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $body_src ) {
					$body_bg             = $body_tone->color();
					$body_font           = $body_tone->contrast();
					$body_link           = $body_tone->contrast();
					$body_font_calc      = new Jetpack_Color( $body_bg );
					$body_link_calc      = new Jetpack_Color( $body_bg );
					$body_font_color     = '#' . $body_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$body_link_color     = '#' . $body_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$body_font_color     = '#' . $body_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$body_link_color     = '#' . $body_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				if ( $content_src ) {
					$content_bg          = $content_tone->color();
					$content_font        = $content_tone->contrast();
					$content_link        = $content_tone->contrast();
					$content_font_calc   = new Jetpack_Color( $content_bg );
					$content_link_calc   = new Jetpack_Color( $content_bg );
					$content_font_color  = '#' . $content_font_calc->getGrayscaleContrastingColor( 10 )->toHex();
					$content_link_color  = '#' . $content_link_calc->getGrayscaleContrastingColor( 10 )->toHex();
				} else {
					$content_font_color   = '#' . $content_jet->getGrayscaleContrastingColor( 10 )->toHex();
					$content_link_color   = '#' . $content_jet->getGrayscaleContrastingColor( 10 )->toHex();
				}

				$navbar_font_color       = '#' . $navbar_jet->getGrayscaleContrastingColor( 10 )->toHex();
				$navbar_link_color       = '#' . $navbar_jet->getGrayscaleContrastingColor( 10 )->toHex();
				$navbar_border_color     = '#' . $navbar_jet->getGrayscaleContrastingColor( 1 )->toHex();

				//CSS Styles
				$style = '';

				$style .= '.navbar-default{';
				$style .= 'border-color: '. $navbar_border_color .';';
				$style .= '}';

				$style .= '.navbar-default .navbar-nav > li{';
				$style .= 'color: '. $navbar_font_color .' !important;';
				$style .= '}';

				$style .= '.navbar-default .navbar-nav > li > a{';
				$style .= 'color: '. $navbar_link_color .' !important;';
				$style .= '}';

				$style .= '#section_1 h1, #section_1 h2, #section_1 h3, #section_1 h4, #section_1 h5, #section_1 h6, #section_1 p{';
				$style .= 'color: '. $section1_font_color .';';
				$style .= '}';

				$style .= '#section_1 a{';
				$style .= 'color: '. $section1_link_color .';';
				$style .= '}';

				$style .= '#section_2 h1, #section_2 h2, #section_2 h3, #section_2 h4, #section_2 h5, #section_2 h6, #section_2 p{';
				$style .= 'color: '. $section2_font_color .';';
				$style .= '}';

				$style .= '#section_2 a{';
				$style .= 'color: '. $section2_link_color .';';
				$style .= '}';

				$style .= '#section_3 h1, #section_3 h2, #section_3 h3, #section_3 h4, #section_3 h5, #section_3 h6, #section_3 p{';
				$style .= 'color: '. $section3_font_color .';';
				$style .= '}';

				$style .= '#section_3 a{';
				$style .= 'color: '. $section3_link_color .';';
				$style .= '}';

				$style .= '#section_4 h1, #section_4 h2, #section_4 h3, #section_4 h4, #section_4 h5, #section_4 h6, #section_4 p{';
				$style .= 'color: '. $section4_font_color .';';
				$style .= '}';

				$style .= '#section_4 a{';
				$style .= 'color: '. $section4_link_color .';';
				$style .= '}';

				$style .= '#section_5 h1, #section_5 h2, #section_5 h3, #section_5 h4, #section_5 h5, #section_5 h6, #section_5 p{';
				$style .= 'color: '. $section5_font_color .';';
				$style .= '}';

				$style .= '#section_5 a{';
				$style .= 'color: '. $section5_link_color .';';
				$style .= '}';

				$style .= 'body h1, body h2, body h3, body h4, body h5, body h6, body p{';
				$style .= 'color: '. $body_font_color .';';
				$style .= '}';

				$style .= 'body a{';
				$style .= 'color: '. $body_link_color .';';
				$style .= '}';

				$style .= '#wrap-main-section h1, #wrap-main-section h2, #wrap-main-section h3, #wrap-main-section h4, #wrap-main-section h5, #wrap-main-section h6, #wrap-main-section p{';
				$style .= 'color: '. $content_font_color .';';
				$style .= '}';

				$style .= '#wrap-main-section a{';
				$style .= 'color: '. $content_link_color .';';
				$style .= '}';

				wp_add_inline_style( 'maera', $style );
			}
		}

		// End Methods
	}  // End Class
}     // End If

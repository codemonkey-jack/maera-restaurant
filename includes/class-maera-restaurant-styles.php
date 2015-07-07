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
			if ( 1 == get_theme_mod( 'color_pal', 0 ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'color_calculations' ), 999 );
			}

			// Add filters.
			// NULL

		}

		/**
		 * Set the color palettes to use for the color calculations and shell options.
		 * @return [type] [description]
		 */
		public static function color_palettes() {

			if ( 1 == get_theme_mod( 'invert_palettes', 0 ) ) {

				$palettes = array(
					1 => array( '#333333', '#009CB8', '#027F96', '#046273', '#064550', '#F5F5F5' ),
					2 => array( '#333333', '#006EB7', '#025A95', '#044672', '#063250', '#F5F5F5' ),
					3 => array( '#333333', '#002EB7', '#022795', '#042072', '#061950', '#F5F5F5' ),
					4 => array( '#333333', '#770383', '#62056B', '#4C0653', '#36083B', '#F5F5F5' ),
					5 => array( '#333333', '#4E3606', '#412E07', '#332508', '#261C09', '#F5F5F5' ),
					6 => array( '#333333', '#303D07', '#293308', '#212909', '#1A1F09', '#F5F5F5' ),
				);

			} elseif ( 1 == get_theme_mod( 'reverse_palettes', 0 ) && 1 == get_theme_mod( 'invert_palettes', 0 ) ) {

				$palettes = array(
					1 => array( '#F5F5F5', '#064550', '#046273', '#027F96', '#009CB8', '#333333' ),
					2 => array( '#F5F5F5', '#063250', '#044672', '#025A95', '#006EB7', '#333333' ),
					3 => array( '#F5F5F5', '#061950', '#042072', '#022795', '#002EB7', '#333333' ),
					4 => array( '#F5F5F5', '#36083B', '#4C0653', '#62056B', '#770383', '#333333' ),
					5 => array( '#F5F5F5', '#261C09', '#332508', '#412E07', '#4E3606', '#333333' ),
					6 => array( '#F5F5F5', '#1A1F09', '#212909', '#293308', '#303D07', '#333333' ),
				);

			} elseif ( 1 == get_theme_mod( 'reverse_palettes', 0 ) ) {

				$palettes = array(
					1 => array( '#333333', '#FF6347', '#FD8069', '#FB9D8C', '#F9BAAF', '#F5F5F5' ),
					2 => array( '#333333', '#FF9148', '#FDA56A', '#FBB98D', '#F9CDAF', '#F5F5F5' ),
					3 => array( '#333333', '#FFD148', '#FDD86A', '#FBDF8D', '#F9E6AF', '#F5F5F5' ),
					4 => array( '#333333', '#88FC7C', '#B3F9AC', '#B3F9AC', '#C9F7C4', '#F5F5F5' ),
					5 => array( '#333333', '#B1C9F9', '#BED1F8', '#CCDAF7', '#D9E3F6', '#F5F5F5' ),
					6 => array( '#333333', '#CFC2F8', '#D6CCF7', '#DED6F6', '#E5E0F6', '#F5F5F5' ),
				);

			} else {

				$palettes = array(
					1 => array( '#F5F5F5', '#F9BAAF', '#FB9D8C', '#FD8069', '#FF6347', '#333333' ),
					2 => array( '#F5F5F5', '#F9CDAF', '#FBB98D', '#FDA56A', '#FF9148', '#333333' ),
					3 => array( '#F5F5F5', '#F9E6AF', '#FBDF8D', '#FDD86A', '#FFD148', '#333333' ),
					4 => array( '#F5F5F5', '#C9F7C4', '#B3F9AC', '#9DFA94', '#88FC7C', '#333333' ),
					5 => array( '#F5F5F5', '#D9E3F6', '#CCDAF7', '#BED1F8', '#B1C9F9', '#333333' ),
					6 => array( '#F5F5F5', '#E5E0F6', '#DED6F6', '#D6CCF7', '#CFC2F8', '#333333' ),
				);

			}

			return $palettes;

		}


		/**
		 * Return the colors based on the palette selected.
		 * @return [type] [description]
		 */
		public static function palette_colors() {

			$palettes = self::color_palettes();
			$setting  = get_theme_mod( 'color_palette', 1 );
			$colors   = $palettes[ $setting ];

			return $colors;

		}


		/**
		 * Color palette calculations
		 * @method color_calculations
		 * @since  0.1.0
		 */
		public function color_calculations() {

			$colors = $this->palette_colors();

			$style = '';

			$style .= 'body a{color:#' . str_replace( '#', '', $colors[4] ) . ';}';
			$style .= 'body a:hover{color:#' . str_replace( '#', '', $colors[3] ) . ';}';
			$style .= 'body, body h1, body h2, body h3, body h4, body h5, body h6, body p{color:' . $colors[5] . ';}';
			$style .= '#wrap-main-section h1, #wrap-main-section h2, #wrap-main-section h3, #wrap-main-section h4, #wrap-main-section h5, #wrap-main-section h6, #wrap-main-section p{color:' . $colors[0] . ';}';
			$style .= '.label-primary{background-color:#' . str_replace( '#', '', $colors[4] ) . ';}';
			$style .= '.navbar-default{background-color:#' . str_replace( '#', '', $colors[5] ) . ';}';
			$style .= '.navbar-default .navbar-nav > li > a {color:#' . str_replace( '#', '', $colors[0] ) . ';}';
			$style .= '#footer{background-color:#' . str_replace( '#', '', $colors[5] ) . ';color:#' . str_replace( '#', '', $colors[0] ) . '}';
			$style .= '#footer p{color:#' . str_replace( '#', '',$colors[0] ) . '}';

			wp_add_inline_style( 'maera-res', $style );

		}

	} // End Class

} // End If

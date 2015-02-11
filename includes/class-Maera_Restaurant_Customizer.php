<?php

/**
* Maera Restaurant Customizer Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Customizer(), Maera_Restaurant_Customizer::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Customizer' ) ) {

	class Maera_Restaurant_Customizer {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			// Add actions.
			add_action( 'customize_register', array( $this, 'maera_res_customizer_sections' ) );

			// Add filters.
			add_filter( 'kirki/controls', array( $this, 'maera_res_general_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_1' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_2' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_3' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_4' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_5' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_footer_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_styling_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_typography_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_navigation_settings' ) );

		}


		/**
		 * Maera Restaurant Kirki panels and sections.
		 * @since 1.0.0
		 * @param  [type] $wp_customize [description]
		 * @return [type]               [description]
		 */

		function maera_res_customizer_sections( $wp_customize ){

			$panels = array(
				'maera_res_layout'      => array( 'title' => __( 'Layout', 'maera-restaurant' ), 'description' => __( 'Set an array of layout options.', 'maera-restaurant' ), 'priority' => 25 ),
				'maera_res_styling'     => array( 'title' => __( 'Styling', 'maera-restaurant' ), 'description' => __( 'Set an array of styling options.', 'maera-restaurant' ), 'priority' => 30 ),

			);

			$sections = array(
				'maera_res_general'      => array( 'title' => __( 'General', 'maera-restaurant' ), 'priority' => 35, 'panel' => null ),

				// Frontpage Sections
				'maera_res_section_1'    => array( 'title' => __( 'First Section', 'maera-restaurant' ), 'priority' => 40, 'panel' => 'maera_res_layout'  ),
				'maera_res_section_2'    => array( 'title' => __( 'Second Section', 'maera-restaurant' ), 'priority' => 45, 'panel' => 'maera_res_layout'  ),
				'maera_res_section_3'    => array( 'title' => __( 'Third Section', 'maera-restaurant' ), 'priority' => 50, 'panel' => 'maera_res_layout'  ),
				'maera_res_section_4'    => array( 'title' => __( 'Fourth Section', 'maera-restaurant' ), 'priority' => 60, 'panel' => 'maera_res_layout'  ),
				'maera_res_section_5'    => array( 'title' => __( 'Fifth Section', 'maera-restaurant' ), 'priority' => 65, 'panel' => 'maera_res_layout'  ),
				'maera_res_footer'       => array( 'title' => __( 'Footer', 'maera-restaurant' ), 'priority' => 70, 'panel' => 'maera_res_layout'  ),

				// Styling
				'maera_res_colors'       => array( 'title' => __( 'Colors', 'maera-restaurant' ), 'priority' => 75, 'panel' => 'maera_res_styling' ),
				'maera_res_backgrounds'  => array( 'title' => __( 'Backgrounds', 'maera-restaurant' ), 'priority' => 80, 'panel' => 'maera_res_styling' ),
				'maera_res_typography'   => array( 'title' => __( 'Typography', 'maera-restaurant' ), 'priority' => 85, 'panel' => 'maera_res_styling' ),
				// 'maera_res_navigation'   => array( 'title' => __( 'Navigation', 'maera-restaurant' ), 'priority' => 90, 'panel' => 'maera_res_styling' ),

			);

			foreach ( $sections as $section => $args ) {

				$wp_customize->add_section( $section, array(
					'title'    => $args['title'],
					'priority' => $args['priority'],
					'panel'    => $args['panel'],
				) );

			}

			foreach ( $panels as $panel => $args ) {
				$wp_customize->add_panel( $panel, array(
					'priority'       => $args['priority'],
					'capability'     => 'edit_theme_options',
					'theme_supports' => '',
					'title'          => $args['title'],
					'description'    => $args['description'],
				) );
			}

		}


		/**
		 * Maera Restaurant General Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_general_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'enable_events',
				'label'    => __( 'Enable Event Support', 'maera-restaurant' ),
				'section'  => 'maera_res_general',
				'default'  => 0,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'enable_opentable',
				'label'    => __( 'Enable OpenTable Support', 'maera-restaurant' ),
				'section'  => 'maera_res_general',
				'default'  => 0,
				'priority' => 2,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			return $controls;

		}


		/**
		 * Maera Restaurant First Section Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_1( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_first_section',
				'label'    => __( 'Show First Section', 'maera-restaurant' ),
				'section'  => 'maera_res_section_1',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'section_1_background',
				'label'        => __( 'First Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the first section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_1',
				'default'      => array(
					'color'    => '#222222',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/section_1_background.png',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_1',
			);

			return $controls;

		}


		/**
		 * Maera Restaurant About Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_2( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_second_section',
				'label'    => __( 'Show Second Section', 'maera-restaurant' ),
				'section'  => 'maera_res_section_2',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'section_2_background',
				'label'        => __( 'Second Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the second section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_2',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_2',
			);

			return $controls;

		}


		/**
		 * Maera Restaurant Food & Drink (Restaurant) Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_3( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_third_section',
				'label'    => __( 'Show Third Section', 'maera-restaurant' ),
				'section'  => 'maera_res_section_3',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'section_3_background',
				'label'        => __( 'Third Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the third section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_3',
				'default'      => array(
					'color'    => '#ebe1d7',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/section_3_background.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 85,
				),
				'priority' => 2,
				'output' => '#section_3',
			);

			// $controls[] = array(
			// 		'type'     => 'select',
			// 		'setting'  => 'currency',
			// 		'label'    => __( 'Select a currency to use for the restaurant.', 'maera_bs' ),
			// 		'section'  => 'maera_res_restaurant',
			// 		'default'  => 'United States dollar',
			// 		'priority' => 10,
			// 		'choices'  => null, // Maera_Restaurant_Data::get_currencies(),  // Needs fixed.
			// );

			return $controls;

		}


		/**
		 * Maera Restaurant Event Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_4( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_fourth_section',
				'label'    => __( 'Show Fourth Section', 'maera-restaurant' ),
				'section'  => 'maera_res_section_4',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'section_4_background',
				'label'        => __( 'Fourth Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the fourth section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_4',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_4',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Testimonial Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_5( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_fifth_section',
				'label'    => __( 'Show Fifth Section', 'maera-restaurant' ),
				'section'  => 'maera_res_section_5',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'section_5_background',
				'label'        => __( 'Fifth Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the fifth section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_5',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/section_5_background.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_5',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Social Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_footer_settings( $controls ) {

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'footer_background',
				'label'        => __( 'Footer Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the footer section.', 'maera-restaurant' ),
				'section'      => 'maera_res_footer',
				'default'      => array(
					'color'    => '#252525',
					'image'    => null,
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 1,
				'output' => 'footer',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Styling Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_styling_settings( $controls ) {

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'link_color',
				'label'    => __( 'Link Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#337ab7',
				'priority' => 1,
				'output' => array(
					'element'  => 'a',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'gradients',
				'label'    => __( 'Enable Gradients', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => 0,
				'priority' => 2,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Background Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_background_settings( $controls ) {

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'html_background',
				'label'        => __( 'HTML Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the HTML container.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 3,
				'output' => 'html',
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'body_background',
				'label'        => __( 'Body Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the body section.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 10,
				'output' => 'body',
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'content_background',
				'label'        => __( 'Main Content Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the main content sections.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#fff',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 10,
				'output' => '#wrap-main-section',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Typography Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_typography_settings( $controls ) {

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'navbar_font',
				'label'    => __( 'Navbar Font', 'maera_bs' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Lora',
				'priority' => 1,
				'choices'  => Kirki_Fonts::get_font_choices(),
				'output' => array(
					'element'  => '.navbar',
					'property' => 'font-family',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'navbar_font_color',
				'label'    => __( 'Navbar Font Color', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => '#333333',
				'priority' => 2,
				'output' => array(
					'element'  => '.navbar-default .navbar-nav > li >a',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'headers_font',
				'label'    => __( 'Headers Font', 'maera_bs' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Allura',
				'priority' => 2,
				'choices'  => Kirki_Fonts::get_font_choices(),
				'output' => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'font-family',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'headers_font_color',
				'label'    => __( 'Headers Font Color', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => '#333333',
				'priority' => 2,
				'output' => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'content_font',
				'label'    => __( 'Content Font', 'maera_bs' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
				'priority' => 2,
				'choices'  => Kirki_Fonts::get_font_choices(),
				'output' => array(
					'element'  => 'body',
					'property' => 'font-family',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'content_font_color',
				'label'    => __( 'Content Font Color', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => '#333333',
				'priority' => 2,
				'output' => array(
					'element'  => 'body',
					'property' => 'color',
				),
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Navigation Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_navigation_settings( $controls ) {

			 return $controls;

		}


		// End Methods
	} // End Class
} // End if

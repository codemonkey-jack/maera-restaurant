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
			add_filter( 'kirki/controls', array( $this, 'maera_res_restaurant_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_layout_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_styling_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_typography_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_1' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_2' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_3' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_4' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_section_5' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_background_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_footer_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_social_settings' ) );
		}


		/**
		 * Maera Restaurant Kirki panels and sections.
		 * @since 1.0.0
		 * @param  [type] $wp_customize [description]
		 * @return [type]               [description]
		 */

		function maera_res_customizer_sections( $wp_customize ){

			$panels = array(
				'maera_res_sections'     => array( 'title' => __( 'Sections', 'maera-restaurant' ), 'description' => __( 'Set an array of background options.', 'maera-restaurant' ), 'priority' => 45 ),
			);

			$sections = array(
				'maera_res_restaurant'   => array( 'title' => __( 'Restaurant', 'maera-restaurant' ), 'priority' => 25, 'panel' => null ),
				'maera_res_layout'       => array( 'title' => __( 'Layout', 'maera-restaurant' ), 'priority' => 30, 'panel' => null ),
				'maera_res_colors'       => array( 'title' => __( 'Colors', 'maera-restaurant' ), 'priority' => 35, 'panel' => null ),
				'maera_res_typography'   => array( 'title' => __( 'Typography', 'maera-restaurant' ), 'priority' => 40, 'panel' => null ),
				'maera_res_section_1'    => array( 'title' => __( 'First Section', 'maera-restaurant' ), 'priority' => 50, 'panel' => 'maera_res_sections' ),
				'maera_res_section_2'    => array( 'title' => __( 'Second Section', 'maera-restaurant' ), 'priority' => 55, 'panel' => 'maera_res_sections' ),
				'maera_res_section_3'    => array( 'title' => __( 'Third Section', 'maera-restaurant' ), 'priority' => 60, 'panel' => 'maera_res_sections' ),
				'maera_res_section_4'    => array( 'title' => __( 'Fourth Section', 'maera-restaurant' ), 'priority' => 65, 'panel' => 'maera_res_sections' ),
				'maera_res_section_5'    => array( 'title' => __( 'Fifth Section', 'maera-restaurant' ), 'priority' => 70, 'panel' => 'maera_res_sections' ),
				'maera_res_body'         => array( 'title' => __( 'Content Areas', 'maera-restaurant' ), 'priority' => 75, 'panel' => 'maera_res_sections' ),
				'maera_res_footer'       => array( 'title' => __( 'Footer', 'maera-restaurant' ), 'priority' => 80, 'panel' => 'maera_res_sections' ),
				'maera_res_social'       => array( 'title' => __( 'Social', 'maera-restaurant' ), 'priority' => 85, 'panel' => null ),

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
		 * Maera Restaurant Layout Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_layout_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'site_layout',
				'label'    => __( 'Site Layout', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'priority' => 1,
				'default'  => 'wide',
				'choices'  => array(
					'wide'    => __( 'Wide', 'maera-restaurant' ),
					'boxed'   => __( 'Boxed', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'image',
				'setting'  => 'page_layout',
				'label'    => __( 'Page Layout', 'maera-restaurant' ),
				'subtitle' => __( 'Select your main layout. If no widgets are present in the sidebar, it will not be displayed. ', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'priority' => 2,
				'default'  => 0,
				'choices'  => $this->layouts(),
			);

			$controls[] = array(
				'type'     => 'sortable',
				'setting'  => 'front_page_sections',
				'label'    => __( 'Front Page Sections', 'maera_mg' ),
				'section'  => 'maera_res_layout',
				'default'  => serialize( array( 'navbar', 'section_1', 'section_2', 'section_3' ) ),
				'priority' => 3,
				'choices'  => array(
					'navbar'           => __( 'Navigation Menu', 'maera-restaurant' ),
					'section_1'        => __( 'Section 1', 'maera-restaurant' ),
					'section_2'        => __( 'Section 2', 'maera-restaurant' ),
					'section_3'        => __( 'Section 3', 'maera-restaurant' ),
					'section_4'        => __( 'Section 4', 'maera-restaurant' ),
					'section_5'        => __( 'Section 5', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'enable_breadcrumbs',
				'label'    => __( 'Enable Breadcrumbs', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'default'  => 1,
				'priority' => 4,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			return $controls;

		}


		/**
		 * Maera Restaurant Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_restaurant_settings( $controls ) {

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'currency',
				'label'    => __( 'Select a currency to use for the restaurant.', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => '$ USD',
				'priority' => 1,
				'choices'  => Maera_Restaurant_Data::get_currencies(),
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
				'type'     => 'checkbox',
				'setting'  => 'section_1_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_1',
				'default'  => 0,
				'priority' => 1,
				'mode' => 'toggle',
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
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_1',
			);

			return $controls;

		}


		/**
		 * Maera Restaurant Second Section Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_2( $controls ) {

			$controls[] = array(
				'type'     => 'checkbox',
				'setting'  => 'section_2_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_2',
				'default'  => 0,
				'priority' => 1,
				'mode' => 'toggle',
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
		 * Maera Restaurant Third Section Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_3( $controls ) {

			$controls[] = array(
				'type'     => 'checkbox',
				'setting'  => 'section_3_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_3',
				'default'  => 0,
				'priority' => 1,
				'mode' => 'toggle',
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
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_3',
			);

			return $controls;

		}


		/**
		 * Maera Restaurant Fourth Section Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_4( $controls ) {

			$controls[] = array(
				'type'     => 'checkbox',
				'setting'  => 'section_4_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_4',
				'default'  => 0,
				'priority' => 1,
				'mode' => 'toggle',
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
		 * Maera Restaurant Fifth Section Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_section_5( $controls ) {

			$controls[] = array(
				'type'     => 'checkbox',
				'setting'  => 'section_5_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_5',
				'default'  => 0,
				'priority' => 1,
				'mode' => 'toggle',
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
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#section_5',
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
				'setting'      => 'body_background',
				'label'        => __( 'Body Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the body section.', 'maera-restaurant' ),
				'section'      => 'maera_res_body',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 1,
				'output' => 'body',
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'posts_background',
				'label'    => __( 'Recent Posts Background Color', 'maera-restaurant' ),
				'description'  => __( 'Set the background color for the front page posts.', 'maera-restaurant' ),
				'section'  => 'maera_res_body',
				'default'  => '#333333',
				'priority' => 10,
				'output' => array(
					'element'  => '.post-article .thumbnail',
					'property' => 'background-color',
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'content_background',
				'label'        => __( 'Main Content Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the main content sections.', 'maera-restaurant' ),
				'section'      => 'maera_res_body',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority' => 15,
				'output' => array(
					array(
						'element'  => '#wrap-main-section',
					),
					array(
						'element'  => '.class_name',
					),
				),
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Footer Settings
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

			$controls[] = array(
				'type'     => 'textarea',
				'setting'  => 'copyright_text',
				'label'    => __( 'Copyright Text', 'maera-restaurant' ),
				'section'  => 'maera_res_footer',
				'default'  => __( '&copy; 2015 - Maera Restaurant', 'maera-restaurant' ),
				'priority' => 10,
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
				'type'     => 'checkbox',
				'mode'     => 'switch',
				'setting'  => 'color_calc',
				'label'    => __( 'Enable Automatic Color Calculations', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => 0,
				'priority' => 1,
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'link_color',
				'label'    => __( 'Link Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#244363',
				'priority' => 2,
				'required' => array( 'color_calc' => 0 ),
				'output' => array(
					'element'  => 'a',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'link_hover_color',
				'label'    => __( 'Link Hover Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#325d88',
				'priority' => 3,
				'required' => array( 'color_calc' => 0 ),
				'output' => array(
					'element'  => 'a:hover',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'setting'  => 'navbar_color',
				'label'    => __( 'Navbar Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#333333',
				'priority' => 4,
				'output' => array(
					'element'  => '.navbar-default',
					'property' => 'background-color',
				),
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
				'label'    => __( 'Navbar Font', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
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
				'required' => array( 'color_calc' => 0 ),
				'output' => array(
					'element'  => '.navbar-default .navbar-nav > li > a',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'navbar_font_size',
				'label'    => __( 'Navbar Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 1.5,
				'priority' => 3,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => '.navbar-default .navbar-nav > li > a',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'navbar_font_weight',
				'label'    => __( 'Navbar Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 300,
				'priority' => 4,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output' => array(
					'element'  => '.navbar-default .navbar-nav > li > a',
					'property' => 'font-weight',
					'units'    => null,
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'headers_font',
				'label'    => __( 'Headers Font', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
				'priority' => 5,
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
				'priority' => 6,
				'required' => array( 'color_calc' => 0 ),
				'output' => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h1_font_size',
				'label'    => __( 'H1 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 3,
				'priority' => 7,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h1',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h2_font_size',
				'label'    => __( 'H2 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 2,
				'priority' => 8,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h2',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h3_font_size',
				'label'    => __( 'H3 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 1.75,
				'priority' => 9,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h3',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h4_font_size',
				'label'    => __( 'H4 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 1.5,
				'priority' => 10,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h4',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h5_font_size',
				'label'    => __( 'H5 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 1,
				'priority' => 11,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h5',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'h6_font_size',
				'label'    => __( 'H6 Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => .75,
				'priority' => 12,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'h6',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'header_font_weight',
				'label'    => __( 'Headers Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 600,
				'priority' => 13,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output' => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'font-weight',
					'units'    => null,
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'setting'  => 'content_font',
				'label'    => __( 'Content Font', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
				'priority' => 14,
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
				'priority' => 15,
				'required' => array( 'color_calc' => 0 ),
				'output' => array(
					'element'  => 'body p',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'content_font_size',
				'label'    => __( 'Content Font Size (em)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 1.5,
				'priority' => 16,
				'choices'  => array(
					'min'  => .25,
					'max'  => 10,
					'step' => .25,
				),
				'output' => array(
					'element'  => 'p',
					'property' => 'font-size',
					'units'    => 'em',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'setting'  => 'content_font_weight',
				'label'    => __( 'Content Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 300,
				'priority' => 17,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output' => array(
					'element'  => 'p',
					'property' => 'font-weight',
					'units'    => null,
				),
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Social Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_social_settings( $controls ) {

			$controls[] = array(
				'type'     => 'text',
				'setting'  => 'facebook_link',
				'label'    => __( 'Facebook Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://facebook.com/', 'maera-restaurant' ),
				'priority' => 1,
			);

			$controls[] = array(
				'type'     => 'text',
				'setting'  => 'twitter_link',
				'label'    => __( 'Twitter Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://twitter.com/', 'maera-restaurant' ),
				'priority' => 2,
			);

			$controls[] = array(
				'type'     => 'text',
				'setting'  => 'googleplus_link',
				'label'    => __( 'Google+ Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://plus.google.com/', 'maera-restaurant' ),
				'priority' => 3,
			);

			$controls[] = array(
				'type'     => 'text',
				'setting'  => 'youtube_link',
				'label'    => __( 'Youtube Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://youtube.com/', 'maera-restaurant' ),
				'priority' => 4,
			);

			 return $controls;

		}


		/**
		 * Return layouts
		 * @return [type] [description]
		 */
		function layouts() {
			$layouts = array(
				0 => get_template_directory_uri() . '/assets/images/1c.png',
				1 => get_template_directory_uri() . '/assets/images/2cr.png',
			);
			return $layouts;
		}

		// End Methods
	} // End Class
} // End if

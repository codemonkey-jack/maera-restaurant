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
				'maera_res_restaurant' => array( 'title' => __( 'Restaurant', 'maera-restaurant' ),     'priority' => 25, 'panel' => null ),
				'maera_res_layout'     => array( 'title' => __( 'Layout', 'maera-restaurant' ),         'priority' => 30, 'panel' => null ),
				'maera_res_colors'     => array( 'title' => __( 'Colors', 'maera-restaurant' ),         'priority' => 35, 'panel' => null ),
				'maera_res_typography' => array( 'title' => __( 'Typography', 'maera-restaurant' ),     'priority' => 40, 'panel' => null ),
				'maera_res_section_1'  => array( 'title' => __( 'First Section', 'maera-restaurant' ),  'priority' => 50, 'panel' => 'maera_res_sections' ),
				'maera_res_section_2'  => array( 'title' => __( 'Second Section', 'maera-restaurant' ), 'priority' => 55, 'panel' => 'maera_res_sections' ),
				'maera_res_section_3'  => array( 'title' => __( 'Third Section', 'maera-restaurant' ),  'priority' => 60, 'panel' => 'maera_res_sections' ),
				'maera_res_section_4'  => array( 'title' => __( 'Fourth Section', 'maera-restaurant' ), 'priority' => 65, 'panel' => 'maera_res_sections' ),
				'maera_res_section_5'  => array( 'title' => __( 'Fifth Section', 'maera-restaurant' ),  'priority' => 70, 'panel' => 'maera_res_sections' ),
				'maera_res_body'       => array( 'title' => __( 'Content Areas', 'maera-restaurant' ),  'priority' => 75, 'panel' => 'maera_res_sections' ),
				'maera_res_footer'     => array( 'title' => __( 'Footer', 'maera-restaurant' ),         'priority' => 80, 'panel' => 'maera_res_sections' ),
				'maera_res_social'     => array( 'title' => __( 'Social', 'maera-restaurant' ),         'priority' => 85, 'panel' => null ),

			);

			// Loop through panels and add them to Kirki.
			foreach ( $panels as $panel => $args ) {

				$wp_customize->add_panel( $panel, array(
					'priority'       => $args['priority'],
					'capability'     => 'edit_theme_options',
					'theme_supports' => '',
					'title'          => $args['title'],
					'description'    => $args['description'],
				) );

			}

			// Loop through sections and add them to panels/Kirki.
			foreach ( $sections as $section => $args ) {

				$wp_customize->add_section( $section, array(
					'title'    => $args['title'],
					'priority' => $args['priority'],
					'panel'    => $args['panel'],
				) );

			}

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
				'settings' => 'currency',
				'label'    => __( 'Restaurant Currency.', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => '$ USD',
				'priority' => 1,
				'choices'  => Maera_Restaurant_Data::get_currencies(),
				'help'     => __( 'This currency will be used throughout the Restaurant for menu items.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'     => 'text',
				'settings' => 'phone_number',
				'label'    => __( 'Restaurant Phone Number', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => __( '+555-867-5309', 'maera-restaurant' ),
				'priority' => 2,
			);

			$controls[] = array(
				'type'     => 'select',
				'settings' => 'restaurant_order_by',
				'label'    => __( 'Menu Page Ordering.', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => 'ID',
				'priority' => 3,
				'help'     => __( 'You can use this to select how the restaurant menu items are ordered.', 'maera-restaurant' ),
				'choices'  => array(
					'none'          => __( 'None', 'maera-restaurant' ),
					'ID'            => __( 'By ID', 'maera-restaurant' ),
					'author'        => __( 'By Author', 'maera-restaurant' ),
					'title'         => __( 'By Title', 'maera-restaurant' ),
					'date'          => __( 'By Date', 'maera-restaurant' ),
					'modified'      => __( 'By Last Modified Date', 'maera-restaurant' ),
					'parent'        => __( 'By Parent', 'maera-restaurant' ),
					'rand'          => __( 'Random', 'maera-restaurant' ),
					'comment_count' => __( 'By Comment Count', 'maera-restaurant' ),
					'menu_order'    => __( 'By Menu Page Order', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'settings' => 'restaurant_order',
				'label'    => __( 'Restaurant Menu sorting order.', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => 'ID',
				'priority' => 4,
				'choices'  => array(
					'ASC'  => __( 'Ascending', 'maera-restaurant' ),
					'DESC' => __( 'Descending', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'        => 'select',
				'settings'    => 'isotope_layout',
				'label'       => __( 'Menu Page Layout.', 'maera-restaurant' ),
				'description' => __( 'Examples may be found here: http://isotope.metafizzy.co/layout-modes.html ', 'maera-restaurant' ),
				'section'     => 'maera_res_restaurant',
				'default'     => 'ID',
				'priority'    => 4,
				'help'        => __( 'Select the Isotope layout mode for how the restaurant menu is displayed.', 'maera-restaurant' ),
				'choices'     => array(
					'masonry'           => __( 'Masonry', 'maera-restaurant' ),
					'masonryHorizontal' => __( 'Masonry - Horizontal', 'maera-restaurant' ),
					'fitRows'           => __( 'Fit Rows', 'maera-restaurant' ),
					'fitColumns'        => __( 'Fit Columns', 'maera-restaurant' ),
					'cellsByRow'        => __( 'Cells - By Row', 'maera-restaurant' ),
					'cellsByColumn'     => __( 'Cells - By Column', 'maera-restaurant' ),
					'vertical'          => __( 'Vertical', 'maera-restaurant' ),
					'horizontal'        => __( 'Horizontal', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'textarea',
				'settings' => 'recent_lead_text',
				'label'    => __( 'Recent Posts Sub-text', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => __( 'Our chef cooks up something wonderful.', 'maera-restaurant' ),
				'priority' => 5,
			);

			return $controls;
		}


		/**
		 * Maera Restaurant Layout Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_layout_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio-image',
				'settings' => 'page_layout',
				'label'    => __( 'Page Layout', 'maera-restaurant' ),
				'subtitle' => __( 'Select your main layout. If no widgets are present in the sidebar, it will not be displayed. ', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'priority' => 1,
				'default'  => 0,
				'choices'  => $this->layouts(),
			);

			$controls[] = array(
				'type'     => 'sortable',
				'settings' => 'front_page_sections',
				'label'    => __( 'Front Page Sections', 'maera-restaurant' ),
				'subtitle' => __( 'You may drag and reorder the sections as desired.', 'maera-resstaurant' ),
				'section'  => 'maera_res_layout',
				'default'  => array( 'section_1', 'section_2', 'section_3' ),
				'priority' => 2,
				'help'     => __( 'Click the "eye" to toggle the section from being displayed.', 'maera-restaurant' ),
				'choices'  => array(
					'section_1'   => __( 'Section 1', 'maera-restaurant' ),
					'section_2'   => __( 'Section 2', 'maera-restaurant' ),
					'section_3'   => __( 'Section 3', 'maera-restaurant' ),
					'section_4'   => __( 'Section 4', 'maera-restaurant' ),
					'section_5'   => __( 'Section 5', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'toggle',
				'settings' => 'enable_contact_bar',
				'label'    => __( 'Enable Contact Bar', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'default'  => 1,
				'priority' => 3,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio-buttonset',
				'settings' => 'contact_bar_position',
				'label'    => __( 'Contact Bar Position', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'default'  => 1,
				'priority' => 4,
				'required' => array(
					array(
						'setting'  => 'enable_contact_bar',
						'operator' => '==',
						'value'    => 1
					),
				),
				'choices'  => array(
					1 => __( 'Top', 'maera-restaurant' ),
					0 => __( 'Bottom', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'toggle',
				'settings' => 'enable_breadcrumbs',
				'label'    => __( 'Enable Breadcrumbs', 'maera-restaurant' ),
				'section'  => 'maera_res_layout',
				'default'  => 1,
				'priority' => 5,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			return $controls;
		}


		/**
		 * Maera Restaurant Color and Styling Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_styling_settings( $controls ) {

			$controls[] = array(
				'type'     => 'toggle',
				'settings' => 'color_pal',
				'label'    => __( 'Color Palettes', 'maera-restaurant' ),
				'help'     => __( 'Enabling will allow you to select from a range of color palettes to use.', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => 0,
				'priority' => 1,
			);

			$controls[] = array(
				'type'        => 'palette',
				'setting'     => 'color_palette',
				'label'       => __( 'Color Palette', 'maera-restaurant' ),
				'description' => __( 'Select a pre-defined color palette to use.', 'maera-restaurant' ),
				'help'        => __( 'Selecting a pre-defined color palette will automatically handle most of the colors and styling of the site.', 'maera-restaurant' ),
				'section'     => 'maera_res_colors',
				'default'     => 1,
				'priority'    => 2,
				'required'    => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 1
					),
				),
				'choices'     => Maera_Restaurant_Styles::color_palettes(),
			);

			$controls[] = array(
				'type'     => 'toggle',
				'settings' => 'invert_palettes',
				'label'    => __( 'Invert Palettes', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => 0,
				'priority' => 3,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 1
					),
				),
			);

			$controls[] = array(
				'type'     => 'toggle',
				'settings' => 'reverse_palettes',
				'label'    => __( 'Reverse Palettes', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => 0,
				'priority' => 4,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 1
					),
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'brand_color',
				'label'    => __( 'Primary Brand Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#73A2BD',
				'priority' => 5,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					array(
						'element'  => '.btn-primary',
						'property' => 'background-color',
					),
					array(
						'element'  => 'ul.social-share li a:hover',
						'property' => 'background',
					),
					array(
						'element'  => '.navbar-default .navbar-nav > li > a:hover',
						'property' => 'background-color',
					),
					array(
						'element'  => '.navbar-default .navbar-nav .dropdown-menu > li:hover > a, .navbar-default .navbar-nav .dropdown-menu > li:focus > a, .navbar-default .navbar-nav .dropdown-menu > li.active > a',
						'property' => 'background-color',
					),
					array(
						'element'  => '.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus',
						'property' => 'background-color',
					),
					array(
						'element'  => '.prev, .next',
						'property' => 'background-color',
					),
					array(
						'element'  => '#publish_date',
						'property' => 'background',
					),
					array(
						'element'  => '.read-more',
						'property' => 'background',
					),
					array(
						'element'  => '#bottom',
						'property' => 'border-color',
					),
					array(
						'element'  => '.tagcloud a:hover',
						'property' => 'background',
					),
					array(
						'element'  => 'ul.pagination > li.active > a, ul.pagination > li:hover > a',
						'property' => 'background',
					),
				)
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'link_color',
				'label'    => __( 'Link Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#73A2BD',
				'priority' => 6,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					'element'  => 'body a',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'link_hover_color',
				'label'    => __( 'Link Hover Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#86B4CF',
				'priority' => 7,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					'element'  => 'a:hover',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'navbar_color',
				'label'    => __( 'Navbar Color', 'maera-restaurant' ),
				'section'  => 'maera_res_colors',
				'default'  => '#222222',
				'priority' => 8,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
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
				'settings' => 'content_font',
				'label'    => __( 'Content Font', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
				'priority' => 1,
				'choices'  => Kirki_Fonts::get_font_choices(),
				'output'   => array(
					'element'  => 'body',
					'property' => 'font-family',
				),
			);

			$controls[] = array(
				'type'         => 'multicheck',
				'setting'      => 'content_font_subsets',
				'label'        => __( 'Font subsets', 'maera-restaurant' ),
				'description'  => __( 'The subsets used from Google\'s API.', 'maera-restaurant' ),
				'section'      => 'maera_res_typography',
				'default'      => 'all',
				'priority'     => 2,
				'choices'      => Kirki_Fonts::get_google_font_subsets(),
				'output'       => array(
					'element'  => 'body',
					'property' => 'font-subset',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'content_font_color',
				'label'    => __( 'Content Font Color', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => '#333333',
				'priority' => 3,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					'element'  => 'body p',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'content_font_size',
				'label'    => __( 'Content Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 14,
				'priority' => 4,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'body p',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'content_font_weight',
				'label'    => __( 'Content Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 300,
				'priority' => 5,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output'   => array(
					'element'  => 'p',
					'property' => 'font-weight',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'navbar_font_size',
				'label'    => __( 'Navbar Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 14,
				'priority' => 6,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					array(
						'element'  => '.navbar-default .navbar-nav > li > a',
						'property' => 'font-size',
						'units'    => 'px',
					),
					array(
						'element'  => '.dropdown-menu > li > a',
						'property' => 'font-size',
						'units'    => 'px',
					),
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'navbar_font_weight',
				'label'    => __( 'Navbar Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 300,
				'priority' => 7,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output'   => array(
					'element'  => '.navbar-default .navbar-nav > li > a',
					'property' => 'font-weight',
				),
			);

			$controls[] = array(
				'type'     => 'select',
				'settings' => 'headers_font',
				'label'    => __( 'Header Fonts', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 'Open Sans',
				'priority' => 8,
				'choices'  => Kirki_Fonts::get_font_choices(),
				'output'   => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'font-family',
				),
			);

			$controls[] = array(
				'type'     => 'color',
				'settings' => 'headers_font_color',
				'label'    => __( 'Header Font Color', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => '#333333',
				'priority' => 9,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'color',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h1_font_size',
				'label'    => __( 'H1 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 22,
				'priority' => 10,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h1',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h2_font_size',
				'label'    => __( 'H2 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 20,
				'priority' => 11,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h2',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h3_font_size',
				'label'    => __( 'H3 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 18,
				'priority' => 12,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h3',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h4_font_size',
				'label'    => __( 'H4 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 16,
				'priority' => 13,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h4',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h5_font_size',
				'label'    => __( 'H5 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 14,
				'priority' => 14,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h5',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'h6_font_size',
				'label'    => __( 'H6 Font Size (px)', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 12,
				'priority' => 15,
				'choices'  => array(
					'min'  => 7,
					'max'  => 48,
					'step' => 1,
				),
				'output'   => array(
					'element'  => 'h6',
					'property' => 'font-size',
					'units'    => 'px',
				),
			);

			$controls[] = array(
				'type'     => 'slider',
				'settings' => 'header_font_weight',
				'label'    => __( 'Headers Font Weight', 'maera-restaurant' ),
				'section'  => 'maera_res_typography',
				'default'  => 600,
				'priority' => 16,
				'choices'  => array(
					'min'  => 100,
					'max'  => 900,
					'step' => 100,
				),
				'output'   => array(
					'element'  => 'h1,h2,h3,h4,h5,h6',
					'property' => 'font-weight',
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
				'type'     => 'toggle',
				'settings' => 'section_1_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_1',
				'default'  => 0,
				'priority' => 1,
				'help'     => __( 'Enabling Parallax will override the background position.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'section_1_background',
				'label'        => __( 'First Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the first section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_1',
				'priority'     => 2,
				'output'       => '#section_1',
				'default'      => array(
					'color'    => '#333333',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/section_1_background.png',
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
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
				'type'     => 'toggle',
				'settings' => 'section_2_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_2',
				'default'  => 0,
				'priority' => 1,
				'help'     => __( 'Enabling Parallax will override the background position.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'section_2_background',
				'label'        => __( 'Second Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the second section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_2',
				'priority'     => 2,
				'output'       => '#section_2',
				'default'      => array(
					'color'    => '#f5f5f5',
					'image'    => '',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
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
				'type'     => 'toggle',
				'settings' => 'section_3_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_3',
				'default'  => 0,
				'priority' => 1,
				'help'     => __( 'Enabling Parallax will override the background position.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'section_3_background',
				'label'        => __( 'Third Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the third section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_3',
				'priority'     => 2,
				'output'       => '#section_3',
				'default'      => array(
					'color'    => '#f5f5f5',
					'image'    => '',
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
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
				'type'     => 'toggle',
				'settings' => 'section_4_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_4',
				'default'  => 0,
				'priority' => 1,
				'help'     => __( 'Enabling Parallax will override the background position.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'section_4_background',
				'label'        => __( 'Fourth Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the fourth section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_4',
				'priority'     => 2,
				'output'       => '#section_4',
				'default'      => array(
					'color'    => '#f5f5f5',
					'image'    => '',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
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
				'type'     => 'toggle',
				'settings' => 'section_5_parallax',
				'label'    => __( 'Enable Parallax', 'maera-restaurant' ),
				'section'  => 'maera_res_section_5',
				'default'  => 0,
				'priority' => 1,
				'help'     => __( 'Enabling Parallax will override the background position.', 'maera-restaurant' ),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'section_5_background',
				'label'        => __( 'Fifth Section Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the fifth section.', 'maera-restaurant' ),
				'section'      => 'maera_res_section_5',
				'priority'     => 2,
				'output'       => '#section_5',
				'default'      => array(
					'color'    => '#333333',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/section_5_background.jpg',
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
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
				'settings'     => 'body_background',
				'label'        => __( 'Body Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the body section.', 'maera-restaurant' ),
				'section'      => 'maera_res_body',
				'priority'     => 1,
				'output'       => 'body',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => '',
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
			);

			$controls[] = array(
				'type'         => 'color',
				'settings'     => 'posts_background',
				'label'        => __( 'Recent Posts Background Color', 'maera-restaurant' ),
				'description'  => __( 'Set the background color for the recent posts.', 'maera-restaurant' ),
				'section'      => 'maera_res_body',
				'default'      => '#ffffff',
				'priority'     => 15,
				'output'       => array(
					'element'  => '.recent-post-wrap .overlay',
					'property' => 'background',
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'settings'     => 'content_background',
				'label'        => __( 'Main Content Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the main content sections.', 'maera-restaurant' ),
				'section'      => 'maera_res_body',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => '',
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 100,
				),
				'priority'     => 16,
				'output'       => '#wrap-main-section',
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
				'type'     => 'color',
				'settings' => 'footer_background',
				'label'    => __( 'Footer Background Color', 'maera-restaurant' ),
				'section'  => 'maera_res_footer',
				'default'  => '#333333',
				'priority' => 7,
				'required' => array(
					array(
						'setting'  => 'color_pal',
						'operator' => '==',
						'value'    => 0
					),
				),
				'output'   => array(
					'element'  => '#footer',
					'property' => 'background-color',
				),
			);

			$controls[] = array(
				'type'     => 'textarea',
				'settings' => 'copyright_text',
				'label'    => __( 'Copyright Text', 'maera-restaurant' ),
				'section'  => 'maera_res_footer',
				'default'  => __( '&copy; 2015 - Maera Restaurant', 'maera-restaurant' ),
				'priority' => 10,
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
				'settings' => 'facebook_link',
				'label'    => __( 'Facebook Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://facebook.com/', 'maera-restaurant' ),
				'priority' => 1,
			);

			$controls[] = array(
				'type'     => 'text',
				'settings' => 'twitter_link',
				'label'    => __( 'Twitter Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://twitter.com/', 'maera-restaurant' ),
				'priority' => 2,
			);

			$controls[] = array(
				'type'     => 'text',
				'settings' => 'googleplus_link',
				'label'    => __( 'Google+ Link', 'maera-restaurant' ),
				'section'  => 'maera_res_social',
				'default'  => __( 'http://plus.google.com/', 'maera-restaurant' ),
				'priority' => 3,
			);

			$controls[] = array(
				'type'     => 'text',
				'settings' => 'youtube_link',
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

	} // End Class

} // End if

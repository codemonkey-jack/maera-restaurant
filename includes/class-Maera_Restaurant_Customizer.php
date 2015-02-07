<?php

/**
* Maera Restaurant Customizer Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch. Press.Codes, Maera
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
			add_filter( 'kirki/controls', array( $this, 'maera_res_layout_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_frontpage_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_styling_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_typography_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_navigation_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_social_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_restaurant_settings' ) );
		}


		/**
		 * Maera Restaurant Section
		 * @since 1.0.0
		 * @param  [type] $wp_customize [description]
		 * @return [type]               [description]
		 */

		function maera_res_customizer_sections( $wp_customize ){

			$panels = array(
				'maera_res_styling'    => array( 'title' => __( 'Styling', 'maera-restaurant' ), 'description' => __( 'Set an array of styling options.', 'maera-restaurant' ), 'priority' => 25 ),
			);

			$sections = array(
				'maera_res_general'     => array( 'title' => __( 'General', 'maera-restaurant' ), 'priority' => 30, 'panel' => null ),
				'maera_res_layout'      => array( 'title' => __( 'Layout', 'maera-restaurant' ), 'priority' => 35, 'panel' => null  ),
				// 'maera_res_frontpage'   => array( 'title' => __( 'Front Page', 'maera-restaurant' ), 'priority' => 40 ),  // Use default.
				'maera_res_colors'      => array( 'title' => __( 'Colors', 'maera-restaurant' ), 'priority' => 45, 'panel' => 'maera_res_styling' ),
				'maera_res_backgrounds' => array( 'title' => __( 'Backgrounds', 'maera-restaurant' ), 'priority' => 45, 'panel' => 'maera_res_styling' ),
				'maera_res_typography'  => array( 'title' => __( 'Typography', 'maera-restaurant' ), 'priority' => 50, 'panel' => null  ),
				'maera_res_navigation'  => array( 'title' => __( 'Navigation', 'maera-restaurant' ), 'priority' => 55, 'panel' => null  ),
				'maera_res_social'      => array( 'title' => __( 'Social', 'maera-restaurant' ), 'priority' => 60, 'panel' => null  ),
				'maera_res_restaurant'  => array( 'title' => __( 'Restaurant', 'maera-restaurant' ), 'priority' => 65, 'panel' => null  ),
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

			 return $controls;

		}



		/**
		 * Maera Restaurant Layout Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_layout_settings( $controls ) {

			 return $controls;

		}


		/**
		 * Maera Restaurant Front Page Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_frontpage_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_slider_section',
				'label'    => __( 'Show Slider', 'maera-restaurant' ),
				'section'  => 'static_front_page',
				'default'  => 1,
				'priority' => 25,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_about_section',
				'label'    => __( 'Show About', 'maera-restaurant' ),
				'section'  => 'static_front_page',
				'default'  => 1,
				'priority' => 30,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_menu_section',
				'label'    => __( 'Show Menu', 'maera-restaurant' ),
				'section'  => 'static_front_page',
				'default'  => 1,
				'priority' => 35,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_events_section',
				'label'    => __( 'Show Events', 'maera-restaurant' ),
				'section'  => 'static_front_page',
				'default'  => 1,
				'priority' => 40,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_testimonials_section',
				'label'    => __( 'Show Testimonials', 'maera-restaurant' ),
				'section'  => 'static_front_page',
				'default'  => 1,
				'priority' => 45,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
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
				'setting'      => 'menu_background',
				'label'        => __( 'Menu Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the menu section.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#ebe1d7',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/menu.png',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 85,
				),
				'priority' => 17,
				'output' => '#menu',
			);


			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'latest_posts_background',
				'label'        => __( 'Latest Posts Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the latest posts section.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/recipes.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 24,
				'output' => '#latest-posts',
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'testimonials_posts_background',
				'label'        => __( 'Testimonials Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the testimonials section.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/testimonials.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 31,
				'output' => '#testimonials',
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


		/**
		 * Maera Restaurant Social Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_social_settings( $controls ) {

			 return $controls;

		}


		/**
		 * Maera Restaurant Food & Drink Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_restaurant_settings( $controls ) {

			 return $controls;

		}


		/**
		 * Get the list of categories to return to the customizer.
		 * @return [type] [description]
		 */
		public function maera_res_get_categories() {

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

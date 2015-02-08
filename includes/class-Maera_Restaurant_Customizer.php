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
			add_filter( 'kirki/controls', array( $this, 'maera_res_slider_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_about_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_restaurant_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_blog_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_events_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_testimonial_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_social_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_styling_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_typography_settings' ) );
			add_filter( 'kirki/controls', array( $this, 'maera_res_navigation_settings' ) );

		}


		/**
		 * Maera Restaurant Section
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
				'maera_res_slider'       => array( 'title' => __( 'Slider', 'maera-restaurant' ), 'priority' => 40, 'panel' => 'maera_res_layout'  ),
				'maera_res_about'        => array( 'title' => __( 'About', 'maera-restaurant' ), 'priority' => 45, 'panel' => 'maera_res_layout'  ),
				'maera_res_restaurant'   => array( 'title' => __( 'Restaurant', 'maera-restaurant' ), 'priority' => 50, 'panel' => 'maera_res_layout'  ),
				'maera_res_blog'         => array( 'title' => __( 'Blog', 'maera-restaurant' ), 'priority' => 55, 'panel' => 'maera_res_layout'  ),
				'maera_res_events'       => array( 'title' => __( 'Events', 'maera-restaurant' ), 'priority' => 60, 'panel' => 'maera_res_layout'  ),
				'maera_res_testimonials' => array( 'title' => __( 'Testimonials', 'maera-restaurant' ), 'priority' => 65, 'panel' => 'maera_res_layout'  ),
				'maera_res_social'       => array( 'title' => __( 'Social', 'maera-restaurant' ), 'priority' => 70, 'panel' => 'maera_res_layout'  ),

				// Styling
				'maera_res_colors'       => array( 'title' => __( 'Colors', 'maera-restaurant' ), 'priority' => 75, 'panel' => 'maera_res_styling' ),
				'maera_res_typography'   => array( 'title' => __( 'Typography', 'maera-restaurant' ), 'priority' => 80, 'panel' => 'maera_res_styling' ),
				'maera_res_navigation'   => array( 'title' => __( 'Navigation', 'maera-restaurant' ), 'priority' => 85, 'panel' => 'maera_res_styling' ),

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
		 * Maera Restaurant Slider Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_slider_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_slider_section',
				'label'    => __( 'Show Slider', 'maera-restaurant' ),
				'section'  => 'maera_res_slider',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'slider_background',
				'label'        => __( 'Slider Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the slider section.', 'maera-restaurant' ),
				'section'      => 'maera_res_slider',
				'default'      => array(
					'color'    => '#222222',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/menu.png',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#slider',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant About Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_about_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_about_section',
				'label'    => __( 'Show About', 'maera-restaurant' ),
				'section'  => 'maera_res_about',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'about_background',
				'label'        => __( 'About Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the about section.', 'maera-restaurant' ),
				'section'      => 'maera_res_about',
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
				'output' => '#about',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Food & Drink (Restaurant) Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_restaurant_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_menu_section',
				'label'    => __( 'Show Menu', 'maera-restaurant' ),
				'section'  => 'maera_res_restaurant',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'menu_background',
				'label'        => __( 'Menu Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the menu section.', 'maera-restaurant' ),
				'section'      => 'maera_res_restaurant',
				'default'      => array(
					'color'    => '#ebe1d7',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/menu.png',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 85,
				),
				'priority' => 2,
				'output' => '#menu',
			);

			$controls[] = array(
					'type'     => 'select',
					'setting'  => 'currency',
					'label'    => __( 'Select a currency to use for the restaurant.', 'maera_bs' ),
					'section'  => 'maera_res_restaurant',
					'default'  => 'United States dollar',
					'priority' => 10,
					'choices'  => null, // Maera_Restaurant_Data::get_currencies(),  // Needs fixed.
				);

				return $controls;
		}


		/**
		 * Maera Restaurant Blog Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_blog_settings( $controls ) {

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'latest_posts_background',
				'label'        => __( 'Latest Posts Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the latest posts section.', 'maera-restaurant' ),
				'section'      => 'maera_res_blog',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/recipes.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 1,
				'output' => '#latest-posts',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Event Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_events_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_events_section',
				'label'    => __( 'Show Events', 'maera-restaurant' ),
				'section'  => 'maera_res_events',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'events_background',
				'label'        => __( 'Events Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the events section.', 'maera-restaurant' ),
				'section'      => 'maera_res_events',
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
				'output' => '#about',
			);

			 return $controls;

		}


		/**
		 * Maera Restaurant Testimonial Settings
		 * @since 1.0.0
		 * @param  [type] $controls [description]
		 * @return [type]           [description]
		 */
		function maera_res_testimonial_settings( $controls ) {

			$controls[] = array(
				'type'     => 'radio',
				'mode'     => 'buttonset',
				'setting'  => 'show_testimonials_section',
				'label'    => __( 'Show Testimonials', 'maera-restaurant' ),
				'section'  => 'maera_res_testimonials',
				'default'  => 1,
				'priority' => 1,
				'choices'  => array(
					1 => __( 'On', 'maera-restaurant' ),
					0 => __( 'Off', 'maera-restaurant' ),
				),
			);

			$controls[] = array(
				'type'         => 'background',
				'setting'      => 'testimonials_posts_background',
				'label'        => __( 'Testimonials Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the testimonials section.', 'maera-restaurant' ),
				'section'      => 'maera_res_testimonials',
				'default'      => array(
					'color'    => '#ffffff',
					'image'    => MAERA_RES_SHELL_URL . '/assets/img/backgrounds/testimonials.jpg',
					'repeat'   => 'none',
					'size'     => 'cover',
					'attach'   => 'fixed',
					'position' => 'center-center',
					'opacity'  => 100,
				),
				'priority' => 2,
				'output' => '#testimonials',
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
				'type'         => 'background',
				'setting'      => 'social_background',
				'label'        => __( 'Social Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the social section.', 'maera-restaurant' ),
				'section'      => 'maera_res_social',
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
				'output' => '#about',
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
				'setting'      => 'content_background',
				'label'        => __( 'Main Content Background', 'maera-restaurant' ),
				'description'  => __( 'Set the background options for the main content sections.', 'maera-restaurant' ),
				'section'      => 'maera_res_backgrounds',
				'default'      => array(
					'color'    => '#000000',
					'image'    => null,
					'repeat'   => 'repeat',
					'size'     => 'inherit',
					'attach'   => 'inherit',
					'position' => 'left-top',
					'opacity'  => 75,
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

<?php

/**
* Maera Restaurant Widget Areas Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Widget_Areas(), Maera_Restaurant_Widget_Areas::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Widget_Areas' ) ) {

	class Maera_Restaurant_Widget_Areas {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			$widget_widths = new Maera_Widget_Dropdown_Class(
				array(
					'id'      => 'maera_res_width',
					'label'   => __( 'Width', 'maera-restaurant' ),
					'choices' => Maera_Restaurant_Data::widget_widths(),
					'default' => '12',
				)
			);

			// Add Actions
			add_action( 'widgets_init', array( $this, 'maera_res_widgets_init' ) );

			// Add Filters
			add_filter( 'maera/widgets/class', array( $this, 'widget_class' ) );
			add_filter( 'maera/widgets/title/before', array( $this, 'widget_title_before' ) );
			add_filter( 'maera/widgets/title/after', array( $this, 'widget_title_after' ) );
			add_filter( 'maera/widgets/before', array( $this, 'widget_before' ) );
			add_filter( 'maera/widgets/after', array( $this, 'widget_after' ) );
		}

		/**
		 * [maera_res_widgets_init description]
		 * @return [type] [description]
		 */
		function maera_res_widgets_init() {

			$class        = apply_filters( 'maera/widgets/class', '' );
			$before_title = apply_filters( 'maera/widgets/title/before', '<h3 class="widget-title">' );
			$after_title  = apply_filters( 'maera/widgets/title/after', '</h3>' );

			register_sidebar( array(
				'name'          => 'First Section',
				'id'            => 'section_1',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => 'Second Section',
				'id'            => 'section_2',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => 'Third Section',
				'id'            => 'section_3',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => 'Fourth Section',
				'id'            => 'section_4',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => 'Fifth Section',
				'id'            => 'section_5',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => 'Footer',
				'id'            => 'footer',
				'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '<div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}


		/**
		 * [widget_class description]
		 * @return [type] [description]
		 */
		function widget_class() {
			return 'panel';
		}


		/**
		 * [widget_title_before description]
		 * @return [type] [description]
		 */
		function widget_title_before() {
			return '<span class="widget-title">';
		}


		/**
		 * [widget_title_after description]
		 * @return [type] [description]
		 */
		function widget_title_after() {
			return '</span>';
		}


		/**
		 * [widget_before description]
		 * @param  [type] $content [description]
		 * @return [type]          [description]
		 */
		function widget_before( $content ) {
			return $content . '<div class="widget-content">';
		}


		/**
		 * [widget_after description]
		 * @return [type] [description]
		 */
		function widget_after() {
			return '</div></section>';
		}

		// End Methods
	} // End Class
} // End if

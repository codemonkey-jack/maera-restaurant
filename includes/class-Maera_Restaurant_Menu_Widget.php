<?php

/**
* Maera Restaurant Slider Widget Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Menu_Widget(), Maera_Restaurant_Menu_Widget::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Menu_Widget' ) ) {

	class Maera_Restaurant_Menu_Widget extends WP_Widget {

		/**
		 * Add the widget to the back end.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function __construct() {
			parent::__construct(
				'maera_res_menu_widget',
				__( 'Maera Restaurant - Menu', 'maera' ),
				array( 'description' => __( 'Maera Restaurant menu widget.', 'maera' ) )
			);
		}


		/**
		 * Render the menu widget.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function widget( $args, $instance ) {
			extract( $args );

			$query_args = array(
				'post_type'       => 'restaurant_item',
				'tax_query'       => 'restaurant_tag',
			);

			$widget = array(
				'title'           => apply_filters( 'widget_title', $instance['title'] ),
				'before_widget'   => $before_widget,
				'after_widget'    => $after_widget,
				'before_title'    => $before_title,
				'after_title'     => $after_title,
			);

			$context              = Maera()->cache->get_context();
			$context['post']      = Timber::query_post();
			$context['posts']     = Timber::get_posts( $query_args );
			$context['widget']    = $widget;

			Timber::render(
				'menu.twig',
				$context,
				Maera()->cache->cache_duration()
			);

			wp_reset_query();
		}


		/**
		 * Widget instance update.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function update( $new_instance, $old_instance ) {

			$instance                    = $old_instance;
			$instance['title']           = strip_tags( $new_instance['title'] );

			return $instance;
		}


		/**
		 * Render the widget form controls.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function form( $instance ) {
			$defaults = array(
				'title'            => 'Our Menu',
			);

			$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

			<?php _e( 'Title:','maera' ); ?>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" /></td>

			<table style="margin-top: 10px;">


			</table>
			<?php
		}


		// End Methods
	} // End Class
} // End if

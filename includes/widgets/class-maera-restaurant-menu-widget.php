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
				__( 'Maera Restaurant - Menu', 'maera-restaurant' ),
				array( 'description' => __( 'Maera Restaurant menu widget.', 'maera-restaurant' ) )
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
				'posts_per_page'  => $instance['per_page'],
			);

			$widget = array(
				'title'                  => apply_filters( 'widget_title', $instance['title'] ),
				'show_price'             => $instance['show_price'],
				'show_featured_images'   => $instance['show_featured_images'],
				'show_tags'              => $instance['show_tags'],
				'show_menu_link'         => $instance['show_menu_link'],
				'before_widget'          => $before_widget,
				'after_widget'           => $after_widget,
				'before_title'           => $before_title,
				'after_title'            => $after_title,
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

			wp_reset_postdata();
		}


		/**
		 * Widget instance update.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function update( $new_instance, $old_instance ) {

			$instance                           = $old_instance;
			$instance['title']                  = strip_tags( $new_instance['title'] );
			$instance['per_page']               = strip_tags( $new_instance['per_page'] );
			$instance['show_price']             = isset( $new_instance['show_price'] );
			$instance['show_featured_images']   = isset( $new_instance['show_featured_images'] );
			$instance['show_tags']              = isset( $new_instance['show_tags'] );
			$instance['show_menu_link']         = isset( $new_instance['show_menu_link'] );

			return $instance;
		}


		/**
		 * Render the widget form controls.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function form( $instance ) {
			$defaults = array(
				'title'                  => 'Our Menu',
				'per_page'               => 9,
				'show_price'             => 1,
				'show_featured_images'   => 1,
				'show_tags'              => 1,
				'show_menu_link'         => 1,
			);

			$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

			<?php _e( 'Title:','maera' ); ?>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" /></td>

			<table style="margin-top: 10px;">
				<tr>
					<td><?php _e( 'Number of menu items to display.','maera-restaurant' ); ?></td>
					<td><input id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'per_page' ); ?>" value="<?php echo $instance['per_page']; ?>" type="number" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['show_price'] ) ? $instance['show_price'] : 0 ); ?> id="<?php echo $this->get_field_id( 'show_price' ); ?>" name="<?php echo $this->get_field_name( 'show_price' ); ?>" />
						<?php _e( 'Show Price?','maera-restaurant' ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['show_featured_images'] ) ? $instance['show_featured_images'] : 0 ); ?> id="<?php echo $this->get_field_id( 'show_featured_images' ); ?>" name="<?php echo $this->get_field_name( 'show_featured_images' ); ?>" />
						<?php _e( 'Show featured images?','maera-restaurant' ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['show_tags'] ) ? $instance['show_tags'] : 0 ); ?> id="<?php echo $this->get_field_id( 'show_tags' ); ?>" name="<?php echo $this->get_field_name( 'show_tags' ); ?>" />
						<?php _e( 'Show tags?','maera-restaurant' ); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['show_menu_link'] ) ? $instance['show_menu_link'] : 0 ); ?> id="<?php echo $this->get_field_id( 'show_menu_link' ); ?>" name="<?php echo $this->get_field_name( 'show_menu_link' ); ?>" />
						<?php _e( 'Show link to menu page?','maera-restaurant' ); ?>
					</td>
				</tr>
			</table>
			<?php
		}

		// End Methods
	} // End Class
} // End if

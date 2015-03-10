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
* @see           Maera_Restaurant_Slider_Widget(), Maera_Restaurant_Slider_Widget::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Slider_Widget' ) ) {

	class Maera_Restaurant_Slider_Widget extends WP_Widget {

		/**
		 * Add the widget to the back end.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function __construct() {
			parent::__construct(
				'maera_res_slider_widget',
				__( 'Maera Restaurant - Slider', 'maera' ),
				array( 'description' => __( 'Maera slider widget.', 'maera' ) )
			);
		}


		/**
		 * Render the slider widget.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function widget( $args, $instance ) {
			extract( $args );

			$query_args = array(
				'post_type'       => 'slide',
				'posts_per_page'  => $instance['per_page'],
				'offset'          => $instance['offset'],
			);

			$widget = array(
				'interval'        => $instance['interval'],
				'pause'           => $instance['pause'],
				'wrap'            => $instance['wrap'],
				'parallax'        => $instance['parallax'],
				'second_image'    => $instance['second_image'],
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
				'slider.twig',
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
			$instance['per_page']        = strip_tags( $new_instance['per_page'] );
			$instance['offset']          = strip_tags( $new_instance['offset'] );
			$instance['interval']        = strip_tags( $new_instance['interval'] );
			$instance['pause']           = isset( $new_instance['pause'] );
			$instance['wrap']            = isset( $new_instance['wrap'] );
			$instance['parallax']        = isset( $new_instance['parallax'] );
			$instance['second_image']        = isset( $new_instance['second_image'] );

			return $instance;
		}


		/**
		 * Render the widget form controls.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function form( $instance ) {
			$defaults = array(
				'per_page'         => 5,
				'offset'           => 0,
				'interval'         => 2500,
				'pause'            => 'hover',
				'wrap'             => 1,
				'parallax'         => 1,
				'second_image'     => 1,
			);
			$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

			<table style="margin-top: 10px;">
				<tr>
					<td><?php _e( 'Number of slides to display','maera-restaurant' ); ?></td>
					<td><input id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'per_page' ); ?>" value="<?php echo $instance['per_page']; ?>" type="number" /></td>
				</tr>
				<tr>
					<td><?php _e( 'Offset','maera-restaurant' ); ?></td>
					<td><input id="<?php echo $this->get_field_id( 'per_page' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" value="<?php echo $instance['offset']; ?>" type="number" /></td>
				</tr>

				<tr>
					<td><?php _e( 'Interval (ms)','maera-restaurant' ); ?></td>
					<td><input id="<?php echo $this->get_field_id( 'interval' ); ?>" name="<?php echo $this->get_field_name( 'interval' ); ?>" value="<?php echo $instance['interval']; ?>" type="number" /></td>
				</tr>

				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['pause'] ) ? $instance['pause'] : 0  ); ?> id="<?php echo $this->get_field_id( 'pause' ); ?>" name="<?php echo $this->get_field_name( 'pause' ); ?>" />
						<?php _e( 'Pause on hover?','maera-restaurant' ); ?>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['wrap'] ) ? $instance['wrap'] : 0  ); ?> id="<?php echo $this->get_field_id( 'wrap' ); ?>" name="<?php echo $this->get_field_name( 'wrap' ); ?>" />
							<?php _e( 'Cycle slider continually?','maera-restaurant' ); ?>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['parallax'] ) ? $instance['parallax'] : 0  ); ?> id="<?php echo $this->get_field_id( 'parallax' ); ?>" name="<?php echo $this->get_field_name( 'parallax' ); ?>" />
							<?php _e( 'Enable Parallax?','maera-restaurant' ); ?>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input class="checkbox" type="checkbox" <?php checked( isset( $instance['second_image'] ) ? $instance['second_image'] : 0  ); ?> id="<?php echo $this->get_field_id( 'second_image' ); ?>" name="<?php echo $this->get_field_name( 'second_image' ); ?>" />
							<?php _e( 'Enable Overlay Image?','maera-restaurant' ); ?>
					</td>
				</tr>

			</table>
			<?php
		}


		// End Methods
	} // End Class
} // End if

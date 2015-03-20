<?php

/**
* Maera Restaurant Social Widget Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch, Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_Social_widget(), Maera_Restaurant_Social_widget::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_Social_widget' ) ) {

	class Maera_Restaurant_Social_widget extends WP_Widget {


		/**
		 * Add the widget to the back end.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function __construct() {

			parent::__construct(
				'maera_res_social_widget',
				__( 'Maera Restaurant - Social Widget', 'maera-restaurant' ),
				array( 'description' => __( 'Links to social pages and can be placed in any widget area.', 'maera-restaurant' ), )
			);

		}


		/**
		 * Render the social widget.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function widget( $args, $instance ) {

			extract( $args );

			$title = apply_filters( 'widget_title', $instance['title'] );

			_e( $args['before_widget'] );

			if ( ! empty( $title ) ){
				_e( $args['before_title'] . $title . $args['after_title'] );
			}

			$widget = array(
				'title'                 => apply_filters( 'widget_title', $instance['title'] ),
				'icon_size'             => $instance['icon_size'],
				'before_widget'         => $before_widget,
				'after_widget'          => $after_widget,
				'before_title'          => $before_title,
				'after_title'           => $after_title,
			);

			$context                    = Maera()->cache->get_context();
			$context['widget']          = $widget;

			$context['facebook_icon']   = '<i class="fa fa-facebook fa-'.$instance['icon_size'].'"></i>';
			$context['twitter_icon']    = '<i class="fa fa-twitter fa-'.$instance['icon_size'].'"></i>';
			$context['googleplus_icon'] = '<i class="fa fa-google-plus fa-'.$instance['icon_size'].'"></i>';
			$context['youtube_icon']    = '<i class="fa fa-youtube fa-'.$instance['icon_size'].'"></i>';

			Maera()->template->render( 'social-icons.twig', $context );
			_e( $args['after_widget'] );
		}


		/**
		 * Widget instance update.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function update( $new_instance, $old_instance ) {

			$instance                        = $old_instance;
			$instance['title']               = strip_tags( $new_instance['title'] );
			$instance['icon_size']           = strip_tags( $new_instance['icon_size'] );

			return $instance;
		}


		/**
		 * Render the widget form controls.
		 * @todo TODO
		 * @since 1.0.0
		 */
		function form( $instance ) {
			$defaults = array(
				'title'                  => 'Let\'s Get Social',
				'icon_size'              => 'lg',
			);

			$instance  = wp_parse_args( (array) $instance, $defaults );
			$title     = $instance['title'];
			$icon_size = $instance['icon_size'];
			?>

			<?php _e( 'Title:','maera' ); ?>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" type="text" /></td>

			<table style="margin-top: 10px;">
				<tr>
					<td><?php _e( 'Icon Size.','maera-restaurant' ); ?></td>
					<td>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" type="text">
							<option value='lg'<?php echo ( $icon_size == 'lg' ) ? 'selected' : ''; ?>> lg </option>
							<option value='2x'<?php echo ( $icon_size == '2x' ) ? 'selected' : ''; ?>> 2x </option>
							<option value='3x'<?php echo ( $icon_size == '3x' ) ? 'selected' : ''; ?>> 3x </option>
							<option value='4x'<?php echo ( $icon_size == '4x' ) ? 'selected' : ''; ?>> 4x </option>
							<option value='5x'<?php echo ( $icon_size == '5x' ) ? 'selected' : ''; ?>> 5x </option>
						</select>
					</td>
				</tr>
			</table>
			<?php
		}

		// End Methods
	}  // End Class
}     // End If

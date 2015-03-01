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
		 * @param  [type] $args     [description]
		 * @param  [type] $instance [description]
		 * @return [type]           [description]
		 * @todo TODO
		 * @since 1.0.0
		 */
		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );

			echo _e( $args['before_widget'] );

			if ( ! empty( $title ) ){
				echo _e( $args['before_title'] . $title . $args['after_title'] );
			}

			$context['facebook_link']   = get_theme_mod( 'facebook_link','http://facebook.com/' );
			$context['twitter_link']    = get_theme_mod( 'twitter_link','http://twitter.com/' );
			$context['googleplus_link'] = get_theme_mod( 'googleplus_link','http://plus.google.com/' );
			$context['youtube_link']    = get_theme_mod( 'youtube_link','http://youtube.com' );

			$context['facebook_icon']   = '<i class="fa fa-facebook fa-lg"></i>';
			$context['twitter_icon']    = '<i class="fa fa-twitter fa-lg"></i>';
			$context['googleplus_icon'] = '<i class="fa fa-google-plus fa-lg"></i>';
			$context['youtube_icon']    = '<i class="fa fa-youtube fa-lg"></i>';

			Maera()->template->render( 'social-icons.twig', $context );
			echo _e( $args['after_widget'] );
		}

		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'Social Widget', 'maera-restaurant' );
			}
		?>
		<p>
			<label for="<?php _e( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php _e( $this->get_field_id( 'title' ) ); ?>" name="<?php _e( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}


		// End Methods
	}  // End Class
}     // End If

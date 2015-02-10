<?php

/**
* Maera Restaurant Meta Box Class
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
if ( ! class_exists( 'Maera_Restaurant_Widget_Box' ) ) {

	class Maera_Restaurant_Widget_Box {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			// Add Actions
			add_action( 'do_meta_boxes', array( $this, 'slides_image_box') );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );

			// Add Filters
			// NULL
		}


		/**
		 * Adds the meta box container.
		 */
		public function add_meta_box( $post_type ) {
			$post_types = array( 'restaurant_item' );
			if ( in_array( $post_type, $post_types ) ) {
				add_meta_box(
					'maera_res_menu_section',
					__( 'Menu Section', 'maera-restaurant' ),
					array( $this, 'render_meta_box_content' ),
					$post_type,
					'normal',
					'high'
				);
			}
		}


		/**
		 * Save the meta box values.
		 * @param  int $post_id The ID of the post being saved.
		 * @return [type]          [description]
		 */
		public function save( $post_id ) {

			if ( ! isset( $_POST['maera_res_inner_custom_box_nonce'] ) ){
				return $post_id;
			}

			$nonce = $_POST['maera_res_inner_custom_box_nonce'];

			if ( ! wp_verify_nonce( $nonce, 'maera_res_inner_custom_box' ) ){
				return $post_id;
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
				return $post_id;
			}

			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ){
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ){
					return $post_id;
				}
			}

			$menu_section = sanitize_text_field( $_POST['maera_res_new_field'] );

			update_post_meta( $post_id, '_res_meta_value_key', $menu_section );
		}


		/**
		 * Render meta box content.
		 * @param  WP_Post $post The post object.
		 * @return [type]       [description]
		 */
		public function render_meta_box_content( $post ) {

			wp_nonce_field( 'maera_res_inner_custom_box', 'maera_res_inner_custom_box_nonce' );

			$value = get_post_meta( $post->ID, '_res_meta_value_key', true );

			echo '<label for="maera_res_section_field">';
			_e( 'Specify the section for the menu item (e.g. First Courses, Entrée, Bar) ', 'maera-restaurant' );
			echo '</label> ';
			echo '<input type="text" id="maera_res_section_field" name="maera_res_section_field"';
					echo ' value="' . esc_attr( $value ) . '" size="35"  class="required"/>';
		}


		/**
		 * Move the featured image box from the side to the main area when editing slides.
		 * @return [type] [description]
		 */
		function slides_image_box() {

			$screen = get_current_screen();

			if ( 'slide' == $screen->post_type ) {
				remove_meta_box( 'postimagediv', 'slide', 'side' );
				add_meta_box( 'postimagediv', __( 'Slide Image' ), 'post_thumbnail_meta_box', 'slide', 'normal', 'high' );
			}

		}

		// End Methods
	} // End Class
} // End if

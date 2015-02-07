<?php

/**
* Maera Restaurant Post Types Class
*
* @category      Plugin
* @package       Maera Shell
* @author        Brian C. Welch <contact@briancwelch.com>
* @copyright     2015 Brian C. Welch. Press.Codes, Maera
* @license       http://opensource.org/licenses/MIT MIT License
* @version       Development: @MAERA_RES_VER@
* @link          http://press.codes
* @see           Maera_Restaurant_PostTypes(), Maera_Restaurant_PostTypes::method()
* @since         Class available since Release 1.0.0
*
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the class already exists.
if ( ! class_exists( 'Maera_Restaurant_PostTypes' ) ) {

	class Maera_Restaurant_PostTypes {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			// Add actions.
			add_action( 'init',  array( $this, 'maera_res_slides' ) );
			add_action( 'do_meta_boxes', array( $this, 'slides_image_box') );

			// Add filters.
			add_filter( 'post_updated_messages',  array( $this, 'maera_res_slides_messages' ) );
		}

		/**
		 * Add Slides custom post type
		 * @return [type] [description]
		 */
		function maera_res_slides() {

			$postlabels = array(
				'name'               => _x( 'Slides', 'post type general name' ),
				'singular_name'      => _x( 'Slide', 'post type singular name' ),
				'add_new'            => _x( 'Add New Slide', 'slide' ),
				'add_new_item'       => __( 'Add New Slide' ),
				'edit_item'          => __( 'Edit Slide' ),
				'new_item'           => __( 'New Slide' ),
				'view_item'          => __( 'View Slide' ),
				'search_items'       => __( 'Search Slides' ),
				'not_found'          => __( 'No slides found' ),
				'not_found_in_trash' => __( 'No slides found in trash.' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Slides',
		  	);

		 	$args = array(
				'labels'             => $postlabels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => true,
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'          => 'dashicons-format-gallery',
				'supports'           => array( 'title', 'thumbnail', 'excerpt', 'comments', 'post-formats' ),
		  	);

			register_post_type( 'slide',$args );

			// Taxonomy Labels
			$taxlabels = array(
				'name'               => _x( 'Tags', 'taxonomy general name' ),
				'singular_name'      => _x( 'Tag', 'taxonomy singular name' ),
				'search_items'       => __( 'Search Types' ),
				'all_items'          => __( 'All Tags' ),
				'parent_item'        => __( 'Parent Tag' ),
				'parent_item_colon'  => __( 'Parent Tag:' ),
				'edit_item'          => __( 'Edit Tags' ),
				'update_item'        => __( 'Update Tag' ),
				'add_new_item'       => __( 'Add New Tag' ),
				'new_item_name'      => __( 'New Tag Name' ),
			);

			// Custom Taxonomy Tags
			register_taxonomy('tagslide',array('slide'),
				array(
					'hierarchical'   => true,
					'labels'         => $taxlabels,
					'show_ui'        => true,
					'query_var'      => true,
					'rewrite'        => array( 'slug' => 'tag-slide' ),
				));
		}


		/**
		 * Custom slide post type messages.
		 * @param  [type] $messages [description]
		 * @return [type]           [description]
		 */
		function maera_res_slides_messages( $messages ) {

			global $post, $post_ID;

			$messages['slide'] = array(
				0     => '', // Unused. Messages start at index 1.
				1     => sprintf( __( 'Slide updated. <a href="%s">View slide</a>' ), esc_url( get_permalink( $post_ID ) ) ),
				2     => __( 'Custom field updated.' ),
				3     => __( 'Custom field deleted.' ),
				4     => __( 'Slide updated.' ),
				5     => isset( $_GET[ 'revision' ] ) ? sprintf( __( 'Slide restored to revision from %s' ), wp_post_revision_title( ( int ) $_GET[ 'revision' ], false ) ) : false, // input var okay
				6     => sprintf( __( 'Slide published. <a href="%s">View slide</a>' ), esc_url( get_permalink( $post_ID ) ) ),
				7     => __( 'Slide saved.' ),
				8     => sprintf( __( 'Slide submitted. <a target="_blank" href="%s">Preview slide</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
				9     => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>' ),
			  	date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
				10    => sprintf( __( 'Slide draft updated. <a target="_blank" href="%s">Preview slide</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			);
			return $messages;
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

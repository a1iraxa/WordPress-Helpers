<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Tutorial_Post_Type
 *
 * @class Tutorial_Post_Type
 * @package Tutorial/Classes/Post_Types
 * @author Pragmatic Mates
 */
class Tutorial_Post_Type {
	/**
	 * Initialize custom post type
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'fields' ) );
	}

	/**
	 * Custom post type definition
	 *
	 * @access public
	 * @return void
	 */
	public static function definition() {
	    $labels = array(
	        'name'               => __('Tutorials', 'tutorial'),
	        'singular_name'      => __('Tutorial', 'tutorial'),
	        'menu_name'          => __('Tutorials', 'tutorial'),
	        'name_admin_bar'     => __('Tutorials', 'tutorial'),
	        'parent_item_colon'  => __('Parent Tutorial:', 'tutorial'),
	        'all_items'          => __('All Tutorials', 'tutorial'),
	        'add_new_item'       => __('Add New Tutorial', 'tutorial'),
	        'add_new'            => __('Add New Tutorial', 'tutorial'),
	        'new_item'           => __('New Tutorial', 'tutorial'),
	        'edit_item'          => __('Edit Tutorial', 'tutorial'),
	        'update_item'        => __('Update Tutorial', 'tutorial'),
	        'view_item'          => __('View Tutorial', 'tutorial'),
	        'search_items'       => __('Search Tutorial', 'tutorial'),
	        'not_found'          => __('No Tutorial Found', 'tutorial'),
	        'not_found_in_trash' => __('No Tutorial found in Trash', 'tutorial'),
	    );
	    $args = array(
	        'label'               => __('Tutorial', 'tutorial'),
	        'description'         => __('Custom post type for Tutorials', 'tutorial'),
	        'labels'              => $labels,
	        'supports'            => array('title', 'editor', 'thumbnail'),
	        'taxonomies'          => array('post-tag'),
	        'hierarchical'        => true,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'menu_position'       => 7,
	        'menu_icon'           => 'dashicons-admin-settings',
	        'show_in_admin_bar'   => true,
	        'show_in_nav_menus'   => true,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'page',
	    );
	    register_post_type('tutorials', $args);
	}

	/**
	 * Defines custom fields
	 *
	 * @access public
	 * @param array $metaboxes
	 * @return array
	 */
	public static function fields( array $metaboxes ) {
		$prefix = '_tutorials_';
		$metaboxes[ prefix . 'general' ] = array(
			'id'                        => prefix . 'metabox',
			'title'                     => __( 'General Options', 'tutorials' ),
			'object_types'              => array( 'tutorials' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => array(
				array(
			        'name' => __('Font Class', 'tutorials'),
			        'id'   => $prefix . 'fa_class',
			        'type' => 'text',
			    ),
			),
		);
		return $metaboxes;
	}
}

Tutorial_Post_Type::init();

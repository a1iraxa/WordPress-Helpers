<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class New_Post_Type
 *
 * @class New_Post_Type
 * @package News/Classes/Post_Types
 * @author Pragmatic Mates
 */
class New_Post_Type {
	/**
	 * Initialize custom post type
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
	}

	/**
	 * Custom post type definition
	 *
	 * @access public
	 * @return void
	 */
	public static function definition() {
	    $labels = array(
	        'name'               => __('News', 'tutorial'),
	        'singular_name'      => __('News', 'tutorial'),
	        'menu_name'          => __('News', 'tutorial'),
	        'name_admin_bar'     => __('News', 'tutorial'),
	        'parent_item_colon'  => __('Parent News:', 'tutorial'),
	        'all_items'          => __('All News', 'tutorial'),
	        'add_new_item'       => __('Add New News', 'tutorial'),
	        'add_new'            => __('Add New News', 'tutorial'),
	        'new_item'           => __('New News', 'tutorial'),
	        'edit_item'          => __('Edit News', 'tutorial'),
	        'update_item'        => __('Update News', 'tutorial'),
	        'view_item'          => __('View News', 'tutorial'),
	        'search_items'       => __('Search News', 'tutorial'),
	        'not_found'          => __('No News Found', 'tutorial'),
	        'not_found_in_trash' => __('No News found in Trash', 'tutorial'),
	    );
	    $args = array(
	        'label'               => __('News', 'tutorial'),
	        'description'         => __('Custom post type for News', 'tutorial'),
	        'labels'              => $labels,
	        'supports'            => array('title', 'editor', 'thumbnail', 'comments'),
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
	    register_post_type('news', $args);
	}
}

New_Post_Type::init();

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Speakers_Post_Typ
 *
 * @class Speakers_Post_Typ
 * @package Speaker/Classes/Post_Types
 * @author Pragmatic Mates
 */
class Speakers_Post_Typ {
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
	        'name'               => __('Speakers', 'tutorial'),
	        'singular_name'      => __('Speaker', 'tutorial'),
	        'menu_name'          => __('Speakers', 'tutorial'),
	        'name_admin_bar'     => __('Speakers', 'tutorial'),
	        'parent_item_colon'  => __('Parent Speaker:', 'tutorial'),
	        'all_items'          => __('All Speakers', 'tutorial'),
	        'add_new_item'       => __('Add New Speaker', 'tutorial'),
	        'add_new'            => __('Add New Speaker', 'tutorial'),
	        'new_item'           => __('New Speaker', 'tutorial'),
	        'edit_item'          => __('Edit Speaker', 'tutorial'),
	        'update_item'        => __('Update Speaker', 'tutorial'),
	        'view_item'          => __('View Speaker', 'tutorial'),
	        'search_items'       => __('Search Speaker', 'tutorial'),
	        'not_found'          => __('No Speaker Found', 'tutorial'),
	        'not_found_in_trash' => __('No Speaker found in Trash', 'tutorial'),
	    );
	    $args = array(
	        'label'               => __('Speaker', 'tutorial'),
	        'description'         => __('Custom post type for Speakers', 'tutorial'),
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
	    register_post_type('speckers', $args);
	}

	/**
	 * Defines custom fields
	 *
	 * @access public
	 * @param array $metaboxes
	 * @return array
	 */
	public static function fields( array $metaboxes ) {
		$prefix = '_speckers_';

		$qualification_fields = array(
	        array( 
	            'id' => $prefix . 'qualification_title',
	            'name' => 'Qualification',
	            'type' => 'text' 
	            ),
	    );
	    $qualification_group_fields = $qualification_fields;
		foreach ( $qualification_group_fields as &$field )
		 {
		    $field['id'] = str_replace( 'field', 'gfield', $field['id'] );
		}
		$social_fields = array(
	        array( 
	            'id' => $prefix . 'fa_class',
	            'name' => 'Awesome Font Class',
	            'type' => 'text',
	            'desc' => 'e.g: fa-facebook',
	            ),
	        array( 
	            'id' => $prefix . 'media_link',
	            'name' => 'URL',
	            'type' => 'text_url' ,
	            'desc' => 'e.g: http://facebook.com/',
	            ),
	    );
	    $social_group_fields = $social_fields;
		foreach ( $social_group_fields as &$field )
		 {
		    $field['id'] = str_replace( 'field', 'gfield', $field['id'] );
		}

		$metaboxes[ prefix . 'general' ] = array(
			'id'                        => prefix . 'metabox',
			'title'                     => __( 'General Options', 'speckers' ),
			'object_types'              => array( 'speckers' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => array(
				array(
			        'name' => __('Company', 'speckers'),
			        'id'   => $prefix . 'company',
			        'type' => 'text',
			    ),
				array(
			        'name' => __('Designation', 'speckers'),
			        'id'   => $prefix . 'designation',
			        'type' => 'text',
			    ),
			    array(
	                'id' => $prefix .'social', 
	                'name' => 'Social Media',
	                'description' => 'Speaker Social Media', 'cmb' ,
	                'options'     => array(
						'group_title'   => __( 'Social Media {#}', 'cmb' ), 
						'add_button'    => __( 'Add New Social Media', 'cmb' ),
						'remove_button' => __( 'Remove Social Media', 'cmb' ),
						'sortable'      => false, // beta
					),
	                'type' => 'group',
	                'repeatable' => true,
	                'sortable' => false,
	                'fields' => $social_group_fields
	            ),
			    array(
	                'id' => $prefix .'qualifications', 
	                'name' => 'Qualification',
	                'description' => 'Speaker Qualification', 'cmb' ,
	                'options'     => array(
						'group_title'   => __( 'Qualification {#}', 'cmb' ), 
						'add_button'    => __( 'Add New Qualification', 'cmb' ),
						'remove_button' => __( 'Remove Qualification', 'cmb' ),
						'sortable'      => false, // beta
					),
	                'type' => 'group',
	                'repeatable' => true,
	                'sortable' => false,
	                'fields' => $qualification_group_fields
	            ),
			),
		);
		return $metaboxes;
	}
}

Speakers_Post_Typ::init();
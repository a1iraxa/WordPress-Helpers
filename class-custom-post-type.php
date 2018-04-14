<?php 

if ( ! defined('ABSPATH') ) {
	die('Kidding not allowed...!');
}

/**
* Class News_Post_Type
* @package FooBar
* @since 1.0.0
* @author a1iraxa
*/
class News_Post_Type
{
	private $_prefix;
	
	function __construct() {
		$this->_prefix = '_news_';

		add_action('init', array( $this, 'definition' ) );
		// add_action('init', array( __CLASS__, 'definition' ) ); //for static method
		add_filter('cmb2_meta_boxes', array( $this, 'custom_meta_boxes_for_fields'));
	}

	public function definition()
	{
		$labels = array(
		    'name'               => __('News', 'foo-bar'),
		    'singular_name'      => __('News', 'foo-bar'),
		    'menu_name'          => __('News', 'foo-bar'),
		    'name_admin_bar'     => __('News', 'foo-bar'),
		    'parent_item_colon'  => __('Parent News:', 'foo-bar'),
		    'all_items'          => __('All News', 'foo-bar'),
		    'add_new_item'       => __('Add New News', 'foo-bar'),
		    'add_new'            => __('Add New News', 'foo-bar'),
		    'new_item'           => __('New News', 'foo-bar'),
		    'edit_item'          => __('Edit News', 'foo-bar'),
		    'update_item'        => __('Update News', 'foo-bar'),
		    'view_item'          => __('View News', 'foo-bar'),
		    'search_items'       => __('Search News', 'foo-bar'),
		    'not_found'          => __('No News Found', 'foo-bar'),
		    'not_found_in_trash' => __('No News found in Trash', 'foo-bar'),
		);
		$args = array(
		    'label'               => __('News', 'foo-bar'),
		    'description'         => __('Custom post type for News', 'foo-bar'),
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
		register_post_type('foo-bar-news', $args);
	}
	
	public function custom_meta_boxes_for_fields(array $metaboxes)
	{
		$headline_fields = array(
	        array( 
	            'id' => $this->_prefix . 'headline_title',
	            'name' => 'Awesome Font Class',
	            'type' => 'text',
	            'desc' => 'Headline title',
	            ),
	        array( 
	            'id' => $this->_prefix . 'headline_content',
	            'name' => 'URL',
	            'type' => 'textarea' ,
	            'desc' => 'Headline content',
	            ),
	    );

		$metaboxes[ $this->_prefix.'general'] = array(
			'id'                        => $this->_prefix . 'general',
			'title'                     => __( 'General Options', 'foo-bar' ),
			'object_types'              => array( 'foo-bar-news' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => array(
				array(
					'id'   => $this->_prefix . 'start_date',
					'name' => __('Start Date', 'foo-bar'),
					'type' => 'text_date',
				),
				array(
					'id'   => $this->_prefix . 'end_date',
					'name' => __('End Date', 'foo-bar'),
					'type' => 'text_date',
				),
				array(
					'id'   => $this->_prefix . 'points',
					'name' => __('Head Lines', 'foo-bar'),
					'type' => 'group',
	                'repeatable' => true,
	                'sortable' => true,
	                'fields' => $headline_fields,
                    'options'     => array(
    					'group_title'   => __( 'Head Line {#}', 'foo-bar' ), 
    					'add_button'    => __( 'Add New Head Line', 'foo-bar' ),
    					'remove_button' => __( 'Remove Head Line', 'foo-bar' ),
    					'sortable' => true,
    				),
				),
			),
		);

		return $metaboxes;
	}
}

// News_Post_Type::init();
new News_Post_Type();
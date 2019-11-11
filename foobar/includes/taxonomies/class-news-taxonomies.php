<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Taxonomies_News_Category
 *
 * @class Taxonomies_News_Category
 * @package Tutorial/Classes/Taxonomies
 * @author Pragmatic Mates
 */
class Taxonomies_News_Category {
	/**
	 * Initialize taxonomy
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
	}

	/**
	 * Widget definition
	 *
	 * @access public
	 * @return void
	 */
	public static function definition() {
		$news_labels = array(
	        'name'                       => __('News Categories', 'mcc'),
	        'singular_name'              => __('News Category', 'mcc'),
	        'menu_name'                  => __('News Category', 'mcc'),
	        'all_items'                  => __('All Categories', 'mcc'),
	        'parent_item'                => __('Parent Category', 'mcc'),
	        'parent_item_colon'          => __('Parent Category:', 'mcc'),
	        'new_item_name'              => __('New Category', 'mcc'),
	        'add_new_item'               => __('Add New Category', 'mcc'),
	        'edit_item'                  => __('Edit Category', 'mcc'),
	        'update_item'                => __('Update Category', 'mcc'),
	        'view_item'                  => __('View Category', 'mcc'),
	        'separate_items_with_commas' => __('Separate categories with commas', 'mcc'),
	        'add_or_remove_items'        => __('Add or remove Categories', 'mcc'),
	        'choose_from_most_used'      => __('Choose from the most used', 'mcc'),
	        'popular_items'              => __('Popular Categories', 'mcc'),
	        'search_items'               => __('Search Categories', 'mcc'),
	        'not_found'                  => __('No Category Found', 'mcc'),
	    );
	    $args = array(
	        'labels'            => $news_labels,
	        'hierarchical'      => true,
	        'public'            => true,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'show_in_nav_menus' => true,
	        'show_tagcloud'     => true,
	    );
	    register_taxonomy('news-category', array('news'), $args);

		$tags_labels = array(
	        'name'                       => __('News Tags', 'mcc'),
	        'singular_name'              => __('News Tags', 'mcc'),
	        'menu_name'                  => __('News Tags', 'mcc'),
	        'all_items'                  => __('All Tags', 'mcc'),
	        'parent_item'                => __('Parent Tags', 'mcc'),
	        'parent_item_colon'          => __('Parent Tags:', 'mcc'),
	        'new_item_name'              => __('New Tags', 'mcc'),
	        'add_new_item'               => __('Add New Tags', 'mcc'),
	        'edit_item'                  => __('Edit Tags', 'mcc'),
	        'update_item'                => __('Update Tags', 'mcc'),
	        'view_item'                  => __('View Tags', 'mcc'),
	        'separate_items_with_commas' => __('Separate categories with commas', 'mcc'),
	        'add_or_remove_items'        => __('Add or remove Tags', 'mcc'),
	        'choose_from_most_used'      => __('Choose from the most used', 'mcc'),
	        'popular_items'              => __('Popular Tags', 'mcc'),
	        'search_items'               => __('Search Tags', 'mcc'),
	        'not_found'                  => __('No Tags Found', 'mcc'),
	    );
	    $tags_args = array(
	        'labels'            => $tags_labels,
	        'hierarchical'      => true,
	        'public'            => true,
	        'show_ui'           => true,
	        'update_count_callback' => '_update_post_term_count',
	        'show_admin_column' => true,
	        'query_var' 		=> true,
	        'show_in_nav_menus' => true,
	        'show_tagcloud'     => true,
	    );
	    register_taxonomy('news-tag', array('news'), $tags_args);
	}
}

Taxonomies_News_Category::init();

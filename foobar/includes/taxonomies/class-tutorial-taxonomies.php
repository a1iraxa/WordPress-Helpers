<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Taxonomies_Tutorials_Category
 *
 * @class Taxonomies_Tutorials_Category
 * @package Tutorial/Classes/Taxonomies
 * @author Pragmatic Mates
 */
class Taxonomies_Tutorials_Category {
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
		$pdf_labels = array(
	        'name'                       => __('PDF Categories', 'mcc'),
	        'singular_name'              => __('PDF Category', 'mcc'),
	        'menu_name'                  => __('PDF Category', 'mcc'),
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
	        'labels'            => $pdf_labels,
	        'hierarchical'      => true,
	        'public'            => true,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'show_in_nav_menus' => true,
	        'show_tagcloud'     => true,
	    );
	    register_taxonomy('pdf-category', array('tutorials'), $args);

		$pdf_labels = array(
	        'name'                       => __('PPT Categories', 'mcc'),
	        'singular_name'              => __('PPT Category', 'mcc'),
	        'menu_name'                  => __('PPT Category', 'mcc'),
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
	        'labels'            => $pdf_labels,
	        'hierarchical'      => true,
	        'public'            => true,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'show_in_nav_menus' => true,
	        'show_tagcloud'     => true,
	    );
	    register_taxonomy('ppt-category', array('tutorials'), $args);
	}

	/**
	 * Defines custom fields
	 *
	 * @access public
	 * @param array $metaboxes
	 * @return array
	 */
	public static function fields() {
		$prefix = 'tutorial_';
		$config = array(
	       'id' => 'tutorial_category_meta_box',
	       'title' => 'Tutorials Meta Box',
	       'pages' => array('ppt-category','pdf-category'),
	       'context' => 'normal',
	       'fields' => array(),
	       'local_images' => false,
	       'use_with_theme' => true
	    );
	    $my_meta =  new Tax_Meta_Class($config);
	    //font class field
	    $my_meta->addText($prefix.'category_fa_class',array('name'=> __('Font Awesome Class ','tax-meta')));
	    //image field
	    $my_meta->addImage($prefix.'category_image',array('name'=> __('Upload Image ','tax-meta')));
	    //Finish Taxonomy Extra fields Deceleration
	    $my_meta->Finish();
	}
}

Taxonomies_Tutorials_Category::init();
Taxonomies_Tutorials_Category::fields();

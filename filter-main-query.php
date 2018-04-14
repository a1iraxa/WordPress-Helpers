<?php 
add_action( 'pre_get_posts', 'customize_main_query', 10, 1 );

function customize_main_query($query)
{
	if (!is_admin() AND is_post_type_archive( 'your-custom-post-type' ) AND $query->is_main_query()) {
		$query->set('meta_key', 'your_custom_field_name');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', 'your-custom-array');
	}
}
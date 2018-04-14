<?php 
add_action('init', 'update_meta_for_all_posts');
function update_meta_for_all_posts()
{
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'product' // Post type
    );
    $posts_array = get_posts( $args );
    foreach($posts_array as $post_array)
    {
        update_post_meta($post_array->ID, '_custom_meta_key', '');
    }
}
<?php 

function check_me($array=null){

    $data = debug_backtrace();

    echo "<pre>"; print_r($data[0]); echo "</pre>"; die();

}

function generate_foods_meta_keys(){
    global $wpdb;
    $post_type = 'st_hotel';
    $query = "
        SELECT DISTINCT($wpdb->postmeta.meta_key) 
        FROM $wpdb->posts 
        LEFT JOIN $wpdb->postmeta 
        ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
        WHERE $wpdb->posts.post_type = '%s' 
        AND $wpdb->postmeta.meta_key != '' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'
    ";
    $meta_keys = $wpdb->get_col($wpdb->prepare($query, $post_type));
    set_transient('foods_meta_keys', $meta_keys, 60*60*24); # create 1 Day Expiration
    return $meta_keys;
}
function get_foods_meta_keys(){
    $cache = get_transient('foods_meta_keys');
    $meta_keys = $cache ? $cache : generate_foods_meta_keys();
    return $meta_keys;
}

$meta_keys = get_foods_meta_keys();
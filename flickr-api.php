<?php
$params = array(
    'api_key'   => '41070ccb96b607c98d520a5f38fdf325',
    'method'    => 'flickr.people.getPhotos',
    'user_id'  => '12037949754@N01',
    'format'    => 'php_serial',
    'per_page'    => '20',
);

$encoded_params = array();

foreach ($params as $k => $v){

    $encoded_params[] = urlencode($k).'='.urlencode($v);
}
$url = "https://api.flickr.com/services/rest/?".implode('&', $encoded_params);
 $url;
$rsp = file_get_contents($url);
$rsp_obj = unserialize($rsp);

if ($rsp_obj['stat'] == 'ok'){

    for ($i = 0; $i <= 19; $i++) {
        $secret = $rsp_obj['photos']['photo'][ $i ]['secret'];
        $farm_id = $rsp_obj['photos']['photo'][ $i ]['farm'];
        $server_id = $rsp_obj['photos']['photo'][ $i ]['server'];
        $id = $rsp_obj['photos']['photo'][ $i ]['id'];

        echo '<div class="col-sm-3"><img src="https://farm'.$farm_id.'.staticflickr.com/'. $server_id .'/'. $id .'_'. $secret .'_t.jpg" ></div>';
    }
}else{
    echo "Call failed!";
}
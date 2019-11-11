<?php 
function debug_array(){

    $data = debug_backtrace();

    echo "<pre>"; print_r($data[0]); echo "</pre>"; die();

}
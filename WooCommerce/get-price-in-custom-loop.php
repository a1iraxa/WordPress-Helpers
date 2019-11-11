<?php

global $woocommerce;

$currency = get_woocommerce_currency_symbol();
$price = get_post_meta( get_the_ID(), '_regular_price', true);
$sale = get_post_meta( get_the_ID(), '_sale_price', true);

if ( $sale ) {
    echo "<del> $currency $price </del><p> $currency $sale </p>";
}elseif( $price ) {
    echo "<p> $currency $price </p>";
}

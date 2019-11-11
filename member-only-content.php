<?php
add_shortcode( 'member', 'member_check_shortcode' );

function member_check_shortcode( $atts, $content = null ) {
    if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
        return $content;
    return '';
}
/*
Usage:
[member]
This text will be only displayed to registered users.
[/member]
*/

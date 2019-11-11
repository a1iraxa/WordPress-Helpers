<?php
function jeba_blockusers_init() {
    if ( is_admin() && ! current_user_can( 'administrator' ) &&
       ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
add_action( 'init', 'jeba_blockusers_init' );
}

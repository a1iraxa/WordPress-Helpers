<?php 
// Login user
if(!function_exists('login_user')) {
    
    add_action( 'wp_ajax_login_user', 'login_user' );
    add_action( 'wp_ajax_nopriv_login_user', 'login_user' );
    function login_user() {
        
        $creds = array(
            'user_login'    => (isset($_POST['user_log'])) ? $_POST['user_log'] : '',
            'user_password' => (isset($_POST['user_pwd'])) ? $_POST['user_pwd'] : '',
            'remember'      => (isset($_POST['remember']) && !empty($_POST['remember'])) ? true : false,
        );
     
        $user = wp_signon( $creds, false );
        
        if ( is_wp_error( $user ) ) {
            echo json_encode( [ 'error' => $user->get_error_message() ] );
        } else {
            wp_clear_auth_cookie();
            wp_set_current_user ( $user->ID );
            wp_set_auth_cookie  ( $user->ID );
            echo json_encode( [ 'error' => "" ] );
        }
        die;
        
    }
}

// Register new user
if(!function_exists('registration_user')) {
    
    add_action( 'wp_ajax_registration_user', 'registration_user' );
    add_action( 'wp_ajax_nopriv_registration_user', 'registration_user' );
    function registration_user() {
        
        if( !email_exists( $_POST['user_email'] ) ) {
            
            // Get data from request
            $email = $_POST['user_email'];
            $userName = $_POST['user_name'];
            $passowrd = $_POST['user_pwd'];
            
            // Generate the password and create the user
            $user_id = wp_create_user( $userName, $passowrd, $email );
        
            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user_id,
                    'nickname'    =>    $userName
                )
            );
            
            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'contributor' );
            
            // Email the user
            wp_mail( $email, 'Welcome!', 'Your Password: ' . $passowrd );
            
            echo json_encode( [ 'error' => "" ] );
            
        
        } else {
            echo json_encode( [ 'error' => 'User already exists.' ] );
        }

        die;
        
    }
}

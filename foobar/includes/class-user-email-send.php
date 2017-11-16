<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class User_Email_Send_Check
 *
 * @class User_Email_Send_Check
 * @package Tutorial
 * @author Pragmatic Mates
 */
class User_Email_Send_Check {
	/**
	 * Initialize taxonomy
	 *
	 * @access public
	 * @return void
	 */
	public function init() {
		add_action(	'init', 'table_definition');
		// add_action( 'admin_post_nopriv_user_mail_by_ali', 'check_and_send_email' );
		// add_action( 'admin_post_user_mail_by_ali', 'check_and_send_email' );
		add_action( 'wp_ajax_user_mail_by_ali', 'check_and_send_email' );
		add_action( 'wp_ajax_nopriv_user_mail_by_ali', 'check_and_send_email' );

		/**
		 * Table table_definition
		 *
		 * @access public
		 * @return void
		 */
		function table_definition() {
			global $wpdb;
		    $table_name = $wpdb->prefix . 'users_mail_data';
		    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

		        $sql = "CREATE TABLE $table_name (
		          id int(11) NOT NULL AUTO_INCREMENT,
		          name varchar(25) DEFAULT NULL,
		          email varchar(20) DEFAULT NULL,
		          phone varchar(15) DEFAULT NULL,
		          subject varchar(25) DEFAULT NULL,
		          message varchar(200) DEFAULT NULL,
		          UNIQUE KEY id (id)
		        );";

		        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		        dbDelta( $sql );    
		    }
		}

		/**
		 * Check and Send Email
		 *
		 * @access public
		 * @param array $metaboxes
		 * @return array
		 */
		function check_and_send_email()
		{
		    $name = $_POST['name'];
		    $email = $_POST['email'];
		    $phone = $_POST['phone'];
		    $subject = $_POST['subject'];
		    $message = $_POST['message'];
		    global $wpdb;

		    $table_name = $wpdb->prefix . 'users_mail_data';

		    $results = $wpdb->get_results( $wpdb->prepare('SELECT * FROM '.$table_name.' WHERE email = %s AND subject = %s', $email, $subject) );
		    if (!empty($results) && count($results)>0) {
		        // echo "Already Sent";
		        $response = '<div class="alert alert-warning">';
		        $response .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		      	$response .= 'Already Applied For This Demo Class';
		      	$response .= '</div>';
		      	echo $response;
		        wp_die();
		    }else{
		        $wpdb->insert( 
		            $table_name, 
		            array( 
		                'name' => $name,
		                'email' => $email, 
		                'phone' => $phone ,
		                'subject' => $subject,
		                'message' => $message,
		            ), 
		            array( 
		                '%s', 
		                '%s', 
		                '%s', 
		                '%s', 
		                '%s', 
		            ) 
		        );
		        $to = 'sufyan319@outlook.com';
		        $headers[] = 'Content-Type: text/html; charset=UTF-8';
		        $headers[] = 'From: '. $name .' <'. $email .'>';
		        $body = '
						<html>
							<head>
							  <title>Mail from '. $name .'</title>
							</head>
							<body>
							  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
								<tr style="height: 32px;">
								  <th align="right" style="width:150px; padding-right:5px;">Name:</th>
								  <td align="left" style="padding-left:5px; line-height: 20px;">'. $name .'</td>
								</tr>
								<tr style="height: 32px;">
								  <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
								  <td align="left" style="padding-left:5px; line-height: 20px;">'. $email .'</td>
								</tr>
								<tr style="height: 32px;">
								  <th align="right" style="width:150px; padding-right:5px;">Phone #:</th>
								  <td align="left" style="padding-left:5px; line-height: 20px;">'. $phone .'</td>
								</tr>
								<tr style="height: 32px;">
								  <th align="right" style="width:150px; padding-right:5px;">Subject:</th>
								  <td align="left" style="padding-left:5px; line-height: 20px;">'. $subject .'</td>
								</tr>
								<tr style="height: 32px;">
								  <th align="right" style="width:150px; padding-right:5px;">Message:</th>
								  <td align="left" style="padding-left:5px; line-height: 20px;">'. $message .'</td>
								</tr>
				                                 <p>This Email Has Been Sent From Demo Class at Prolearninghub</p>
							  </table>
							</body>
						</html>';
		        if(wp_mail( $to, $subject, $body, $headers )){
		        	// echo "Sent successfully";
			        $response = '<div class="alert alert-success">';
			        $response .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			      	$response .= 'Successfully Applied For Demo Class';
			      	$response .= '</div>';
			      	echo $response;
			        wp_die();
		        }
			}
		}
	}
}

User_Email_Send_Check::init();

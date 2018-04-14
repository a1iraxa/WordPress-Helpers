<?php 

// session_start();
if ( !defined('ABSPATH') ) {
	exit;
}

/**
* Class News_Shortcode
* @package FooBar
* @since 1.0.0
* @author a1iraxa
*/
class News_Shortcode
{

	public $facebook;
	
	function __construct()
	{
		$this->facebook = null;
		add_action( 'wp', array( $this, 'define_facebook' ) );
		add_action( 'woocommerce_thankyou', array( $this, 'push_alert' ) );
		add_shortcode('display-news', array( $this, 'render_news_content'));

	}

	public function push_alert()
	{
		echo "<script>";
		echo "alert('yes working');";
		echo "</script>";
	}
	public function define_facebook()
	{
		$access_token = 'EAAEDPW6Cea0BALyanrSZAnZC4XE22fm06T0x657VDlm7O6e7ZB2wNvARYyBYJtCleiDnV0yrkVU3ztsKwYE4WZAOZB0SyLQ9bxZADPTig3rxgmifnwLJPvdo4dEdLtIaa3VcthZCjZBMTI93tXxw88tk6OlZBUP6xTMxUuDE8hy4uBfqyyAZA6bvF9DlG4gRZBjDYZAvWhFuyO1qPnzEjfjCb1ikDqOANYWaBKaBo3zZBJPW3pAZDZD';

    	$this->facebook = new Facebook\Facebook( array(
            'app_id' => '285037358643629',
            'app_secret' => 'd8f91cb2565ad8d0f9ddc7dc7941cec2',
            'default_access_token' => $access_token,
            'default_graph_version' => 'v2.10',
        ) );
	}
	public function work_facebook_api()
	{
		$fb = $this->facebook;
		$fields = 'id,email,first_name,posts';
		

		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get("/me?fields=$fields");
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		// $user = $response->getGraphUser();
		$user = $response->getGraphObject();
		var_dump($response->getGraphObject());

		echo 'Name: ' . $user['first_name'];
	}

	public static function get_posts_by_ID($posts, $id) {
		return array_filter($posts, function($data) use ($id) {
			return $data->ID === $id;
		});
	}

	public static function get_posts_by_author($posts, $author) {
		return array_filter($posts, function($data) use ($author) {
			return $data->post_author == $author;
		});
		// return array_map( function($data) use ($author) {
		// 	return $data->post_author === $author;
		// }, $posts);
	}

	public static function wp_parse_example( $args=array() )
	{
		$default = array(
			'before' => 'This is before args.',
			'after' => 'This is after args.',
		);
		$mix_args = wp_parse_args($default, $args);
		var_dump($mix_args);
	}

	

	public function render_news_content( $atts )
	{
		$posts = new WP_Query( array( 'post_type' => 'foo-bar-news' ) );
		$titles = wp_list_pluck( $posts->posts, 'post_title', 'ID' );
		// if ( $posts->have_posts() ) {
		// 	while ($posts->have_posts()) {
		// 		$posts->the_post();
		// 		the_title('<h3>', '</h3>');
		// 	}
		// }

		echo "<h3>Orignal Array</h3>";
		var_dump($posts->posts);


		echo "<h3>Using Wp_list_pluck</h3>";
		var_dump($titles);


		echo "<h3>Array Map</h3>";
		$mapped_array = array_map(function($data){
			if ( 'New one' === $data->post_title ) {
				return $data->post_title;
			}
		}, $posts->posts);
		var_dump( array_filter($mapped_array) );


		echo "<h3>Array Filter</h3>";
		$filtered_array = array_filter($posts->posts, function($data){
			return 'News two' === $data->post_title;
		});
		var_dump($filtered_array);

		echo "<h3>Get Posts By ID</h3>";
		var_dump( self::get_posts_by_ID($posts->posts, 38) );

		echo "<h3>Get Posts By author</h3>";
		var_dump( self::get_posts_by_author($posts->posts, '1') );

		echo "<h3>wp_parse_args</h3>";
		$args = [
			'after' => 'After updated',
			'last' => 'New element added which is not in default array',
		];
		self::wp_parse_example($args);

		echo "<h3>Facebook Graph API</h3>";
		$this->work_facebook_api();
	}
}

new News_Shortcode();
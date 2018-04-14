<?php 

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Class News_Categories_Taxonomy
* @package FooBar
* @since 1.0.0
* @author a1iraxa
*/
class News_Categories_Taxonomy
{
	
	private $_prefix;

	function __construct()
	{
		$this->_prefix = '_news_category';
		add_action( 'init', array( $this, 'definition' ) );
		add_action( 'news-category_add_form_fields', array( $this, 'new_custom_fields_in_news_taxonomy' ) );
		add_action( 'news-category_edit_form_fields', array( $this, 'edit_custom_fields_in_news_taxonomy' ) );
		add_action( 'create_news-category', array( $this, 'save_social_metadata' ) );
		add_action( 'edit_news-category', array( $this, 'save_social_metadata' ) );
	}
	public function definition()
	{
		$news_labels = array(
	        'name'                       => __('News Categories', 'foo-bar'),
	        'singular_name'              => __('News Category', 'foo-bar'),
	        'menu_name'                  => __('News Category', 'foo-bar'),
	        'all_items'                  => __('All Categories', 'foo-bar'),
	        'parent_item'                => __('Parent Category', 'foo-bar'),
	        'parent_item_colon'          => __('Parent Category:', 'foo-bar'),
	        'new_item_name'              => __('New Category', 'foo-bar'),
	        'add_new_item'               => __('Add New Category', 'foo-bar'),
	        'edit_item'                  => __('Edit Category', 'foo-bar'),
	        'update_item'                => __('Update Category', 'foo-bar'),
	        'view_item'                  => __('View Category', 'foo-bar'),
	        'separate_items_with_commas' => __('Separate categories with commas', 'foo-bar'),
	        'add_or_remove_items'        => __('Add or remove Categories', 'foo-bar'),
	        'choose_from_most_used'      => __('Choose from the most used', 'foo-bar'),
	        'popular_items'              => __('Popular Categories', 'foo-bar'),
	        'search_items'               => __('Search Categories', 'foo-bar'),
	        'not_found'                  => __('No Category Found', 'foo-bar'),
	    );
	    $args = array(
	        'labels'            => $news_labels,
	        'hierarchical'      => true,
	        'public'            => true,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'show_in_nav_menus' => true,
	        'show_tagcloud'     => true,
	    );

	    register_taxonomy('news-category', array('foo-bar-news'), $args);
	}

	public static function supported_links()
	{
		return array(
			'facebook' => esc_html('FaceBook', 'foo-bar'),
			'youtube' => esc_html('YouTube', 'foo-bar'),
			'linkedin' => esc_html('LinkedIn', 'foo-bar'),
			'yahoo' => esc_html('Yahoo', 'foo-bar'),
			'gmail' => esc_html('Gmail', 'foo-bar'),
		);
	}
	public function new_custom_fields_in_news_taxonomy()
	{
		wp_nonce_field('custom_fields_in_taxonomy', 'social_networks_in_taxonomy');
		$social_networks = self::supported_links();
		?>
		<th scope="row" valign="top" colspan="2">
			<h3><?php esc_html_e( 'Socail Networks Options', 'foo-bar' ); ?></h3>
		</th>
		<?php foreach ($social_networks as $key => $network): ?>
			<div class="form-field news-category-metadata">
				<label for="<?php printf( esc_html__('%s-metadata', 'foo-bar'), esc_html( $key ) ); ?>"><?php printf( esc_html__('%s URL', 'foo-bar'), esc_html( $network ) ); ?></label>
				<input 
					type="text" 
					name="<?php printf( esc_html__('news_category_%s_url', 'foo-bar'), esc_html( $key ) ); ?>"
					id="<?php printf( esc_html__('%s-metadata', 'foo-bar'), esc_html( $key ) ); ?>" 
					value="" 
					class="social_metdata_field" 
					 />
			</div>
		<?php endforeach ?>
		<?php
	}
	public function edit_custom_fields_in_news_taxonomy($term)
	{
		wp_nonce_field('custom_fields_in_taxonomy', 'social_networks_in_taxonomy');
		$social_networks = self::supported_links();
		?>
		
			<th scope="row" valign="top" colspan="2">
				<h3><?php esc_html_e( 'Socail Networks Options', 'foo-bar' ); ?></h3>
			</th>
			<?php foreach ($social_networks as $key => $network): ?>
				<tr class="form-field news-category-metadata">
					<?php $term_key = sprintf( 'news_category_%s_url', $key ); ?>
					<?php $metadata = get_term_meta( $term->term_id, $term_key, true ); ?>
					<th scope="row">
						<label for="<?php printf( esc_html__('%s-metadata', 'foo-bar'), esc_html( $key ) ); ?>"><?php printf( esc_html__('%s URL', 'foo-bar'), esc_html( $network ) ); ?></label>
					</th>
					<td>
						<input 
							type="text" 
							name="<?php printf( esc_html__('news_category_%s_url', 'foo-bar'), esc_html( $key ) ); ?>"
							id="<?php printf( esc_html__('%s-metadata', 'foo-bar'), esc_html( $key ) ); ?>" 
							value="<?php echo (!empty($metadata)) ? esc_attr($metadata) : ''; ?>" 
							class="social_metdata_field" 
							 />
					</td>
				</tr>
			<?php endforeach ?>
		<?php
	}

	public function save_social_metadata($term_id)
	{
		if ( ! isset( $_POST['social_networks_in_taxonomy'] ) ) {
			return;
		}
		
		if ( ! wp_verify_nonce( $_POST['social_networks_in_taxonomy'], 'custom_fields_in_taxonomy' ) ) {
			return; 
		}
		$supported_links = self::supported_links();
		foreach ($supported_links as $key => $network) {
			$term_key = sprintf( 'news_category_%s_url', $key );
			if ( isset( $_POST[ $term_key ] ) ) {
				update_term_meta( $term_id, esc_attr($term_key), esc_url_raw($_POST[ $term_key ]) );
			}
		}
	}
}

new News_Categories_Taxonomy();
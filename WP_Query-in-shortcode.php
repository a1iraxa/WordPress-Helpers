<?php 

// Add Shortcode
function digitsol_show_product_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'per_page' => '-1',
		),
		$atts
	);
	global $post;
	$args = array('post_type' => array('product', 'product_variation'), 'posts_per_page' => $per_page);
	// WP_Query arguments
	$args = array(
		'post_type'              => array('product', 'product_variation'),
		'nopaging'               => false,
		'paged'                  => '10',
		'posts_per_page'         => '-1',
		'ignore_sticky_posts'    => true,
		'order'                  => 'DESC',
		'orderby'                => 'date',
	);

	// Restore original Post Data
	wp_reset_postdata();
	$products = new WP_Query($args);
	ob_start(); ?>

	    <div class="row">
	    	<?php if ($products->have_posts()): ?>
	    	    
	    	    <?php while ($products->have_posts()): $products->the_post(); ?>
			    	<div class="col-sm-4">
			    		<div class="wrap-product">
			    			<h3 class="title"><?php the_title(); ?></h3>
			    			<a href="<?php get_post_meta(get_the_ID(), '_product_url', true ); ?>">
			    				<img src="p">
			    			</a>
			    			<div class="product-content"><p><?php echo wp_trim_words( get_the_content(), 15, '...' ); ?></p></div>
			    			<div class="product-meta">
			    				<div class="pull-left"></div>
			    				<div class="pull-right"></div>
			    			</div>

			    		</div>
			    	</div>
	    	  	<?php endwhile; ?>

	    	<?php endif; wp_reset_query(); ?>
	    </div>
	<?php 

	$result = ob_get_contents();	
	ob_end_clean();
	$output.= $result;

	return $output;

}
add_shortcode( 'dgitsol_products', 'digitsol_show_product_shortcode' );

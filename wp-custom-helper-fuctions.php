<?php 

/////////////////////////
// Call Examples Start //
/////////////////////////

if (!empty($instance['widget_title_color'])) {
    $style_array[] = 'color: ' . $instance['widget_title_color'];
}
walker_edge_inline_style($style_array);
echo walker_edge_kses_img(get_avatar($comment, 82));
walker_edge_class_attribute($icon_holder_classes);
echo transpro_wp_kses($tags);

$params = shortcode_atts( $args, $atts );
extract( $params );
$html = '';
$html .= edgtf_membership_get_shortcode_template_part( 'register', 'register-template', '', $params );
// Call Examples End

if(!function_exists('walker_edge_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 * @see walker_edge_get_inline_style()
	 */
	function walker_edge_inline_style($value) {
		echo walker_edge_get_inline_style($value);
	}
}

if(!function_exists('walker_edge_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 * @see walker_edge_get_inline_style()
	 */
	function walker_edge_get_inline_style($value) {
		return walker_edge_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('walker_edge_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function walker_edge_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}
if(!function_exists('walker_edge_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see walker_edge_get_class_attribute()
	 */
	function walker_edge_class_attribute($value) {
		echo walker_edge_get_class_attribute($value);
	}
}

if(!function_exists('walker_edge_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see walker_edge_get_inline_attr()
	 */
	function walker_edge_get_class_attribute($value) {
		return walker_edge_get_inline_attr($value, 'class', ' ');
	}
}

if( ! function_exists('transpro_wp_kses') ) {
    /**
     * Theme global escaping function
     *
     * @param $html string
     * @return string
     */
    function transpro_wp_kses( $html ){
        // Static variable, but we want to call this function just once
        static $allowed_html = null;
        if( empty($allowed_html) ){
            $allowed_html = wp_kses_allowed_html('post');
        }
        return wp_kses( $html, $allowed_html );
    }
}

// Filter, that strips evil scripts from comments
add_filter('comment_text', 'transpro_wp_kses');

if(!function_exists('walker_edge_kses_img')) {
	/**
	 * Function that does escaping of img html.
	 * It uses wp_kses function with predefined attributes array.
	 * Should be used for escaping img tags in html.
	 * Defines walker_edge_kses_img_atts filter that can be used for changing allowed html attributes
	 *
	 * @see wp_kses()
	 *
	 * @param $content string string to escape
	 * @return string escaped output
	 */
	function walker_edge_kses_img($content) {
		$img_atts = apply_filters('walker_edge_kses_img_atts', array(
			'src' => true,
			'alt' => true,
			'height' => true,
			'width' => true,
			'class' => true,
			'id' => true,
			'title' => true
		));

		return wp_kses($content, array(
			'img' => $img_atts
		));
	}
}

if ( ! function_exists( 'edgtf_membership_get_shortcode_template_part' ) ) {
	/**
	 * Loads Shortcode template part.
	 *
	 * @param $shortcode
	 * @param $template
	 * @param string $slug
	 * @param array $params
	 *
	 * @see walker_edge_get_template_part()
	 * @return string
	 */
	function edgtf_membership_get_shortcode_template_part( $shortcode, $template, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = EDGE_MEMBERSHIP_ABS_PATH . '/shortcodes/' . $shortcode . '/templates';

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp . '.php';
		}
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}
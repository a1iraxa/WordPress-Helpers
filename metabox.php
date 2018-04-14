<?php 
/**
 * Calls the class on the post edit screen.
 */
function shots_metaboxs() {
    new ShotsMetaboxs();
}
 
if ( is_admin() ) {
    add_action( 'load-post.php',     'shots_metaboxs' );
    add_action( 'load-post-new.php', 'shots_metaboxs' );
}
 
/**
 * The Class.
 */
class ShotsMetaboxs {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to pages.
        if ( $post_type == 'page' ) {
            add_meta_box(
                'shots_page_metabox',
                __( 'Page Meta', 'shots' ),
                array( $this, 'shots_render_page_meta' ),
                $post_type,
                'side',
                'high'
            );
        }

        // Limit meta box to post.
        if ( $post_type == 'post' ) {
            add_meta_box(
                'shots_page_metabox',
                __( 'Post Meta', 'shots' ),
                array( $this, 'shots_render_post_meta' ),
                $post_type,
                'side',
                'default'
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
 
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if ( ! isset( $_POST['shots_page_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['shots_page_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'shots_metaboxs_action' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $page_meta = sanitize_text_field( $_POST['shots_page_subtitle'] );
 
        // Update the meta field.
        update_post_meta( $post_id, 'shots_page_subtitle', $page_meta );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function shots_render_page_meta( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'shots_metaboxs_action', 'shots_page_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, 'shots_page_subtitle', true );
 
        // Display the form, using the current value.
        ?>
        <div class="shots-page-meta">
        	<table class="form-table shots-table">
        		<tr>
        			<th><label for="shots_page_subtitle"><?php _e( 'Subtitle', 'shots' ); ?></label></th>
	        		<td>
	        			<input type="text" id="shots_page_subtitle" name="shots_page_subtitle" value="<?php echo esc_attr( $value ); ?>" size="20" placeholder="Subtitle here" />
	        		</td>	
        		</tr>
        		<tr>
        			<th><label for="shots_page_title_bar"><?php _e( 'Show Title Bar', 'shots' ); ?></label></th>
	        		<td>
	        			<select name="shots_page_title_bar">
			                <?php 
			                    $option_values = array(
			                    	'yes' => 'Yes',
			                    	'no' => 'No',
			                    	);

			                    foreach($option_values as $key => $value) 
			                    {
			                        if($value == get_post_meta($post->ID, "shots_page_title_bar", true))
			                        {
			                            ?>
			                                <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
			                            <?php    
			                        }
			                        else
			                        {
			                            ?>
			                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
			                            <?php
			                        }
			                    }
			                ?>
			            </select>
	        		</td>
        		</tr>
        	</table>
        </div>

        <?php
    }
}
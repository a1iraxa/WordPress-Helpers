<?php
/**
 * Template Name: User Login Form
 */
?>
<?php get_header(); ?>
<?php 
if(isset($_POST['user_categories_form'])){
	update_user_meta( $_POST['user_id'], 'user_categories', json_encode($_POST['user_categories']) );
} 
 ?>


<?php if ( !is_user_logged_in()): ?>
	<div class="wpum-helper-links">
		<p class="wpum-login-url">
			<?php echo apply_filters( 'wpum_login_link_label', sprintf( __( 'Already have an account? <a href="%s">Sign In &raquo;</a>', 'wpum' ), esc_url( get_permalink( wpum_get_option( 'login_page' ) ) ) ) ); ?>
		<p class="wpum-register-url">
			<?php echo apply_filters( 'wpum_registration_link_label', sprintf( __( 'Don\'t have an account? <a href="%s">Signup Now &raquo;</a>', 'wpum' ), esc_url( get_permalink( wpum_get_option( 'registration_page' ) ) ) ) ); ?>
		</p>
		<p class="wpum-password-recovery-url">
			<a href="<?php echo esc_url( get_permalink( wpum_get_option( 'password_recovery_page' ) ) );?>">
				<?php echo apply_filters( 'wpum_password_link_label', __( 'Lost your password?', 'wpum' ) ); ?>
			</a>
		</p>
	</div>
<?php else: ?>

	<div id="user-categories-form" class="user-categories-form-wrapper">

	<form action="" method="post" id="user-categories" class="user-categories-form" name="user-categories" enctype="multipart/form-data">

		<?php
		$categories = get_categories( array(
		    'orderby' => 'name',
		    'order'   => 'ASC'
		) );
		$data = get_user_meta( get_current_user_id(), 'user_categories', true );
		$selected = json_decode($data);


     ?> 
		<?php foreach ( $categories as $key => $category ) : ?>
			<?php $checked = ( in_array($category->term_id, $selected) ) ? 'checked' : ''; ?>
			<fieldset class="fieldset">
				<?php echo "<label><input \" $checked \" name=\"user_categories[]\" type=\"checkbox\" value=\"$category->term_id\" > $category->name</label>"; ?>
			</fieldset>
		<?php endforeach; ?>
		<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
		<input type="submit" value="Save My Page" name="user_categories_form">

	</form>

</div>
<?php endif ?>
<?php 
get_footer();

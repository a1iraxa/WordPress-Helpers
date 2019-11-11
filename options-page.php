<?php
add_action( 'admin_menu', 'digitsol_add_admin_menu' );
add_action( 'admin_init', 'digitsol_settings_init' );


function digitsol_add_admin_menu(  ) { 

	add_options_page( 'DigitSol TCS Auto Shipping', 'DigitSol TCS Auto Shipping', 'manage_options', 'digitsol_tcs_auto_shipping', 'digitsol_options_page' );

}


function digitsol_settings_init(  ) { 

	register_setting( 'pluginPage', 'digitsol_settings' );

	add_settings_section(
		'digitsol_pluginPage_section', 
		__( 'Your section description', 'digitsol-tcs' ), 
		'digitsol_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'digitsol_text_field_0', 
		__( 'Settings field description', 'digitsol-tcs' ), 
		'digitsol_text_field_0_render', 
		'pluginPage', 
		'digitsol_pluginPage_section' 
	);

	add_settings_field( 
		'digitsol_text_field_1', 
		__( 'Settings field description', 'digitsol-tcs' ), 
		'digitsol_text_field_1_render', 
		'pluginPage', 
		'digitsol_pluginPage_section' 
	);

	add_settings_field( 
		'digitsol_text_field_2', 
		__( 'Settings field description', 'digitsol-tcs' ), 
		'digitsol_text_field_2_render', 
		'pluginPage', 
		'digitsol_pluginPage_section' 
	);


}


function digitsol_text_field_0_render(  ) { 

	$options = get_option( 'digitsol_settings' );
	?>
	<input type='text' name='digitsol_settings[digitsol_text_field_0]' value='<?php echo $options['digitsol_text_field_0']; ?>'>
	<?php

}


function digitsol_text_field_1_render(  ) { 

	$options = get_option( 'digitsol_settings' );
	?>
	<input type='text' name='digitsol_settings[digitsol_text_field_1]' value='<?php echo $options['digitsol_text_field_1']; ?>'>
	<?php

}


function digitsol_text_field_2_render(  ) { 

	$options = get_option( 'digitsol_settings' );
	?>
	<input type='text' name='digitsol_settings[digitsol_text_field_2]' value='<?php echo $options['digitsol_text_field_2']; ?>'>
	<?php

}


function digitsol_settings_section_callback(  ) { 

	echo __( 'This section description', 'digitsol-tcs' );

}


function digitsol_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>DigitSol TCS Auto Shipping</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>
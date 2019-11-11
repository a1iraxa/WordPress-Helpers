jQuery(document).ready(function($) {

	// Display our different form fields when buttons are clicked
	$('.modal-login-content:not(:first)').hide();
	$('.modal-login-nav').click(function(e) {

		// Remove any messages that currently exist.
		$('.modal-login-content > p.message').remove();

		// Get the link set in the href attribute for the currently clicked element.
		var form_field = $(this).attr('href');

		$('.modal-login-content').hide();
		$('.section-container ' + form_field).fadeIn(700);

		e.preventDefault();

		if(form_field === '#login') {
			$(this).parent().fadeOut().removeClass().addClass('hide-login');
		} else {
			$('a[href="#login"]').parent().removeClass().addClass('inline').fadeIn();
		}
	});

	// Run our login ajax
	$('#modal-login #form').on('submit', function(e) {

		// Stop the form from submitting so we can use ajax.
		e.preventDefault();

		// Check what form is currently being submitted so we can return the right values for the ajax request.
		var form_id = $(this).parent().attr('id');

		// Remove any messages that currently exist.
		$('.modal-login-content > p.message').remove();

		// Check if we are trying to login. If so, process all the needed form fields and return a faild or success message.
		if ( form_id === 'login' ) {
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: modal_login_script.ajax,
				data: {
					'action'     : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
					'username'   : $('#form #login_user').val(),
					'password'   : $('#form #login_pass').val(),
					'rememberme' : ($('#form #rememberme').is(':checked'))?"TRUE":"FALSE",
					'login'      : $('#form input[name="login"]').val(),
					'security'   : $('#form #security').val()
				},
				success: function(results) {

					// Check the returned data message. If we logged in successfully, then let our users know and remove the modal window.
					if(results.loggedin === true) {
						$('.modal-login-content > h2').after('<p class="message success"></p>');
						$('.modal-login-content > p.message').text(results.message).show();

						$('#overlay, .login-popup').delay(5000).fadeOut('300m', function() {
							$('#overlay').remove();
						});
						window.location.href = updateQueryStringParameter( modal_login_script.redirecturl, 'nocache', ( new Date() ).getTime() );
					} else {
						$('.modal-login-content > h2').after('<p class="message error"></p>');
						$('.modal-login-content > p.message').text(results.message).show();
					}
				}
			});
		} else if ( form_id === 'register' ) {
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: modal_login_script.ajax,
				data: {
					'action'   : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
					'username' : $('#form #reg_user').val(),
					'email'    : $('#form #reg_email').val(),
					'register' : $('#form input[name="register"]').val(),
					'security' : $('#form #security').val(),
					'password' : $('#form #reg_password').val(),
					'cpassword': $('#form #reg_cpassword').val()
				},
				success: function(results) {
					if(results.registerd === true) {
						$('.modal-login-content > h2').after('<p class="message success"></p>');
						$('.modal-login-content > p.message').text(results.message).show();
						$('#register #form input:not(#user-submit)').val('');
						if(results.redirect === true) {
							$('#overlay, .login-popup').delay(5000).fadeOut('300m', function() {
								$('#overlay').remove();
							});
							window.location.href = updateQueryStringParameter( modal_login_script.redirecturl, 'nocache', ( new Date() ).getTime() );
						}
					} else {
						$('.modal-login-content > h2').after('<p class="message error"></p>');
						$('.modal-login-content > p.message').text(results.message).show();
					}
				}
			});
		} else if ( form_id === 'forgotten' ) {
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: modal_login_script.ajax,
				data: {
					'action'    : 'ajaxlogin', // Calls our wp_ajax_nopriv_ajaxlogin
					'username'  : $('#form #forgot_login').val(),
					'forgotten' : $('#form input[name="forgotten"]').val(),
					'security'  : $('#form #security').val()
				},
				success: function(results) {
					if(results.reset === true) {
						$('.modal-login-content > h2').after('<p class="message success"></p>');
						$('.modal-login-content > p.message').text(results.message).show();
						$('#forgotten #form input:not(#user-submit)').val('');
					} else {
						$('.modal-login-content > h2').after('<p class="message error"></p>');
						$('.modal-login-content > p.message').text(results.message).show();
					}
				}
			});
		} else {
			// if all else fails and we've hit here... something strange happen and notify the user.
			$('.modal-login-content > h2').after('<p class="message error"></p>');
			$('.modal-login-content > p.message').text('Something  Please refresh your window and try again.');
		}
	});

	// Make sure we go to the right pane (login VS register)
	$( 'a[href="#modal-login"]' ).click( function() {
		$( 'a[href="#login"]:eq(0)' ).click();
	});
	$( 'a[href="#modal-register"]' ).click( function() {
		$( 'a[href="#modal-login"]:eq(0), a[href="#register"]' ).click();
	});
});

/**
 * Adds or updates a query string parameters
 */
function updateQueryStringParameter( uri, key, value ) {
	var re = new RegExp( "([?&])" + key + "=.*?(&|$)", "i" );
	var separator = uri.indexOf( '?' ) !== -1 ? "&" : "?";
	if ( uri.match( re ) ) {
		return uri.replace( re, '$1' + key + "=" + value + '$2' );
	} else {
		return uri + separator + key + "=" + value;
	}
}

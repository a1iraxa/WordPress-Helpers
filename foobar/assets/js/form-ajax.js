(function($) {
 
    /** jQuery Document Ready */
    $(document).ready(function(){

 
        $( '#email-form' ).off( 'click' ).on( 'click', function( e ) { 
 
            /** Prevent Default Behaviour */
            e.preventDefault();
 
            /** Get From Data */
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var phone = $('input[name=phone]').val();
            var subject = $('input[name=subject]').val();
            var message = $('textarea#message').val();
            jQuery.ajax({
              type:"POST",
              url: ajaxurl,
              data: {
                    action: "user_mail_by_ali",
                    name:name,
                    email:email,
                    phone:phone,
                    subject:subject,
                    message:message,
              },
              success:function(response){
                $( '#msg' ).html( response );
              },
              error: function(errorThrown){
                alert(errorThrown);
              } 

            });
        });
 
    });
 
})(jQuery);
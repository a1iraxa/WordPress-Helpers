
jQuery(document).ready(function($) {
    $('.woocommerce-checkout').on('change', '.field_perseons_child, .field_perseons_adults', function( e ) {
        
        $form = $(this).closest('form');
        // $form.find('.your-class-name').block({message: null, overlayCSS: {background: '#fff', backgroundSize: '16px 16px', opacity: 0.6}}).show(); // block form inner div
        $.ajax({
            type:       'POST',
            url:        digitSol_ajaxurl, // e.g: var digitSol_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            dataType:   "html",
            data:       {
                action: 'digitsol_calculate_costs', // form action in php file
                form:   $form.serialize() // getting all form data
            },
            success:    function( code ) {
                
                if ( code.charAt(0) !== '{' ) {
                    console.log( code );
                    code = '{' + code.split(/\{(.+)?/)[1];
                }

                result = $.parseJSON( code );
                
                if ( result.code == 'ERROR' ) {
                    
                   console.log("error");
                    
                } else if ( result.code == 'SUCCESS' ) {
                    
                    console.log("success");
                    // $form.find('.your-class-name').unblock(); // unblock class
                    
                } else {
                    // console.log( result );
                    
                }
            },
            error: function() {
                
            },
            
        });
        
    });
    
});
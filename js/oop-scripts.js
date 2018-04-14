if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

asim_Helpers = {};
jQuery(document).ready(function ($) {

    asim_Helpers_Object = {

        init: function () {
            jQuery.exists = function(selector) {return ($(selector).length > 0);}
            $('body').on('click', '.add-to-cart-ajax', this.addToCart);
            $('body').on('click', '.cart-remove-item', this.removeFormCart);
            $('body').on('click', '.place-order-btn', this.placeOrder);
        },
        addToCart: function (evt) {
            evt.preventDefault();

            let botton = $(this);

            let form = $(this).closest('form');
            let view_cart = form.find('.view-cart');

            let required_data = {
                action: form.attr("action"),
                data: form.serialize(),
            };

            botton.toggleClass("disabled");

            // asim_Notifications.info('info', 'Processing data');

            $.ajax({
                type:       'POST',
                dataType:   "json",
                url:        required_data.action,
                data:       {
                    form:   required_data.data,
                },
                success:    function( response ) {

                    if ( response.success ) {

                        // asim_Notifications.success('Success', response.msg);

                        botton.hide();
                        if ($.exists( view_cart )) {
                            view_cart.toggleClass('hide');
                        }else{
                            window.location.replace( laroute.route('cart') );
                        }


                    } else {

                        // asim_Notifications.error('Errors', response.msg);

                        botton.toggleClass("disabled");
                    }

                },
                error: function() {

                    // asim_Notifications.error('Errors', 'Something went wrong. Try after page reload.');

                    botton.toggleClass("disabled");

                }
            });
        },
        removeFormCart: function (evt) {
            evt.preventDefault();
            id = $(this).data('id');
            if ( !id ) {
                alert('Something went wrong.');
                return false;
            }
            $.ajax({
                type:       'POST',
                dataType:   "json",
                url:        laroute.route('cart.remove.item'),
                data:       {
                    _method: "POST",
                    id: id
                },
                success:    function( response ) {

                    if ( response.success ) {

                        // asim_Notifications.success('Success', response.msg);

                        location.reload();

                    } else {

                        // asim_Notifications.error('Errors', response.msg);

                    }

                },
                error: function() {

                    // asim_Notifications.error('Errors', 'Something went wrong. Try after page reload.');

                }
            });
        },
        placeOrder: function (evt) {
            evt.preventDefault();

            let botton = $(this);

            let form = $(this).closest('form');

            let required_data = {
                action: form.attr("action"),
                data: form.serialize(),
            };

            botton.toggleClass("disabled");

            // asim_Notifications.info('info', 'Processing data');

            $.ajax({
                type:       'POST',
                dataType:   "json",
                url:        required_data.action,
                data:       {
                    form:   required_data.data,
                },
                success:    function( response ) {

                    if ( response.success ) {

                        // asim_Notifications.success('Success', response.msg);

                        window.location.replace( response.redirect );

                    } else {

                        // asim_Notifications.error('Errors', response.msg);

                        botton.toggleClass("disabled");
                    }

                },
                error: function() {

                    // asim_Notifications.error('Errors', 'Something went wrong. Try after page reload.');

                    botton.toggleClass("disabled");

                }
            });
        },

    };
    asim_Helpers = asim_Helpers_Object;
    asim_Helpers.init();
});

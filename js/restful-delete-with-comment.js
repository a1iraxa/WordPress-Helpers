if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

/* globals jQuery, $,google, asim_Notifications */
/* jshint strict:false */

$(document).ready(function() {

    var restful = {
        init: function(elem) {

            elem.on('click', function(e) {
                var __self=$(this);
                e.preventDefault();

                $.confirm({
                    title: 'Reasons !',
                    content: `<div class="form-group">
                                <div class="form-line">
                                    <input autofocus type="text" id="cancellation-reasons" placeholder="Please enter reasons." class="form-control">
                                </div>
                            </div>
                            <p class="text-danger" style="display:none">Please enter at least one reason.</p>
                            `,
                    icon: 'fa fa-warning',
                    animation: 'zoom',
                    columnClass: 'col-md-12',
                    closeAnimation: 'zoom',
                    // theme: 'supervan',
                    opacity: 0.5,
                    buttons: {
                        confirm: {
                            action: function () {

                                var reasons = this.$content.find('input#cancellation-reasons');
                                var errorText = this.$content.find('.text-danger');

                                if (reasons.val() == '') {
                                    errorText.show();
                                    return false;
                                }

                                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                                $.ajax({
                                    url: __self.attr('href'),
                                    type: 'GET',
                                    data : {
                                        'reasons': reasons.val(),
                                    },
                                    beforeSend:function(){

                                        asim_Notifications.info('', 'Processing...');
                                    },
                                    success: function(data) {

                                        if (data.success) {
                                            asim_Notifications.success('', 'Updated successfully.');
                                        } else {
                                            asim_Notifications.warning('Warning:', data.message);
                                        }
                                        if(data.hide_me){
                                            __self.parents('tr')[0].remove(); // todo: make configurable
                                        }
                                        window.location.reload(true);

                                    },
                                    error: function(data) {
                                        asim_Notifications.error('Error', 'Something went wrong try after page reload(refresh).');
                                    }
                              });
                            },
                        },
                        cancel: function () {
                            return
                        },
                    }
                });

            })
        },
    }

    restful.init($('.update-status-ajax'));
});

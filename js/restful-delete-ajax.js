if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

/* globals jQuery, $*/
/* jshint strict:false */

$(document).ready(function() {

    // Add click handler to hyperlinks to send restful DELETE requests
    //
    // Example:
    //
    // <a href="/delete/1" class="rest-delete">delete</a>
    // <script>restful.init($('.rest-delete'));</script>
    //
    var restful = {

        // TODO: add various configurations, e.g.
        // - do_confirm: [ true | false ]
        // - confirm_message: "Are you sure?"
        // - do_remove_parent: [ true | false ]
        // - parent_selector: '.li' '.div' ...
        // - success: (closure)

        init: function(elem_class) {
            $(document).on('click', elem_class, function(e) {
                var self=$(this);
                e.preventDefault();

                $.confirm({
                    title: 'Delete Confirm!',
                    content: 'Are you sure to delete this ?',
                    icon: 'fa fa-warning',
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    opacity: 0.5,
                    buttons: {
                        confirm: {
                            btnClass: 'btn-red',
                            action: function () {

                                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                                $.ajax({
                                    url: self.attr('href'),
                                    type: 'POST',
                                    data : {
                                        '_method': 'DELETE',
                                    },
                                    beforeSend:function(){

                                        asim_Notifications.info('', 'Deleting...');
                                    },
                                    success: function(data) {

                                        if (data.success) {
                                            asim_Notifications.success('Success', 'Deleted.');
                                        } else {
                                            asim_Notifications.warning('Warning', data.message);
                                        }
                                        if (data.remove) {
                                            self.parents('tr')[0].remove(); // todo: make configurable
                                        }
                                        if (data.reload) {
                                            window.location.reload(true);
                                        }

                                    },
                                    error: function(data) {
                                        asim_Notifications.error('Error', 'Something went wrong try after page reload(refresh).');
                                    }
                              });
                            },
                        },
                        cancel: function () {
                            return;
                        },
                    }
                });

            });
        },
    };

    restful.init('.delete');
});

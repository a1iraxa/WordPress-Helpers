if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function($) {
    function ajaxInLaravel(var_1, var_2) {

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        var $return = false;

        var required_data = {
            type: 'POST',
            dataType: 'json',
            data: {
                var_2: var_2,
                var_1: var_1
            },
            url: laroute.route('shared.appointment.doctor.assign')
        };

        $.ajax({
            type:       required_data.type,
            dataType:   required_data.dataType,
            url:        required_data.url,
            data:       {
                "_method": "POST",
                "form_data":   required_data.data,
            },
            beforeSend:function(){
                clickLoad();
                asim_Notifications.info('Info: ', 'Updating...');
            },
            success: function(response){
                if (response.success) {
                    asim_Notifications.success('Success: ', 'Updated.');
                    $return = true;
                } else {
                    asim_Notifications.warning('Warning: ', response.message);
                }
            },
            error: function() {
                asim_Notifications.error('Error', 'Something went wrong try after page reload(refresh).');
            }
        });

        return $return;
    }
});

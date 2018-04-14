if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    $(".month-year-picker").each(function() {
        var selected_value = $(this).data('selected');
        var months = new Array();

        months[1] = "January";
        months[2] = "February";
        months[3] = "March";
        months[4] = "April";
        months[5] = "May";
        months[6] = "June";
        months[7] = "July";
        months[8] = "August";
        months[9] = "September";
        months[10] = "October";
        months[11] = "November";
        months[12] = "December";

        var starting_month = new Date().getMonth()+1;
        var current_year = true;

        for (var i = new Date().getFullYear(); i < new Date().getFullYear()+9; i++) {
            $.each(months, function (index, value) {
                if( index != 0 ) {
                    var selected= '';
                    var select_value = "28/0" + index + "/" + i;
                    if ( index < 10 ) {
                        var select_text = "0"+ index  + "/" + i;
                    }else {
                        var select_text = index  + "/" + i;
                    }


                    var option = new Option(select_text, select_value);

                    if (selected_value == select_value) {option.selected=true; }

                    if( current_year ){
                        if( index == starting_month ){
                            $('.month-year-picker').append(option);
                            current_year = false;
                        }
                    }else {
                        $('.month-year-picker').append(option);
                    }

                }
            });
        }
    });

});
// Usage:
// <select class="form-control select2 month-year-picker" id="medicare_expiry" {{ ( !$patient->hasMeta('medicare') ) ? 'disabled="disabled"' : '' }} name="medicare_expiry" data-selected="{!! $patient->getPatientMeta('medicare_expiry') !!}"></select>

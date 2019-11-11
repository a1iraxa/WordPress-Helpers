if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });

});

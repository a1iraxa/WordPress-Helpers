if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 30) {
            // extra code
        } else {
            // extra code
        }
    });

});

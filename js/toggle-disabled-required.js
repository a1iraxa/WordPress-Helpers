if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    // Toggle required attr in element
    function changeDisableRequired(elementID) {
        $(`#elementID`).attr('required', function (_, attr) { return !attr });
    }

    // Toggle disabled
    function changeDisableRequired(elementID) {
        $(`#elementID`).attr('disabled', function (_, attr) { return !attr });
    }
});

if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {
    function ucfirst(str) {
        var firstLetter = str.substr(0, 1);
        return firstLetter.toUpperCase() + str.substr(1);
    }

    // Usage:
    // ucfirst('foo bar baz');
});

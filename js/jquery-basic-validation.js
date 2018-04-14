if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function($) {

    "use strict";

    // If element exists
    jQuery.fn.isExists = function() {
        return this.length;
    };

    // If value exists
    jQuery.fn.isValueExists = function() {
        if (!this.isExists()) {
            return false;
        }
        return this.val().length;
    };

    // If select option is select
    jQuery.fn.isSelected = function() {

        if (!this.isExists()) {
            return false;
        }

        this.find(":selected").parent().removeClass('digitsol-error');
        this.find(":selected").parent().siblings('.error-message').remove();

        if (this.val() === "") {
            this.find(":selected").parent().after('<span class="error-message"> * Required</span>');
            this.find(":selected").parent().addClass('digitsol-error');
            return false;
        }

        return true;
    };

    // Add/Remove error css-class
    jQuery.fn.isEmpty = function() {

        this.removeClass('digitsol-error');
        this.siblings('.error-message').remove();

        if (!this.isValueExists()) {
            this.after('<span class="error-message"> * Required</span>');
            this.addClass('digitsol-error');
            return true;
        }
        return false;
    };
});

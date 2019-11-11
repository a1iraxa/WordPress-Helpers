if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function($) {

    "use strict";

    // Is element exists
    jQuery.fn.isExists = function() {
        return this.length;
    };

    // Is value exists
    jQuery.fn.isValueExists = function() {
        if (!this.isExists()) {
            return false;
        }
        return this.val().length;
    };

    // Is value empty
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

    // Is select option select
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

    // Is radion checked
    jQuery.fn.isRadioChecked = function() {

        if( ! this.isExists()) {
            return false;
        }

        this.removeClass('digitsol-error');
        this.siblings('.error-message').remove();

        if( ! this.is(':checked') ){
            this.after('<span class="error-message"> * Please Select</span>');
            this.addClass('digitsol-error');
            return false;
        }

        return true;
    };

    // Is valid email address
    jQuery.fn.isEmail = function() {

        this.removeClass('digitsol-error');
        this.siblings('.error-message').remove();

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if( ! regex.test($.trim(this.val())) ) { // not valid email
            this.after('<span class="error-message"> Not Valid Email!</span>');
            this.addClass('digitsol-error');
            return false;
        }
        return true;
    };

    // Is valid phone number
    jQuery.fn.isPhone = function() {
        this.removeClass('digitsol-error');
        this.siblings('.error-message').remove();

        var regex = /^\(?(\d{3})\)?[- ](\d{3})[- ](\d{4})$/;

        if( ! regex.test($.trim(this.val())) ) { // not valid email
            this.after('<span class="error-message"> Valid Phone: (800)-640-0599</span>');
            this.addClass('digitsol-error');
            return false;
        }
        return true;
    };

    // Is valid social security number
    jQuery.fn.isSSN = function() {
        return true;
        this.removeClass('digitsol-error');
        this.siblings('.error-message').remove();

        var regex = /^[0-9]{3}\-[0-9]{2}\-[0-9]{4}$/;

        if( ! regex.test($.trim(this.val())) ) { // not valid email
            this.after('<span class="error-message"> Valid SSN: 000-00-0000</span>');
            this.addClass('digitsol-error');
            return false;
        }
        return true;
    };



    /*
    Usage:
    var required_fields = {
        legalbusinessname: $('#legalbusinessname'),
        businessaddress: $('#businessaddress'),
        businesscity: $('#businesscity'),
        businessstate: $('#businessstate'),
        businesszip: $('#businesszip'),
        telephone: $('#telephone'),
        email: $('#email'),
        website: $('#website'),
    };

    if( this.__validateData(required_fields) ){
        // now manipulate form data
    }

    // Form Validator
    __validateData(fields) {

        var validated = false;

        $.each(fields, function(key, value) {

            if( this.attr('type') == 'radio' ){
                if( ! this.isRadioChecked() ) {
                    validated = false;
                    return false;
                }
            }

            if ( this.is('input') ) {

                if(this.isEmpty()){
                    validated = false;
                    return false;
                }

                if ( this.hasClass('validate-email') ) {
                    if ( !this.isEmail() ) {
                        validated = false;
                        return false;
                    }
                }

                if ( this.hasClass('validate-phone') ) {
                    if ( !this.isPhone() ) {
                        validated = false;
                        return false;
                    }
                }

                if ( this.hasClass('validate-ssn') ) {
                    if ( !this.isSSN() ) {
                        validated = false;
                        return false;
                    }
                }

            }else if( this.is('select')){
                if( ! this.isSelected() ) {
                    validated = false;
                    return false;
                }
            }
            validated = true;
        });

        return validated;

    }
    */
});

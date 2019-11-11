if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function($) {

    "use strict";

    class SampleClass {
        constructor() {

            // Get all event watcher
            this.selectBtn = $('.digitsol-select');
            this.radioBtn = $('input[type=radio]');

            // Trigger events
            this.events();
        }

        events() {
            this.radioBtn.on("change", this.addActiveClass.bind(this));
            this.selectBtn.on("click", this.checkRadioByBtn.bind(this));
        }

        // Check by select btn
        checkRadioByBtn(e) {
            const __self = this;
            this.removeActiveClass();
            e.preventDefault();
            let element = e.currentTarget;
            this.addActiveClass();
        }

        // Add class
        addActiveClass(e) {
            // $(e.currentTarget).parents().parents('.digitsol-products.radio').addClass('active');
        }

        // Remove class
        removeActiveClass(e) {
            $('.digitsol-products.radio').each(function () {
                $(this).removeClass('active');
            });
        }


    }
    new SampleClass();

});

if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {

    function autoExpandTextarea() {
        $(document)
        .on('focus.autoExpand', 'textarea.autoExpand', function(){
            var savedValue = this.value;
            this.value = '';
            this.baseScrollHeight = this.scrollHeight;
            this.value = savedValue;
        })
        .on('input.autoExpand', 'textarea.autoExpand', function(){
            var minRows = this.getAttribute('data-min-rows')|0, rows;
            this.rows = minRows;
            rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
            this.rows = minRows + rows;
        });
    }
    // Usage:
    // autoExpandTextarea();
});

if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

"use strict";

jQuery(document).ready(function ($) {
    window.waitForElement = function (elementPath, callBack){

        window.setTimeout(function(){
            if($(elementPath).length){
              callBack(elementPath, $(elementPath));
            }else{
              window.waitForElement(elementPath, callBack);
            }
        }, 500);

        // Usage:
        waitForElement("#ele_ID", "callBack");

    }
});

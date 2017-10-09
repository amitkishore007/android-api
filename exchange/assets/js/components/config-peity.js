/* --------------------------------------------------------------------------
 * File        : config-peity.js
 * Version     : 1.0
 * Author      : Indonez Team
 * Author URI  : http://indonez.com
 *
 * Indonez Copyright 2015 All Rights Reserved.
 * -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
 * javascript handle initialization
	1. Line Chart Jquery
 *
 * -------------------------------------------------------------------------- */
 
(function($) {

    "use strict";

    var themeApp = {

            //---------- 1. Line Chart Jquery -----------
            theme_line_chart: function() {
                $(".line").peity("line", {
                    delimiter: ",",
                    fill: "#e5f7f1",
                    max: null,
                    min: 0,
                    stroke: "#40c598",
                    strokeWidth: 2,
                    width: "100%",
                    height: "100%"
                })
            },
            

            // theme init
            theme_init: function() {
                themeApp.theme_line_chart();
            }

        } //end themeApp


    jQuery(document).ready(function($) {

        themeApp.theme_init();

    });

})(jQuery);
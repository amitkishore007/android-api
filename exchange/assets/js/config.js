/* --------------------------------------------------------------------------
 * javascript handle initialization
    1. Mediaelement
    2. Homepage Slider	
 *
 * -------------------------------------------------------------------------- */
 
(function($) {

    "use strict";

    var themeApp = {
            //---------- 1. Mediaelement  -----------
            theme_media: function() {
                var media = $('audio, video');

                media.mediaelementplayer();
            },

            //---------- 2. Homepage Slider -----------
            theme_slider: function() {
            //initialize swiper when document ready
                var mySwiper = new Swiper('.swiper-container', {
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    speed: 800,
                    autoplay: 7000,
                    autoplayDisableOnInteraction: true,
                })
            },     

            // theme init
            theme_init: function() {
                
                themeApp.theme_media(); 
                themeApp.theme_slider(); 
            }

        } //end themeApp


    jQuery(document).ready(function($) {

        themeApp.theme_init();

    });

})(jQuery);
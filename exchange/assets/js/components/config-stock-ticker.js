/* --------------------------------------------------------------------------
 * File        : config-stock-ticker.js
 * Version     : 1.0
 * Author      : Indonez Team
 * Author URI  : http://indonez.com
 *
 * Indonez Copyright 2015 All Rights Reserved.
 * -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
 * javascript handle initialization
    1. Stock Ticker Jquery
 *
 * -------------------------------------------------------------------------- */
 
(function($) {

    "use strict";

    var themeApp = {

            //----------- 1. Stock Ticker Jquery -----------            
            theme_price_ticker : function() {
                var StockPT = function StockPriceTicker() {
                    var Symbol = "",
                        CompName = "",
                        Price = "",
                        ChnageInPrice = "",
                        PercentChnageInPrice = "";
                    var CNames = "DEWA.JK,AKKU.JK,POLY.JK,ANTM.JK,BUMI.JK,DSFI.JK,WIKA.JK,WTON.JK,TLKM.JK"; //change the stock ticker here
                    var flickerAPI = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22" + CNames + "%22)&env=store://datatables.org/alltableswithkeys";
                    var StockTickerHTML = "";
                    var StockTickerXML = $.get(flickerAPI, function(xml) {
                        $(xml).find("quote").each(function() {
                            Symbol = $(this).attr("symbol");
                            $(this).find("Name").each(function() {
                                CompName = $(this).text();
                            });
                            $(this).find("LastTradePriceOnly").each(function() {
                                Price = $(this).text();
                            });
                            $(this).find("Change").each(function() {
                                ChnageInPrice = $(this).text();
                            });
                            $(this).find("PercentChange").each(function() {
                                PercentChnageInPrice = $(this).text();
                            });
                            var PriceClass = "GreenText",
                                PriceIcon = "up_green";
                            if(parseFloat(ChnageInPrice) < 0) {
                                PriceClass = "RedText";
                                PriceIcon = "down_red";
                            }
                            StockTickerHTML = StockTickerHTML + "<span class='" + PriceClass + "'>";
                            StockTickerHTML = StockTickerHTML + "<span class='quote'>" + CompName + " (" + Symbol + ")</span> ";
                            StockTickerHTML = StockTickerHTML + parseFloat(Price).toFixed(2) + " ";
                            StockTickerHTML = StockTickerHTML + "<span class='" + PriceIcon + "'></span>" + parseFloat(Math.abs(ChnageInPrice)).toFixed(2) + " (";
                            StockTickerHTML = StockTickerHTML + parseFloat(Math.abs(PercentChnageInPrice.split('%')[0])).toFixed(2) + "%)</span>";
                        });
                        $(".idz-ticker").html(StockTickerHTML);
                        $(".idz-ticker").jStockTicker({
                            interval: 30,
                            speed: 2
                        });
                    });
                }

                StockPT();
                setInterval(function() {
                    StockPT();
                }, 60000);
            },

            // theme init
            theme_init: function() {
                themeApp.theme_price_ticker();
            }

        } //end themeApp


    jQuery(document).ready(function($) {

        themeApp.theme_init();

    });

})(jQuery);
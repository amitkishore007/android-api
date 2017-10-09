 <footer>
         <div class="uk-container uk-light">
             <div class="uk-grid uk-margin-large-top">
                 <div class="uk-width-1-4@l uk-width-1-5@m uk-width-1-3@s">
                     <ul class="uk-list">
                         <!-- <li><a href="#">Jobs </a></li> -->
                         <li><a href="#">Press Room </a></li>
                         <!-- <li><a href="#">Mobile Apps </a></li> -->
                         <li><a href="#">Help &amp; Support </a></li>
                         <li><a href="#">Contact Us </a></li>
                     </ul>
                 </div>
                 <div class="uk-width-1-4@l uk-width-1-5@m uk-width-1-3@s">
                     <ul class="uk-list">
                         <li><a href="#">Security </a></li>
                         <li><a href="#">FAQ </a></li>
                         <!-- <li><a href="#">Sitemap </a></li> -->
                     </ul>
                 </div>
                 <div class="uk-width-1-4@l uk-width-1-5@m uk-width-1-3@s">
                     <ul class="uk-list">
                         <!-- <li><a href="#">Retirement &amp; 401ks </a></li> -->
                         <li><a href="#">Estate Planning </a></li>
                         <li><a href="#">Savings </a></li>
                         <!-- <li><a href="#">Tax Management </a></li> -->
                     </ul>
                 </div>
                 <div class="uk-width-1-4@l uk-width-2-5@m uk-width-1-1@s">
                     <div class="uk-align-right idz-footer-adjust">
                         <a href="javascript:void(0);" class="uk-icon-button uk-margin-small-right" data-uk-icon="icon: facebook"></a>
                         <a href="javascript:void(0);" class="uk-icon-button  uk-margin-small-right" data-uk-icon="icon: twitter"></a>
                         <a href="javascript:void(0);" class="uk-icon-button  uk-margin-small-right" data-uk-icon="icon: instagram"></a>
                         <a href="javascript:void(0);" class="uk-icon-button" data-uk-icon="icon: youtube"></a>
                     </div>
                     <div class="idz-footer-download uk-visible@m">
                         <a href="javascript:void(0);"><img src="./images/download_apple.png" alt="" /></a>
                         <a href="javascript:void(0);"><img src="./images/download_google.png" alt="" /></a>
                     </div>
                 </div>
               
             </div>
         </div>
         <a class="uk-inline" href="#" data-uk-totop="" data-uk-scroll="" data-uk-scrollspy="cls: uk-animation-fade; hidden: true; offset-top: 100px; repeat: true"></a>
     </footer>
     <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
    <!-- <script src="js/bootstrap.min.js"></script> -->
     <script src="<?php echo base_url('assets'); ?>/js/jquery.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/uikit.min.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/uikit-icons.min.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/components/swiper.js"></script>
     
     <script src="<?php echo base_url('assets'); ?>/js/components/peity.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/components/config-peity.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/components/mediaelement.js"></script>
     <script src="<?php echo base_url('assets'); ?>/js/config.js"></script>
     <script>
         
         var ajax_url = '<?php echo base_url(); ?>';
    
     </script>
     <script src="<?php echo base_url('assets'); ?>/js/script.js"></script>

     <script src="<?php echo base_url('assets'); ?>/js/qrcode.min.js"></script>
    <?php 

         $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


   if (strpos($url,'/balances') == true) { ?>
     <script>
          // var qrcode = new QRCode("crypto-qrcode",{
          //     text: 'wallet address goes here',
          //     width: 156,
          //     height: 156,
          //     colorDark : "#000000",
          //     colorLight : "#ffffff",
          //     correctLevel : QRCode.CorrectLevel.H
          // });

      </script>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
 <?php 

         $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


   if (strpos($url,'/market') == true) { ?>
<script type="text/javascript">
    
    $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?a=e&filename=aapl-ohlc.json&callback=?', function (data) {

        console.log(data);

    // create the chart
    Highcharts.stockChart('market-graph', {


        rangeSelector: {
            selected: 1
        },

        title: {
            text: 'Exchange'
        },

        series: [{
            type: 'candlestick',
            name: 'Exchange data',
            data: data,
            dataGrouping: {
                units: [
                    [
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]
                ]
            }
        }]
    });
});

</script>
<?php } ?>
 </body>

 </html>
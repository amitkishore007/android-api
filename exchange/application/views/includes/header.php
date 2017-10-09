<!DOCTYPE html>
 <html lang="en-gb" dir="ltr">

 <head>
     <!-- Standard Meta -->
     <meta charset="utf-8" />
     <meta name="format-detection" content="telephone=no" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <!-- Site Properties -->
     <title>Crypto trading</title>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
     <link rel="apple-touch-icon-precomposed" href="./images/apple-touch-icon.png" />
     <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Muli:300,800" rel="stylesheet" />
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet" />
     <!-- CSS -->
     <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/uikit.min.css" />
     <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/style.css" />
     <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/components/swiper.css" />
     <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/components/font-awesome.css" />  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

 <body>

     <header class="idz-header-alt signup-header">
         <div class="uk-container">
             <div class="uk-grid">
                 <div class="uk-width-auto">
                     <!-- logo header begin -->
                     <div id="header-logo2">
                         <a class="uk-logo" href="javascript:void(0);">Crypto Trading</a>
                     </div>
                     <!-- logo header end -->
                 </div>
                 <div class="uk-width-expand">
                     <nav class="uk-navbar-container uk-visible@m" data-uk-navbar="" style="z-index: 980;" data-uk-sticky="animation: uk-animation-slide-top; cls-active: uk-sticky2; cls-inactive: uk-navbar-container; bottom: #offset">
                         <div class="uk-navbar-right">
                             <ul class="uk-navbar-nav">
                               
                                 <li><a href ="<?php echo base_url('market'); ?>">Market</a></li>
                                <?php if(!$this->session->userdata('is_logged_in')): ?>
                                 <li><a href ="<?php echo base_url('login'); ?>">Login </a></li>
                                 <li class ="uk-visible@l">
                                    <a class="" href="<?php echo base_url('signup'); ?>">Create Account </a></li>   
                            <?php else: ?>

                                 <li><a href ="<?php echo base_url('balances'); ?>">Deposit & Withdrawal </a></li>
                                 <li><a href ="javascript:void(0);">Transfer Balances </a></li>
                                 <li><a href ="<?php echo base_url('logout'); ?>">Logout </a></li>
                                <?php endif; ?>

                             </ul>
                         </div>
                     </nav>
                     <!-- Mobile navigation begin -->
                     <a class="uk-button uk-align-center idz-mobile-nav alt uk-hidden@m" href="#modal-full" data-uk-icon="icon: menu" data-uk-toggle="">Menu </a>
                     <div id="modal-full" class="uk-modal-full" data-uk-modal="">
                         <div class="uk-modal-dialog">
                             <button class="uk-modal-close-full uk-close-large" type="button" data-uk-close=""></button>
                             <div data-uk-height-viewport="">
                                 <div class="uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle">
                                     <ul class="uk-nav-primary uk-nav-parent-icon" data-uk-nav="">
                              
                                 <li><a href ="<?php echo base_url('market'); ?>">Market</a></li>

                                  <?php if(!$this->session->userdata('is_logged_in')): ?>
                                        
                                         <li><a href="<?php echo base_url('login'); ?>">Login </a></li>
                                 <li class="uk-visible@l"><a class="" href="<?php echo base_url('signup'); ?>">Create Account </a></li>
                                    <?php else: ?>       
                                        <li><a href ="<?php echo base_url('balances'); ?>">Deposit & Withdrawal </a></li>
                                 <li><a href ="javascript:void(0);">Transfer Balances </a></li>
                                 
                                         <li><a href="<?php echo base_url('logout'); ?>">Logout </a></li>

                                  <?php endif; ?>
                                
                             </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- Mobile navigation end -->
                 </div>
             </div>
         </div>
     </header>
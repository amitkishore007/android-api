

     <section class="uk-margin-large-bottom">
         <div class="uk-container">
             <div class="uk-grid">
                 <div class="uk-width-3-5@l uk-width-3-5@m uk-width-1-1@s uk-align-center  uk-margin-large-bottom signup-wrapper">
                     <div class="uk-card uk-card-secondary uk-card-body my-signup">
                 <h3 class="text-center">Create an account</h3>
                        <form action="" method="post" class="user-signup-form" id='user-form'>
                          
                             <div class="form-group" >
                                <select name="country_id" id="" class="country form-control">
                                    <option value="">Select Country</option>
                                    <?php if(isset($countries)): ?>
                                        <?php foreach ($countries as $country): ?>

                                                <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>

                                       <?php endforeach; ?>
                                    <?php else: ?>
                                        <option>No Country available !</option>
                                    <?php endif; ?>

                                </select> 
                                <span class="text-danger country-error"></span>
                             </div> 
                            <div class="form-group">
                                 <input class="form-control" id="full-name" name='name' value="" type="text" placeholder="Full name">  
                                 <span class="text-danger name-error"></span>
                             </div>
                             <div class="form-group">
                                 <input class="form-control" id="email" name='email' value="" type="email" placeholder="Email ">  
                                 <span class="text-danger email-error"></span>
                             </div>
                             <div class="form-group">
                                 <input class="form-control" id="phone" name='phone' value="" type="number" placeholder="Phone number">  
                                 <span class="text-danger phone-error"></span>
                             </div>
                             <div class="form-group">
                                  
                             </div>
                             <div class="form-group">
                                 <input class="form-control" id="password" name='password' value="" type="password" placeholder="Password">  
                                 <span class="text-danger password-error"></span>
                             </div>
                             <div class="form-group">
                                 <input class="form-control" id="retypepassword" name='retype' value="" type="password" placeholder="Retype Password">  
                                 <span class="text-danger retype-error"></span>
                             </div>
                             <!-- <div class="form-group">
                                 <div class="g-recaptcha" data-sitekey="6Lc8GisUAAAAADv4FdXuQDO08DOeA9IVrK_POEi8"></div>
                             </div> -->
                             <div class="form-group">
                             <!-- <p>
                                <input type="checkbox" name='terms' value='1' class="term-condition">
                             I agree to the <a href="javascript:void(0);">Terms & Conditions</a></p> -->
                                 <input class="form-control btn btn-primary" id="create-account" value="Create account" type="submit" >  
                             </div>
                        </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>
    
     
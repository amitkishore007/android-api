
     <section class="uk-margin-large-bottom">
         <div class="uk-container">
             <div class="uk-grid">
                 <div class="uk-width-3-5@l uk-width-3-5@m uk-width-1-1@s uk-align-center  uk-margin-large-bottom signup-wrapper">
                 <h3 class="text-center">Enter OTP</h3>
                     <div class="uk-card uk-card-secondary uk-card-body my-signup">
                        <form action="" method="post" class="user-signup-form" id='user-form'>
                            
                             <div class="form-group" >
                                <select name="country_id" id="" class="country form-control">
                                    <option value="">Select</option>
                                    <option value="3">India</option>
                                    <option value="4">USA</option>
                                    <option value="5">JAPAN</option>
                                    <option value="6">AUS</option>
                                </select> 
                                <span class="text-danger country-error"></span>
                             </div> 
                            <div class="form-group">
                                 <input class="form-control" id="sent-otp" name='name' value="" type="text" placeholder="OTP">  
                                 <span class="text-danger name-error"></span>
                             </div>
                             
                             
                            
                             <div class="form-group">
                            
                                 <input class="form-control btn btn-primary" id="verify-otp" value="Create account" type="submit" >  
                             </div>
                        </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>
    
     
   
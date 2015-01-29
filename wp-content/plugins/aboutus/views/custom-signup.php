<?php get_template_part('header', 'newsroom'); ?>




<div class="section signup-progress">
      <div class="container" >
        <h1>Get Started<br />
<!-- Let’s do it. It’ll only take a minute.</h1> -->
        <h4>Signup Progress (<span id="progress-label">1</span> of 4)</h4>
        <div class="progress-bar">
          <div id="progress-progress" class="progress-progress step-1"></div>
          <div id="progress-orb" class="progress-orb step-1"></div>
        </div>
      </div>
    </div>

    <div class="section signup-form">
      <div class="container">
      
        <form id="signup-form" class="form" method="post" action="/upload-image">
        
          <div class="step step-1">
            <h3>Account Details.</h3>
            <p>We need to grab a few details to set up your account.<br />Please confirm the fields below.</p>
            <div class="form-row form-row-double">
              <div class="left">

                <label>Firstname</label>
          
                <input type="text" class="text required" name="input_5.3" value="<?php echo @$profile->firstName ?>" />
              </div>
              <div class="right">
            
                <label>Lastname</label> 

                <input type="text" class="text required" name="input_5.6" value="<?php echo @$profile->lastName ?>"/>
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left">
  
                <label>Password</label>


                <input id="password" type="password" class="text required" name="input_13"/>
              </div>
              <div class="right">


                <label>Confirm Password</label> 

                <input type="password" class="text required" name="input_13_2"/>
              </div>
            </div>
            <div class="form-actions">
              <a class="btn change-step" href="javascript:;" data-step="2">Continue</a>
            </div>
          </div>
          <div class="step step-2 hidden">
            <h3>Business Details</h3>
            <p>Let us know about your business, so we can share this information with others.</p>
            <div class="form-row form-row-double">
              <div class="left">
     
                <label>Business Name *</label>
   
                <input type="text" class="text required" name="input_6" />
              </div>

               <div class="right">
              
                <label>Email *</label>
         
                <input id="email" type="text" class="text required email" name="input_20"/>
              </div>


            </div>
            <div class="form-row form-row-double">
             
              <div class="left">
           
                <label>Phone</label>
               
                <input type="text" class="text" name="input_16"/>
              </div>
               <div class="right">
       
                <label>Website</label>
            
                <input type="text" class="text" name="input_17"/>
              </div>

            </div>


            <div class="form-row form-row-double">
             
              <div class="left">
             
                <label>Slogan</label>
        
                <input type="text" class="text" name="input_21"/>
              </div>

           
            </div>
            <div class="form-row form-row-double">
   
              <label>Business Description</label>


             <div class="left single">
                <textarea name="input_7" id="business-description-input" class="text" maxlength="260"></textarea>
<!--                 <span class="description">A short one to two sentence description of your business - we'll share this with other users.</span>
 -->              </div>
           
            </div>


             <!--   <div class="right"> -->
              


            <div class="form-row form-row-double">
              


              <div class="left">
                <label>Region</label>
                <select class="select" name="input_25">
                  <optgroup label="North Island">
                    <option>Northland</option>
                    <option>Whangarei</option>
                    <option>Auckland</option>
                    <option>Waiheke Island</option>
                    <option>Pukekohe</option>
                    <option>Waiuku</option>
                    <option>Whakatane</option>
                    <option>Waikato</option>
                    <option>Hamilton</option>
                    <option>Tauranga</option>
                    <option>Rotorua</option>
                    <option>Taupo</option>
                    <option>New Plymouth</option>
                    <option>Bay of Plenty</option>
                    <option>Gisborne</option>
                    <option>Hawke's Bay</option>
                    <option>Napier</option>
                    <option>Hastings</option>
                    <option>Taranaki</option>
                    <option>Feilding</option>
                    <option>Palmerston North</option>
                    <option>Wanganui</option>
                    <option>Levin</option>
                    <option>Kapiti</option>
                    <option>Manawatu</option>
                    <option>Masterton</option>
                    <option>Wairarapa</option>
                    <option>Wellington</option>
                  </optgroup>
                  <optgroup label="South Island">
                    <option>Nelson</option>
                    <option>Blenheim</option>
                    <option>Marlborough</option>
                    <option>Greymouth</option>
                    <option>Ashburton</option>
                    <option>West Coast</option>
                    <option>Canterbury</option>
                    <option>Timaru</option>
                    <option>Oamaru</option>
                    <option>Queenstown</option>
                    <option>Dunedin</option>
                    <option>Invercargill</option>
                    <option>Southland</option>
                    <option>Bluff</option>
                  </optgroup>
                  <option>Other</option>
                </select>
            



               
              </div>
                   <div class="right">
                <label>Business Category</label>

                <select class="select" name="input_26"> 
                <?php
global $business_categories;
if(count($business_categories)): foreach($business_categories as $value => $label): ?>
                  <option value="<?php echo $value ?>"><?php echo $label ?></option>
<?php endforeach; endif ?>


                </select>
                 </div>
            </div>
            <div class="form-actions">
              <a class="btn clear change-step" href="javascript:;"  data-step="1">Back</a>
              <a class="btn change-step" href="javascript:;"  data-step="3">Continue</a>
            </div>
          </div>
          <div class="step step-3 hidden">
            <h3>Address Details</h3>
            <?php /*<p>Let us know about your business, so we can share this information with others.</p>*/ ?>
            <p>Enter a physical address for your business below.<br />We'll use this to power the map on your public profile.</p>
            <p></p>
            <p>PO BOX addresses are also welcome. In this case, Google maps may point to where you currently are instead of your physical address.</p>
      <!--  <p>If you would like to display a different address to visitors such as a PO Box, or add multiple addresses, you can do this from inside About Us.</p>-->
            <div class="form-row">
              <div class="left geocomplete">

             
                <label>Address Lookup</label>
    
                <input type="text" class="text required" name="input_15"/>
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left street_number">

                <label>Street Number</label>
   
                <input type="text" class="text required" name="input_8"/>
              </div>
              <div class="right route">

                <label>Street</label>
 
                <input type="text" class="text required" name="input_9"/>
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left sublocality_level_1">

                <label>Suburb</label>
  

                <input type="text" class="text required" name="input_10"/>

              </div>


              <div class="right locality">
  
                <label>City</label>
         

                <input type="text" class="text required" name="input_11"/>

              </div>
            </div>



            <div class="form-row form-row-double">
              <div class="left postal_code">
              
               
                  <label>Postcode</label>

                <input type="text" class="text required" name="input_12"/>
              </div>
              





            </div>
             <div class="form-row form-row-double">
             <div class="left">
                <li style="list-style:none;"id="field_4_27" class="gfield gfield_error">
                   <label class="gfield_label" for="input_4_27">Captcha</label>
                   <script type="text/javascript"> var RecaptchaOptions = {theme : 'clean'}; if(parseInt('19') > 0) {RecaptchaOptions.tabindex = 19;}</script>
                   <div class="ginput_container" id="input_4_27">
                   <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LfY2OkSAAAAACQwgBpg6-rBoaXCFd5TlPLUCLxL&amp;hl=en"></script>
                   <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha.js"></script>
                   </div>
                  </li> 
            </div>
            <!-- CAPTCHA -->
           
           </div>
         

            <div class="form-row form-row-double">
              <div class="left">
                
              </div>
            </div>
            
            <div class="hidden LatLng">
              <input type="hidden" name="input_18" />
            </div>
            
            <div class="form-actions">
              <a class="btn clear change-step" href="javascript:;"  data-step="2">Back</a>
              <a id="submit-form" class="btn submit-form" href="javascript:;">Continue</a>
            </div>

             <input type='hidden' class='gform_hidden' name='is_submit_4' value='1' />
          <input type='hidden' class='gform_hidden' name='gform_submit' value='4' />
          <input type='hidden' class='gform_hidden' name='gform_unique_id' value='' />
          <input type='hidden' class='gform_hidden' name='state_4' value='' />
          <input type='hidden' class='gform_hidden' name='gform_target_page_number_4' id='gform_target_page_number_4' value='2' />
          <input type='hidden' class='gform_hidden' name='gform_source_page_number_4' id='gform_source_page_number_4' value='1' />
          <input type='hidden' name='gform_field_values' value='' />
    
          </div>
      
         
<?php /*

          <div class="step step-4 hidden">
            <h3>Account Display</h3>
            <p>Pick one of these images to use as the background picture for your profile.  You can update this from your dashboard later.</p>
            <div class="form-row form-row-backgrounds">
              <label>Profile Background</label>
              <ul id="form-backgrounds" class="form-backgrounds">
                <li data-id="one" class="active">
                  <img src="/assets/background-thumbnails/one.jpg" alt="">
                </li>
                <li data-id="two">
                  <img src="/assets/background-thumbnails/two.jpg" alt="">
                </li>
                <li data-id="one">
                  <img src="/assets/background-thumbnails/one.jpg" alt="">
                </li>
                <li data-id="two">
                  <img src="/assets/background-thumbnails/two.jpg" alt="">
                </li>
                <li data-id="one">
                  <img src="/assets/background-thumbnails/one.jpg" alt="">
                </li>
                <li data-id="two">
                  <img src="/assets/background-thumbnails/two.jpg" alt="">
                </li>
              </ul>
              <input id="background" type="hidden" name="background" value="one">
            </div>
            <div class="form-actions">
              <a class="btn clear change-step" href="javascript:;"  data-step="3">Back</a>
              <a id="submit-form" class="btn submit-form" href="javascript:;">Continue</a>
            </div>
          </div>
*/ ?>
         
        </form>
        <?php include('footer.php'); ?>
      </div>
    </div>

<script type="text/javascript">
$(function(){

  var validator = $("#signup-form").validate({
    rules: {
      input_20: "required", // password
      input_13_2: { // confirm password
        equalTo: "#password"
      },
      background: "required",
      input_20: { // email
        required: true,
        email: true,
        pattern: /^[A-Za-z0-9@.-]+$/,
        remote:  {
          url: "/check-email",
          type: "get",
          data: {
            email: function() {
              return $( "#email" ).val();

            }
          }
        }
      }
    },
    submitHandler: function(form) {
      $("#submit-form").attr('disabled', '/upload-image').css({opacity: 0.5}).html('Creating Account...');
      $(".step-3").find('input').css({opacity: 0.3});
      form.submit();


     
     
    }
  });


  $(".change-step").on('click', function(e){
    var step = $(this).attr('data-step');

    if(validator.form()) {
      // Validate current step
      $(".step").addClass('hidden');
      $(".step-" + step).removeClass('hidden');

      $("#progress-progress").removeClass('step-1 step-2 step-3 step-4').addClass('step-' + step);
      $("#progress-orb").removeClass('step-1 step-2 step-3 step-4').addClass('step-' + step);
      $("#progress-label").html(step);

    }

  });

  $("#submit-form").on('click', function(e){
    $("#signup-form").submit();


    
  });

  $("#form-backgrounds li").on('click', function(e){
    e.preventDefault();
    $("#form-backgrounds li").removeClass('active');
    $(this).addClass('active');
    $("#background").val($(this).attr('data-id'));
  });


});
</script>


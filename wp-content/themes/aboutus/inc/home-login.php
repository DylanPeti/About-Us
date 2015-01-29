<?php
/* Login template. */
?>
<?php if ( !is_user_logged_in() ): ?>
<section id="signup_form">
  <div class="signup_container">
    <div class="sn_signup">
      <ul class="social-connect">
        <li><a href="/login-hauth?s=Twitter" class="btns twitter-btn"><div>Sign up with Twitter</div></a></li>
        <li><a href="/login-hauth?s=Facebook" class="btns facebook-btn"><div>Sign up with Facebook</div></a></li>
      </ul>
    </div>
    <div class="or">or</div>


    <div class="email_login">
        <h3>Sign up with your email address</h3>
        <form method='post' enctype='multipart/form-data' id='gform_1' action='/setup/'>

          <div class='gform_body'>
              <ul id='gform_fields_1' class='gform_fields top_label description_below'>
                <li id='field_1_4' class='gfield' >
                  <label class='gfield_label' for='email'>Email</label>
                  <div class='ginput_container'>
                    <input name='email' id='email' type='email' value='Email Address' class='medium'  tabindex='3'   />
                  </div>
                </li>

                <li id='field_1_13' class='gfield' >
                  <label class='gfield_label' for='input_1_13'>Business Name</label>
                  <div class='ginput_complex ginput_container' id='input_1_13_container'>
                    <span id='input_1_13_1_container' class='ginput_left'>
                      <input type='text' name='business_name' id='password' value='Business Name' tabindex='4' />
                    </span>
                  </div>
                </li>

                <li id='field_1_14' class='gfield terms' >
                  <p>By registering, you agree to the <br><a href="/user-agreement/">Terms of Service</a>.
                </li>

              </ul>
          </div>

          <div class='gform_footer top_label'>
            <input type='submit' id='gform_submit_button_1' class='button gform_button' value='Sign up' tabindex='16' />
          </div>
        </form>
    </div>
  </div>
  <p class="login_now">Already have an account? <a href="#" data-toggle="modal" data-target="#loginmodal">Log in</a>.</p>
</section>


<script type="text/javascript">
$('#email').click(function(){

    if($(this).val() == 'Email Address'){
        $(this).val('');
    }
});

$('#password').click(function(){
    if($(this).val() == 'Business Name'){
        $(this).val('');
    }
});

</script>
<?php endif ?>

<?php include('header.php') ?>

<div class="section signup-progress">
      <div class="container">
        <h1>Ready to join AboutUs?<br />
Let’s do it. It’ll only take a minute.</h1>
        <h4>Signup Progress (1 of 4)</h4>
        <div class="progress-bar">
          <div class="progress-progress step-1"></div>
          <div class="progress-orb step-1"></div>
        </div>
      </div>
    </div>

    <div class="section signup-form">
      <div class="container">
        <h3>Account Details.</h3>
        <p>We need to grab a few details so we can complete setting up your account.<br />Please fill out the fields below.</p>
        <form class="form">
          <div class="step step-1">
            <div class="form-row form-row-double">
              <div class="left">
                <label>Firstname</label>
                <input type="text" class="text" name="firstname" />
              </div>
              <div class="right">
                <label>Lastname</label>
                <input type="text" class="text" name="lastname" />
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left">
                <label>Password</label>
                <input type="password" class="text" name="password" />
              </div>
              <div class="right">
                <label>Confirm Password</label>
                <input type="password" class="text" name="confirm_password" />
              </div>
            </div>
            <div class="form-actions">
              <a class="btn change-step" href="javascript:;" data-step="2">Continue</a>
            </div>
          </div>
          <div class="step step-2 hidden">
            <div class="form-row form-row-double">
              <div class="left">
                <label>Business Name</label>
                <input type="text" class="text" name="firstname" />
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left">
                <label>Email</label>
                <input type="text" class="text" name="firstname" />
              </div>
              <div class="right">
                <label>Phone</label>
                <input type="text" class="text" name="lastname" />
              </div>
            </div>
            <div class="form-row form-row-double">
              <div class="left">
                <label>Website</label>
                <input type="password" class="text" name="password" />
              </div>
              <div class="right">
                <label>Slogan</label>
                <input type="password" class="text" name="confirm_password" />
              </div>
            </div>
            <div class="form-row ">
              <label>Business Description</label>
              <textarea name="business-description" class="text"></textarea>
              <p class="description">A short one to two sentence description of your business - we'll share this with other users.</p>
            </div>
            <div class="form-actions">
              <a class="btn clear change-step" href="javascript:;"  data-step="1">Back</a>
              <a class="btn change-step" href="javascript:;"  data-step="3">Continue</a>
            </div>
          </div>
        </form>
      </div>
    </div>

<script type="text/javascript">
$(function(){

  $(".change-step").on('click', function(e){
    // Validate current step
    $(".step").addClass('hidden');
    $(".step-" + $(this).attr('data-step')).removeClass('hidden');
  });

});
</script>

<?php include('footer.php');
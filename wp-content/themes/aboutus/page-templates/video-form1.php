<?php
/**
 * Template Name: Video Form
 * Default admin pages.
 */

$id =  TheFold\AboutUs\get_biz_from_user($current_user->ID)->ID;
$splitName = explode(' ', $current_user->display_name); 
$name = $splitName[0];
$lastname = $splitName[1];
$email = $current_user->user_email;
$business = TheFold\AboutUs\get_biz_from_user($current_user->ID)->post_title;
$address = implode(', ',TheFold\AboutUs\get_biz_address( $id ));
$phone = get_post_field( 'phone', $id, '');
get_header();


?>





      <div class="video-request-container">

	     	<div class="content center video">
        <div class="video-request">
        <h1>Is it time to tell your story with video? <br /> Get a free measure and quote.</h1>
        <div class="centre-more">
        <p>About Us has a network of skilled videographers around New Zealand that can bring your story to life quikly
         easily and for less money than you'd think.
        </p>
        <p>Let us know who you are, what you have in mind and how we can contact you.</p>
          <form id="video-request-form" action="" method="post">
            <label>Name of your Business</label>
            <input name="business" type="text" value="<?php echo $business ?>"/>

            <label>Where you're based</label>
            <input name="where" type="text" value="<?php echo $address ?>" />

             <label>What do you have in mind for the video?</label>
             <textarea name="comment" type="text" form="usrform"></textarea>

           <div class="inline-block-inputs left">
             <label class="video-label">Your first name</label>
            <input id="video-firstname" name="firstname" type="text" value="<?php echo $name; ?>"/>
           </div>


            <div class="inline-block-inputs right">
             <label class="video-label">Last name</label>
            <input id="video-lastname"  name="lastname" type="text" value="<?php echo $lastname ?>" />
            </div>

             <label>Your contact email</label>
            <input name="email" type="text" value="<?php echo $email ?>" />

             <label>A phone number we can reach you on</label>
             <input name="phone" type="text" value="<?php echo $phone; ?>"/>

             <p>Finished? Click 'send' and we'll be in touch!</p>

             <input id="video-request-submit" name="submit" type="submit" value="send">


          </form>
          </div>


    <?php 
    if(isset($_POST['submit'])){
     $to = "dylan@socialize.co.nz";
     $subject = "User Video Request";
        $message = "Business: " . $_POST['business'] . "\r\n";
        $message .= "Location: " . $_POST['where'] . "\r\n";
        $message .= "Comment: " . $_POST['comment']. "\r\n";
        $message .= "Firstname: " . $_POST['firstname'] . "\r\n";
        $message .= "Lastname: " . $_POST['lastname'] . "\r\n";
        $message .= "Email: " . $_POST['email'] . "\r\n";
        $message .= "Phone: " . $_POST['phone'] . "\r\n";

     $headers = "from: dylan";
     mail($to, $subject, $message, $headers);
     echo "Thanks for contacting us! We'll be in touch shortly";

    }


    ?>


		  	
      </div>
   
      </div>
    </div>

<?php get_footer(); ?>
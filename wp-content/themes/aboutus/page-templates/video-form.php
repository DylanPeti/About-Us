<?php
/**
 * Template Name: Video Form
 * Default admin pages.
 */

$id =  TheFold\AboutUs\get_biz_from_user($current_user->ID)->ID;
$splitName = explode(' ', $current_user->display_name); 
$name = $splitName[0];

$lastname = (isset($splitName[1])) ? $splitName[1] : null;
$email = $current_user->user_email;
$business = TheFold\AboutUs\get_biz_from_user($current_user->ID)->post_title;
$address = implode(', ',TheFold\AboutUs\get_biz_address( $id ));
$phone = get_post_field( 'phone', $id, '');



get_header();

$query = $_GET['post'];





$posts = get_post($query, OBJECT);

$thumbID = get_post_thumbnail_id( $posts->ID );
$thumb = wp_get_attachment_url($thumbID);

                                   

?>

      <div class="video-request-container" style="background-image: url('<?php echo $thumb ?>')">

	     	<div class="content center video">
        <div class="video-request">
      <!--   <h1>Is it time to tell your story with video? <br /> Get a free measure and quote.</h1> -->
      <h1><?php echo $posts->post_title; ?></h1>
        <div class="centre-more">
        <!-- <p>About Us has a network of skilled videographers around New Zealand that can bring your story to life quikly
         easily and for less money than you'd think.
        </p> -->
        <?php echo $posts->post_content; ?>
        <p>Let us know who you are, what you have in mind and how we can contact you.</p>
          <form id="video-request-form" action="" method="post">
            <label>Your Facebook Page</label>
            <input name="business" type="text" value=""/>

            <label>Your website URL</label>
            <input name="where" type="text" value="" />


            <label class="form-selection-title">What are you trying to achieve? (tick one)</label>
             <div class="form-selection">
                <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" checkbox="checked" name="section[1][]" value="Get more likes" id="get-more-likes" />
                <label for="get-more-likes">Get more likes</label>
                </div>
                
                <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="section[1][]" value="" id="more-visits" />
                <label for="more-visits">More visits to my website</label>
                </div>
                
                <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="section[1][]" value="" id="promote-a-special-offer" />
                <label for="promote-a-special-offer">Promote a special offer</label>
                </div>
             </div>  

          <label class="form-selection-title">Who do you want to reach? (tick as many as you like)</label>
           <div class="form-selection">
            <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="town" value="Get more likes" id="people-in-my-town">
                <label for="people-in-my-towns">People in my town</label>
                </div>
             <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="nz" value="" id="people-in-new-zealand">
                <label for="people-in-new-zealand">People in New Zealand</label>
                </div>
    
                 <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="australia" value="" id="people-in-australia">
                <label for="people-in-australia">People in Australia</label>
                </div>
               <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="all-over" value="" id="people-all-over-the-world">
                <label for="people-all-over-the-world">People all over the world</label>
                </div>
            </div>

          <label class="form-selection-title">How much do you want to spend this month? (tick one)</label>
           <div class="form-selection">
            <div class="inline-form-tags">
                <input class="checkbox" type="checkbox" name="section[3][]" value="Get more likes" id="$250">
                <label for="$250">Up to $250</label>
                </div>


                 <div class="inline-form-tags">
   
                <input class="checkbox" type="checkbox" name="section[3][]" value="" id="$250-$500">
                <label for="$250-$500">Between $250 - $500</label>
                </div>

                 <div class="inline-form-tags">
    
                <input class="checkbox" type="checkbox" name="section[3][]" value="" id="$500-$1000">
                <label for="$500-$1000">Between $500 - $1000</label>
                </div>
                 <div class="inline-form-tags">

                <input class="checkbox" type="checkbox" name="section[3][]" value="" id="more-than-$1000">
                <label for="more-than-$1000">More than $1000</label>
                </div>
           </div>


         

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
             <input name="phone" type="text" value="<?php  ?>"/>

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
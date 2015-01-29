<?php

// require_once('/Users/Dylan/Applications/aboutus/core/wp-load.php');

// include '/home/ec2-user/httpdocs/aboutus/core/wp-core.php';
global $post;
$backgroundImage = TheFold\AboutUs\get_biz_background_src(get_the_ID()); 
$logo = TheFold\AboutUs\get_biz_logo_src(get_the_ID());
$description = get_post_field('post_content', get_the_ID());
$address = implode('</br>',TheFold\AboutUs\get_biz_address( get_the_ID() ));
if(isset($post)){
$title = get_post($post->ID)->post_title;
}
$baseurl  = "http://" . $_SERVER['SERVER_NAME'] . "/"; 
$profile_url = get_permalink(TheFold\AboutUs\get_biz_from_user());

?>
<div class="extend-background greeny">
<div class="sheet container">
<div class="dash-profile" >

  <div class="dash-profile-info" style="background: url(<?php echo $backgroundImage ?>) no-repeat">
  <div class="dash-details">

   <div class="dash-logo" id="image" style="background: url(<?php echo $logo ?>) no-repeat">

   <a href="<?php echo $baseurl ?>upload-image"><button id="dash-button">Change Logo</button></a>
   </div>

   
   <h3 class="custom-font"><?php echo wp_trim_words($title, 7, '...'); ?></h3>
   <p id="dash-business-description"><?php echo wp_trim_words(strip_tags($description), 30, '...'); ?></p>
  
   <a href="<?php echo $baseurl ?>profile"><button id="dash-button" class="shift">Edit Profile</button></a>
   </div>
    
    <a href="<?php echo $baseurl ?>upload-image"><button id="dash-button" class="shift">Edit Cover</button></a>


 </div>
 </div>
    
<div id="dashboard-stats" class="section dashboard-stats">
   <div class="stats-container">
    <div id="stats-heading-container">
      <div class="dashboard-stats-title">
          <h2>Your online presence</h2>
          <a href="<?php echo $profile_url ?>">
          <button id="" class="pad-l-r-10 custom-button stats-button">View Your Page</button>
          </a>
       </div>

<!--       <a href="<?php echo get_permalink(TheFold\AboutUs\get_biz_from_user()) ?>"><button>My Page</button></a> -->
    </div>
</div>
        <ul class="dashboard-stats-counters ajax-load" data-url="/overview-stats"></ul>
      </div>
      </div>
      </div>
    </div>

   
<?php
global $wpdb;
include '/home/ec2-user/httpdocs/aboutus/core/wp-blog-header.php';
 $q = $_GET["b"];

if (is_object($wpdb) && is_a($wpdb, 'wpdb')) {
$sql = "SELECT * FROM wp_postmeta WHERE meta_key='locality' AND meta_value = '".$q."'";
$result = $wpdb->get_results($sql);


foreach ($result as $item) {
   $id = $item->post_id;	
   $background_image = TheFold\AboutUs\get_biz_background_src($id); 
   $get_profile_image =  TheFold\AboutUs\get_biz_logo_src($id);

?>
	<div class="search-content" style="background-color:#fff">
	  <div style=" width: 150px; height: 50px; background-image: url(<?php echo $get_profile_image ?>); background-repeat:no-repeat; background-position:right center; background-size: contain; position: absolute; right: 0; top:30%;"></div>
		 <div class="content-hold" id="content-hold-this" style=" width: 220px;">
          <h2><?php $user_post = get_post( $item->post_id); echo $user_post->post_title; ?></h2>
              <?php $current_post_id = $user_post->post_ID; ?>
       	  <ul>
	        <?php
	        $phones = get_field('phone', $item->post_id);
            $phonesa = substr($phones, 1);
            $phone =  "+64 " . $phonesa;
	        $email = get_field('email', $item->post_id);
		    echo (implode('</br>',TheFold\AboutUs\get_biz_address( $id )));
	        echo "<br /> <br />";
	        ?>
  
	        <?php if(!empty($phone)){ ?>	 <li id="search-profile-phone"><?php   echo $phone; ?></li> <?php } else { ?> <li id="search-profile-phone"><?php echo "-"; ?></li> <?php }?>
	        <?php if(!empty($email)){ ?>	 <li id="search-profile-email"><?php   echo $email; ?></li> <?php } else { ?> <li id="search-profile-email"><?php echo "-"; ?></li> <?php } ?>
	     </ul>
	
<?php $post_name = $user_post->post_name;
      $actual_link = "http://$_SERVER[HTTP_HOST]/about/$post_name"; ?>

       </div>
   </div>
   

<?php } }  ?>


<?php //file end 
get_footer(); 

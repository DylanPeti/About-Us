<?php
include $_SERVER['DOCUMENT_ROOT'] . 'core/wp-blog-header.php';

/* if all news is clicked
*
*/
$identifier = $_GET['identifier'];

?>
<?php if($identifier == 'all-news') { ?>

 <div id="filter-container" class="left-section masonry">
 <?php


        $all_categories = get_categories();
        $store_parent_names = array();
        foreach ($all_categories as $single_category) {
        if ($single_category->category_parent > 0) continue;
        $convert_object_to_array = get_object_vars($single_category);
        $store_parent_names[] = $convert_object_to_array['name'];
        }
        $limit_parent_names = array_slice($store_parent_names, 0, 7);

?>

<?php foreach ($limit_parent_names as $single_parent) {

       if($single_parent == 'marketplace') continue;
         $small_post_one = new WP_Query(mini_post($single_parent, '', 1));    
         while ($small_post_one->have_posts()) : $small_post_one->the_post();     
         $do_not_duplicate[] = $post->ID; ?>   
          <?php $names = get_cat_ID($single_parent);  
          $category = get_the_category($post->ID);
           ?>
             <section class="bottom-section-one">
             <a href="<?php the_permalink($post->ID); ?>"> 
                      
                      <div class="left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
                      <?php $base_url = "http://$_SERVER[HTTP_HOST]"; 
                      $categoryLink = $base_url . '/category/' . $category[0]->name;
                      $link = preg_replace('/\s+|&/', '-', $categoryLink);

                      ?>

                      <a href="<?php echo $link; ?>">
                         <span id="tag"><?php echo $single_parent ?></span>
                      </a>
                      <div class="left-section-description">
                      <h3><?php the_title(); ?></h3>
                      <p id="large-content"><?php echo trim_the_content(50); ?></p>
                      <p id="small-content"><?php echo trim_the_content(10); ?></p>
                      
                      </div>
                    <a href="<?php echo get_permalink($post->ID); ?>"> 
                      <span id="read-more">Read More ›</span>
                    </a>

            </a>
             </section>
          <?php endwhile; } wp_reset_postdata(); ?> 
          </div>

          <?php

} else if ($identifier == 'offers') {

?>

<!-- marketplace -->
<?php

/* if marketplace is clicked
*
*/

?>
 <div id="filter-container" class="left-section offers-loader marketplace-columns">

     <?php
        $do_not_duplicate = array();
        $small_post_one = new WP_Query(mini_post('marketplace', $do_not_duplicate, 8));
        while ($small_post_one->have_posts()) : $small_post_one->the_post(); 
        $do_not_duplicate[] = $post->ID; 
        ?>    
    

           <?php
           $meta_values = array();
            $meta_values[] = get_post_meta($post->ID, 'video', true );
            $meta_values[] = get_post_meta($post->ID, 'description', true );
            $meta_values[] = get_post_meta($post->ID, 'link', true );
            $meta_values[] = get_post_meta($post->ID, 'button', true );
            $meta_values[] = get_post_meta($post->ID, 'image', true );

            $oembed_endpoint = 'http://vimeo.com/api/oembed';
            if(isset($_GET['url'])){
               $video_url = $_GET['url'];
            } else if($meta_values[0]){
              $ro = preg_replace('/\s+/', '',$meta_values[0]);
              $video_url = $ro;
            } else {
              $video_url = null;
            }

           if(isset($video_url)){
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=640';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=640';
            
           }
          


           $use_errors = libxml_use_internal_errors(true);


           if(isset($xml_url)) {
             $oembed = simplexml_load_string(curl_get($xml_url)); 
             echo (isset($oembed)) ? '' : "not working"; 
             libxml_clear_errors();
             libxml_use_internal_errors($use_errors);
          }
       ?>
          
             


        
            








      
          <section class="marketplace-articles ajaxed" style="height: auto;" data-id="<?php echo $post->ID; ?>">
           <a href="<?php the_permalink($post->ID); ?>"> 



              <div class="marketplace-left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
            <!--   <div class="marketplace-left-section-description description show" data-id="<?php echo $post->ID; ?>"> -->
             
                 <h3 class=""><?php the_title(); ?></h3>
                 <p> <?php echo trim_the_content(20); ?> </p>

                 <?php if(isset($meta_values[3])){ ?>
                     <p class="diff arrange"><?php echo $string; ?>
                     <button class="diff"> <?php  echo $meta_values[3];  ?></button>
                     </p>
                 <?php } ?>
                 <?php if(isset($meta_values[2])){ ?>
                 <button class="diff"><?php  echo $meta_values[2]; ?> </button>
                 <?php } ?>
              <!--    <div id="video-press" class="diff vid-arrange" style="background-image: url('<?php echo $oembed->thumbnail_url; ?>')">
                 <a class="marketplace-init" href="#javascript;">

                 <button id="watch-video"> <?php  echo $meta_values[2];  ?></button> 

                   </a> 
                 </div> -->
               <a href="<?php the_permalink($post->ID); ?>"> 
                 <p id="read-more">View this offer</p>
                 </a>

  
          

            </a>
          </section>


<?php // include 'inc/article-toggle.php'; ?>

        <?php endwhile; ?>

        </div>


        <?php

} else{

$categories = array();

  foreach (get_categories() as $key) {

  $singleCatsArray[] = $key->slug;

  }

?>


<div id="filter-container" class="left-section masonry">
 <?php



    if (is_user_logged_in()){ 

    } else{  ?>


    <div class="block-users white"></div>
    <div class="sign-in-box">
      <h1 class="custom-font">We'd like to get to<br />know you.</h1>
      <h4 class="custom-font"><a href="/signup">Sign up</a> or <a id="login-here" class="btn outline green font-normal custom-font" href="javascript:;" data-toggle="modal" data-target="#loginmodal">
          sign in</a> so we can pick<br />the best articles for you!</h4>


    </div>
     
    <?php }


        $store_parent_names = array();
         $all_categories = get_categories();
        foreach ($all_categories as $single_category) {

        $convert_object_to_array = get_object_vars($single_category);

        $store_parent_names[] = $convert_object_to_array['name'];
        }


        $limit_parent_names = array_slice($singleCatsArray, 0, 6);

?>

<?php foreach ($limit_parent_names as $single_parent) {

         if($single_parent == 'marketplace') continue;

if(isset(TheFold\AboutUs\get_biz_from_user()->ID)){
$userID = TheFold\AboutUs\get_biz_from_user()->ID;
$userInfo = get_post_meta($userID);


}
if(isset($userInfo->business_category) && isset($userInfo->locality[0])){
$userOccupation = strtolower(end($userInfo->business_category));
$userCity = $userInfo->locality[0];
$postQuery = array($userOccupation, $userCity);
} else {
$userOccupation = null;
$userCity = null;
$postQuery = null;
}


$postQuery = array($userOccupation, $userCity);

$catIDs = array();

$catIDs[] = get_category_by_slug($userOccupation  );

if(isset(get_category_by_slug($userCity)->ID)){
$catIDs[] = get_category_by_slug($userCity)->ID;
}




 if(in_array($userOccupation, $limit_parent_names)){

     

     $small_post_one = new WP_Query(mini_post($userOccupation, $do_not_duplicate, 1)); 

} else {



     $small_post_one = new WP_Query(mini_post($single_parent, '', 1)); 


}
  

         while ($small_post_one->have_posts()) : $small_post_one->the_post();   

         $do_not_duplicate[] = $post->ID; ?>   

         <?php $names = get_cat_ID($single_parent);   ?>



             <section class="bottom-section-one">
             <a href="<?php the_permalink($post->ID); ?>"> 
                      
                      <div class="left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
                      <?php $base_url = "http://$_SERVER[HTTP_HOST]"; 
                      $category = get_the_category($post->ID);
                      $categoryLink = $base_url . '/category/' . $category[0]->name;
                      $link = preg_replace('/\s+|&/', '-', $categoryLink);
                      ?>
                      <a href="<?php echo $link; ?>">
                       <span id="tag"><?php echo $single_parent ?></span>
                      </a>


                      <div class="left-section-description">
                      <h3><?php the_title(); ?></h3>
                      <p id="large-content"><?php echo trim_the_content(50); ?></p>
                      <p id="small-content"><?php echo trim_the_content(10); ?></p>
                       <a href="<?php the_permalink($post->ID); ?>"> 
                      <span id="read-more">Read More ›</span>
                      </a>
                      </div>

            </a>
             </section>
            

          <?php endwhile; } wp_reset_postdata();
          ?> </div> 












<?php


}
        ?>








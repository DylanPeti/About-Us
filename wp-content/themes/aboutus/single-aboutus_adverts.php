<?php
  
global $post;

$posts_in = 1;
$posts_in_two = 4;
//$sponsor = get_sponsor();
define("POST_IN_CATEGORY", 1);
$id =  TheFold\AboutUs\get_biz_from_user($current_user->ID)->ID;
$splitName = explode(' ', $current_user->display_name); 
$name = $splitName[0];
if(isset($splitName[1])){
$lastname = $splitName[1];
}
$email = $current_user->user_email;
$business = TheFold\AboutUs\get_biz_from_user($current_user->ID)->post_title;
$address = implode(', ',TheFold\AboutUs\get_biz_address( $id ));
$phone = get_post_field( 'phone', $id, '');


$postID = $post->ID;
            $meta_values = array();
            $meta_values[] = get_post_meta($postID, 'video', true ); //video url
            $meta_values[] = get_post_meta($postID, 'description', true ); 
            $meta_values[] = get_post_meta($postID, 'link', true );  //video button text
            $meta_values[] = get_post_meta($postID, 'button', true ); //button text
            $meta_values[] = get_post_meta($postID, 'image', true );
            $meta_values[] = get_post_meta($postID, 'button_link', true ); //button link
            $meta_values[] = get_post_meta($postID, 'form', true ); //button link
            
            $oembed_endpoint = 'http://vimeo.com/api/oembed';



         //   $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            if(isset($meta_values[0])){
            $video_url = $meta_values[0];
          }
       
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=500';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=500';



           $use_errors = libxml_use_internal_errors(true);


           if(isset($xml_url)) {
             $oembed = simplexml_load_string(curl_get($xml_url)); 
             libxml_clear_errors();
             libxml_use_internal_errors($use_errors);
          }



            $thumnanail = wp_get_attachment_thumb_url(get_post_thumbnail_id($postID));

?>
<?php get_header(); ?>

 <div class="video-request-container-offer" style="background: url('<?php echo $thumnanail; ?>') no-repeat;">
      <div class="left-section single-offers-section">
    
         <?php $do_not_duplicate = array();
         if ( have_posts() ) : while ( have_posts() ) : the_post(); 
         $do_not_duplicate[] = $post->ID; ?>
 

         <section class="">
           <div class="single-page-description">
           <?php   

           $minithumb = get_post_thumbnail_id($id);
           $dynamic_img_src = thumbnail_in_style();  
           $replace_this = preg_replace('/dev.aboutus.co.nz/', 'd1v3jyvmwzvll7.cloudfront.net', $dynamic_img_src, 1);
           $single_cdn_img = "http://d1v3jyvmwzvll7.cloudfront.net/"; ?>
          
          

           <div class="single-page-thumbnail offers-single-thumbnail" id="offer-info" style="">
       
           <div class="offers-contain two single-offers-contain">
      
           <div class="offers-message single-offers-message centre-more" id="offer-content">
             <h1 class="custom-font"><?php echo the_title(); ?></h1>
             <div id="video-press" style="background-image: url('<?php ?>')">
                <a class="marketplace-init" href="#javascript;"><button id="watch-video"> <?php  echo $meta_values[2];  ?></button>   </a> 
              </div>
              <div id="single-offers-vid">
              <?php
              if( isset($oembed->html) ){
               echo $oembed->html;
              } else{

              }
              ?>
              </div>
              <div id="text">
              <?php echo the_content(); ?>
              </div>
              <a href="<?php echo $meta_values[5]; ?>" target="_blank">
              <?php if(!empty($meta_values[3])){ ?>
              <button class="custom-font" id="offers-link">  <?php echo $meta_values[3]; ?>  </button>
              <?php } ?>
              </a>
           </div>
          </div>
        </div>
      </div>
  </section>
  <?php endwhile; endif; wp_reset_postdata(); ?>

    
 <?php   if(isset($meta_values[6]) && !empty($meta_values[6])) : ?>

  
     <div class="content video offers-cat">
     <?php echo do_shortcode("<?php $meta_values[6]"); ?> 
     </div>
  

  


 <?php   endif;  ?>
  





  </div>





  </div>




<?php get_footer(); ?>
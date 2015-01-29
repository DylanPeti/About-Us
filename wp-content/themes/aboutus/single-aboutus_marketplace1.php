<?php
  
global $post;

$posts_in = 1;
$posts_in_two = 4;
$sponsor = get_sponsor();
define("POST_IN_CATEGORY", 1);


$postID = $post->ID;
            $meta_values = array();
            $meta_values[] = get_post_meta($postID, 'video', true ); //video url
            $meta_values[] = get_post_meta($postID, 'description', true ); 
            $meta_values[] = get_post_meta($postID, 'link', true );  //video button text
            $meta_values[] = get_post_meta($postID, 'button', true ); //button text
            $meta_values[] = get_post_meta($postID, 'image', true );
            $meta_values[] = get_post_meta($postID, 'button_link', true ); //button link
            
            $oembed_endpoint = 'http://vimeo.com/api/oembed';

         //   $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            if(isset($meta_values[0])){
            $video_url = $meta_values[0];
          }
       
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=500';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=500';
            $oembed = simplexml_load_string(curl_get($xml_url));



?>

<?php get_header(); ?>
 
</div>

  <div class="container extend-background gray">
      <!--     <header class="bottom-half-header single"><h1><?php echo the_title(); ?> </h1></header> -->
      <div class="container" style="margin-top: 20px;">
      <div class="bottom-half center">
      <div class="left-section single-offers-section">
    
         <?php $do_not_duplicate = array();
         if ( have_posts() ) : while ( have_posts() ) : the_post(); 
         $do_not_duplicate[] = $post->ID; ?>
 

         <section class="single-page">
           <div class="single-page-description">
           <?php   

           $minithumb = get_post_thumbnail_id($id);
           $dynamic_img_src = thumbnail_in_style();  
           $replace_this = preg_replace('/dev.aboutus.co.nz/', 'd1v3jyvmwzvll7.cloudfront.net', $dynamic_img_src, 1);
           $single_cdn_img = "http://d1v3jyvmwzvll7.cloudfront.net/"; ?>
          
          

           <div class="single-page-thumbnail offers-single-thumbnail" id="image" style="">
       
           <div class="offers-contain two single-offers-contain">
      
           <div class="offers-message single-offers-message" id="offer-content">
             <h1 class="custom-font"><?php echo the_title(); ?></h1>
             <?php if(!isset($oembed->html)){ ?>
           <div class="single-page-thumbnail" id="image" style="background-image: url('<?php echo $replace_this; ?>')"></div>
           <?php } ?>
             <div id="video-press" style="background-image: url('<?php ?>')">
                <a class="marketplace-init" href="#javascript;"><button id="watch-video"> <?php  echo $meta_values[2];  ?></button>   </a> 
              </div>
              <p id="single-offers-vid">
              <?php
              if( isset($oembed->html) ){
               echo $oembed->html;
              } else{

              }
              ?>
              </p>
              <?php echo the_content(); ?>
              <a href="<?php echo $meta_values[5]; ?>" target="_blank">
              <?php if(!empty($meta_values[3])){ ?>
              <button id="offers-link">  <?php echo $meta_values[3]; ?>  </button>
              <?php } ?>
              </a>
           </div>
          </div>
        </div>
      </div>
  </section>
  <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
  </div>
   <?php get_sidebar(); ?>
</div>

     

       </div>
    </div>




    <?php include 'inc/advert.php'; ?>






<?php $trim_the_results  = array_slice(get_categories( postArgSingle('post', '', '', 'ASC', 1, 1, 'category', false, '', array(1368)) ), 0, 8); ?> 

<div class="center">

    <?php include 'inc/extraposts.php'; ?>

</div>

           <div class="center">
                   <?php get_footer(); ?>
                   </div>
  </div>       
 </div>
</div>

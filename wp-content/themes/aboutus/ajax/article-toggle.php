<?php

require_once($_SERVER['DOCUMENT_ROOT'] . 'core/wp-load.php');

$id = $_GET['identifier']; 
$return = get_post($id);


$postID = $return->ID;
            $meta_values = array();
            $meta_values[] = get_post_meta($postID, 'video', true ); //video url
            $meta_values[] = get_post_meta($postID, 'description', true ); 
            $meta_values[] = get_post_meta($postID, 'link', true );  //video button text
            $meta_values[] = get_post_meta($postID, 'button', true ); //button text
            $meta_values[] = get_post_meta($postID, 'image', true );
            $meta_values[] = get_post_meta($postID, 'button_link', true ); //button link
            
            $oembed_endpoint = 'http://vimeo.com/api/oembed';
            $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=500';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=500';
            $oembed = simplexml_load_string(curl_get($xml_url));

?>




    <section class="marketplace-articless appear two" data-id="<?php echo $post->ID; ?>">
              <div class="offers curosel two" id="bki-offer" style="background-image: url('<?php  echo $meta_values[4]; ?>')">
       <div class="offers-contain two">
      
         <div class="offers-message" id="offer-content">
           <h3><?php echo $return->post_title; ?></h3>
           <p> <?php echo $return->post_content; ?></p>    
           
           <?php if(!empty($meta_values[2])){ ?>

                 <button id="watch-vid-button"><?php  echo $meta_values[2]; ?> </button>

           <?php } ?>

       <div id="video-press" style="background-image: url('<?php ?>')">
                  <a class="marketplace-init" href="#javascript;"><button id="watch-video"> <?php  echo $meta_values[2];  ?></button>   </a> 
                 </div>
                 
           <a href="<?php echo $meta_values[5]; ?>" target="_blank">
           <?php if(!empty($meta_values[3])){ ?>
           <button>  <?php echo $meta_values[3]; ?>  </button>
           <?php } ?>
            </a>


         </div>
     
     <!--    <div class="video-box">
          <?php echo html_entity_decode($oembed->html) ?>
        </div> -->
       </div>
     </div>
     <p id="offer-vid" class="offer-vid"><?php echo $oembed->html; ?></p>
    <i class="fa fa-close"></i>
  </section>


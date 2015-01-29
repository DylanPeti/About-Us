<div id="the-offer" class="">
<div class="temp-ajax-container">
<div id="loading"></div>
</div>
 <?php




            $do_not_duplicate = array();
            $small_post_one = new WP_Query(mini_post('marketplace', $do_not_duplicate, 1));
 while ($small_post_one->have_posts()) : $small_post_one->the_post(); 

           
            if(isset($chosenOffer)){

            $do_not_duplicate[] = $chosenOffer;
            $theOffer = $chosenOffer;

            } else {

            $do_not_duplicate[] = $post->ID; 
            $theOffer = $post->ID;

            }
 
            $meta_values = array();
            $meta_values[] = get_post_meta($theOffer, 'video', true );
            $meta_values[] = get_post_meta($theOffer, 'description', true );
            $meta_values[] = get_post_meta($theOffer, 'link', true );
            $meta_values[] = get_post_meta($theOffer, 'button', true );
            $meta_values[] = get_post_meta($theOffer, 'image', true );
            
            $oembed_endpoint = 'http://vimeo.com/api/oembed';
            $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=640';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=640';
            $oembed = simplexml_load_string(curl_get($xml_url));


       ?>  

     <div class="offers curosel" id="bki-offer" style="background-image: url('<?php  echo $meta_values[4]; ?>')">
       <div class="offers-contain">
         <i class="fa fa-arrow-left offer-left-arrow offer-arrow" id="arrowleft" data-id="<?php echo $theOffer ?>" data-dir="prev"></i>
         <i class="fa fa-arrow-right offer-right-arrow offer-arrow" id="arrowright" data-id="<?php echo $theOffer ?>" data-dir="next"></i>
         <div class="offers-message" id="offer-content">
           <h3><?php the_title(); ?></h3>
           <p><?php 
           if(strstr($meta_values[1], "\n")) {
            echo nl2br($meta_values[1], true);
           } ?>
           </p>
           
          <?php if (isset($oembed->thumbnail_url)){ ?>
          <div id="video-press" style="background-image: url('<?php echo $oembed->thumbnail_url; ?>')">
            <a class="marketplace-init" href="#javascript;"><button id="watch-video"> <?php  echo $meta_values[2];  ?></button>   </a> 
          </div>
          <?php } ?>
           <button>  <?php echo $meta_values[3]; ?>  </button> 
         </div>
     
        <div class="video-box">
          <?php echo html_entity_decode($oembed->html) ?>
        </div>
       </div>
     </div>

    <?php 
  endwhile; ?> 

</div>

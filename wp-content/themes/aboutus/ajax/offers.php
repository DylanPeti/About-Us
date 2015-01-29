<?php 

include $_SERVER['DOCUMENT_ROOT'] . 'core/wp-blog-header.php';

global $post;



$identifier = $_GET['identifier'];

$args = array( 'post_type' => 'aboutus_marketplace');
$loop = new WP_Query( $args );
$currentPost = get_post( $identifier, ARRAY_A, ''); 
$current = $currentPost['ID'];

 $yes = wp_get_attachment_url( get_post_thumbnail_id($current['ID']) );


   $meta_values = array();

            $meta_values[] = get_post_meta($current, 'video', true );
            $meta_values[] = get_post_meta($current, 'description', true );
            $meta_values[] = get_post_meta($current, 'link', true );
            $meta_values[] = get_post_meta($current, 'button', true );
            $meta_values[] = get_post_meta($current, 'image', true );
            $oembed_endpoint = 'http://vimeo.com/api/oembed';
            $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=640';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=640';
            $oembed = simplexml_load_string(curl_get($xml_url));


?>
<div class="temp-ajax-container">
<div id="loading"></div>
</div>
<div class="offers curosel" id="bki-offer" style="background-image: url('<?php  echo $meta_values[4]; ?>')">
  <div class="offers-contain">
  <i class="fa fa-arrow-left offer-left-arrow offer-arrow" id="arrowleft" data-id="<?php echo $current ?>" data-dir="prev"></i>
    <i class="fa fa-arrow-right offer-right-arrow offer-arrow" id="arrowright" data-id="<?php echo $current ?>" data-dir="next"></i>
<!--     <i class="fa fa-arrow-left offer-left-arrow offer-arrow" onClick="direction(<?php echo $current ?>,'prev')"></i>
    <i class="fa fa-arrow-right offer-right-arrow offer-arrow" onClick="direction(<?php echo $current ?>,'next')"></i> -->
    <div class="offers-message" id="offer-content">
      <h3><?php echo get_the_title($current); ?></h3>
      <p><?php echo $meta_values[1]; ?></p>
      <a class="marketplace-init" href="#javascript;"><?php  echo $meta_values[2];  ?> </a> 
      <button>  <?php echo $meta_values[3]; ?>  </button> 
  </div>
   <div class="video-box">
     <?php echo html_entity_decode($oembed->html) ?>
   </div>
</div>
</div> 


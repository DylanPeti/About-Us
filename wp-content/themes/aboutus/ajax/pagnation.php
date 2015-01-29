<?php 

include $_SERVER['DOCUMENT_ROOT'] . 'core/wp-blog-header.php';

global $post;



 


$itema = $_GET['identifier'];
$direction = $_GET['dir'];
$args = array( 'post_type' => 'aboutus_marketplace');
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();
$result = get_post( $itema, ARRAY_A, '');	
$list = array();	
	foreach($loop->posts as $item){
  
    $list[] = $item->ID;

	}

  endwhile;



$position = array_search($result['ID'], $list);


if ($direction == 'prev') {
 
 switch($position){
  case 0: 

$current = $list[5];
  break;

  case 1: 

$current = $list[0];

  break;

  case 2: 

$current = $list[1];
  break;

  case 3: 

$current = $list[2];
  break;

   case 4: 

$current = $list[3];
  break;

   case 5: 

$current = $list[4];

  break;
 }

}

if ($direction == 'next') {
 
switch($position){
  case 0: 
$current = $list[1];
  break;

  case 1: 


$current = $list[2];

  break;

  case 2: 

$current = $list[3];
  break;

  case 3: 

$current = $list[4];
  break;

   case 4: 

$current = $list[5];
  break;

   case 5: 

$current = $list[0];

  break;
 }

}

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

<div class="offers curosel" id="bki-offer" style="background-image: url('<?php  echo $meta_values[4]; ?>')">
  <div class="offers-contain">
  <i class="fa fa-arrow-left offer-left-arrow offer-arrow" id="arrowleft" data-id="<?php echo $current ?>" data-dir="prev"></i>
    <i class="fa fa-arrow-right offer-right-arrow offer-arrow" id="arrowright" data-id="<?php echo $current ?>" data-dir="next"></i>
<!--     <i class="fa fa-arrow-left offer-left-arrow offer-arrow" onClick="direction(<?php echo $current ?>,'prev')"></i>
    <i class="fa fa-arrow-right offer-right-arrow offer-arrow" onClick="direction(<?php echo $current ?>,'next')"></i> -->
    <div class="offers-message" id="offer-content">
      <h3><?php echo get_the_title($current); ?></h3>
     
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

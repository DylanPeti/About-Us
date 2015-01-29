<?php
global $post;
define('POSTS_IN', 8);
define('POST_IN', 8);

 
get_header(); 


$chosenOffer = $_GET['id'];
if(isset($chosenOffer)){

}

?>
</div>


<?php include "inc/welcome.php" ?>
<?php include 'inc/onboard-intro.php'; ?>

</div>
</div>


<div class="container">
      <div class="offers-banner">
             <div class="category-top-banner-container">
                 <article>
                     <h1>More Essential Tools for your Business </h1>
                 </article>
             </div>
      </div> 

         
  <div class="bottom-half">
    <div class="marketplace-left-section">

      <div class="left-section">             
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
            $video_url = ($_GET['url']) ? $_GET['url'] : $meta_values[0];
            $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=640';
            $xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=640';
            $oembed = simplexml_load_string(curl_get($xml_url));

            ?>
      
          <section class="marketplace-articles" data-id="<?php echo $post->ID; ?>">
            <div class="length-container">
              <div class="marketplace-left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>

              <div class="marketplace-left-section-description description show" data-id="<?php echo $post->ID; ?>">
               <h4 ><?php the_title(); ?></h4>
                 <p><?php 
                     $length = 70;
                     $wrapper_length = 70;
                     $string = nl2br($meta_values[1], true);

                     if(strstr($meta_values[1], "\n") && strlen($string) > $length) {
               
                     $wrap = wordwrap($string, $wrapper_length) ;
                     $i = strpos($wrap, "\n");
                     $description = substr($wrap, 0, $i);
                     echo $description . "...";

                     } ?>
                 </p>

                 <h4 class="diff"><?php the_title(); ?></h4>


                 <?php if(isset($meta_values[3])){ ?>
                  <p class="diff arrange"><?php echo $string; ?>
                   <button class="diff"> <?php  echo $meta_values[3];  ?></button>
                  </p>
                <?php } ?>

                 <?php if(isset($meta_values[2])){ ?>
                 <button class="diff"><?php  echo $meta_values[2]; ?> </button>
                 <?php } ?>


        
                 <div id="video-press" class="diff vid-arrange" style="background-image: url('<?php echo $oembed->thumbnail_url; ?>')">
                  <a class="marketplace-init" href="#javascript;"><button id="watch-video"> <?php  echo $meta_values[2];  ?></button>   </a> 
                 </div>

                 <p id="read-more">View this offer</p>
                 <p id="read-more" class="diff">close x</p>
               </div>
           </div>  

          </section>

<div class="m-appear"></div>
<?php// include 'inc/article-toggle.php'; ?>

        <?php endwhile; ?>
      </div>

<div class="market-right">
<?php  get_sidebar();  ?>
         </div>

    

</div>

          <aside class="add-spot">    
                      <div ID="DivBigBanner">
                      <script language="javascript" type="text/javascript">
                      aimRenderAd(760, 120, '760x120','BigBanner','');
                      if(!jQuery.browser.msie){
                      BigBanner_frame = jQuery("#BigBanner")[0];
                      BigBanner_frame.src = BigBanner_frame.src;
                      }</script></div>
                      </aside>
        <?php include 'footer.php'; ?>
             
      

        





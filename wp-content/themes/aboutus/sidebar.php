<aside class="sidebar">
<!--     <div class="sidebar-widget message">
        <div class="content">
            <h3 class="custom-font">What's your <br /> story?</h3>
            <p class="custom-font"> 
               Succeeding online and want to share? We want to hear from you!
               drop us a line at <a href="mailto:news@aboutus.co.nz?Subject=About%20Us%20Member!" class="custom-font">news@aboutus.co.nz</a>
               <br />
            </p>
        </div>
    </div> -->

    <?php if(postType("aboutus_marketplace", $post->ID)) { ?>

            <!--       <div id="add-here">
                      <div class="ads">
                          <div ID="DivHeadlineRect">
                              <script language="javascript" type="text/javascript">
                              aimRenderAd('300','250', '300x250','HeadlineRect','/SR=0/POS=POS1');
                              if(!jQuery.browser.msie){
              
                              HeadlineRect_frame = jQuery("#HeadlineRect")[0];
                              HeadlineRect_frame.src = HeadlineRect_frame.src;
                              }</script>
                          </div> 
                        </div>
                     </div> -->
    <?php } ?> 

      <?php
      $args = array(
  'posts_per_page'   => 3,
  'offset'           => 0,
  'category'         => '',
  'category_name'    => '',
  'orderby'          => 'post_date',
  'order'            => 'DESC',
  'include'          => '',
  'exclude'          => '',
  'meta_key'         => '',
  'meta_value'       => '',
  'post_type'        => 'aboutus_adverts',
  'post_mime_type'   => '',
  'post_parent'      => '',
  'post_status'      => 'publish',
  'suppress_filters' => true );


//get marketplace offers. if marketplace video radio button checked, display the content.. or else do not 


?>  <div class="offer-rotator">
       <div class="contain-offers">
       <ul>
       <?php
   $posts_array = get_posts( $args ); 
  foreach ($posts_array as $item) {
    $postID = $item->ID;
     $thumbID = get_post_thumbnail_id($postID);
     $dog = wp_get_attachment_image_src($thumbID, 'large');
     $thumbLink = wp_get_attachment_thumb_url($thumbID);

$link = get_post_meta($postID, 'link_to_offer', true );
?> 

<li>
<!-- <a href="<?php echo $base ?>/tell-your-story-with-video?post=<?php echo $postID ?>/"> -->
 <a href="<?php echo $link; ?>" target="_blank"> 
      <div id="offer-advert" style="background: url('<?php echo $dog[0]; ?>') no-repeat center;">
      <?php // echo $thumbnail; ?>
      <?php $info = "header"; ?>

          <div id="description">
<!--               <h1 class="custom-font">Tell your story with an <img width="110px" height="" src="/wp-content/uploads/2014/07/logos-complete.png" style="margin-right: -12px;"> video.</h1>
 -->               <h1 class="custom-font"><?php echo $item->post_title; ?></h1>
              <!-- <p class="hider custom-font">We can bring your story to life quickly, easily and for less money than you'd think.</p> -->
              <p class="hider custom-font"><?php echo wp_trim_words($item->post_content, 15); ?></p>
              <h2 id="learn-more-offer" class="custom-font hider">
                 <?php $base = "http://$_SERVER[HTTP_HOST]"; ?>

                  <a href="<?php echo $link; ?>" target="_blank">  Learn More ››</a>
              </h2>
          </div>
      </div> 
</a>
      </li>

      <?php   } ?>
      </ul>
            </div>
</div>


   


    <div class="sidebar-widget create">
        <div class="content">
            <h3 class="custom-font">News and updates <br /> delivered right <br /> to your inbox</h3>
            <p class="custom-font">Your email address</p>
            <form id="subForm" action="http://socializegroup.createsend.com/t/d/s/jiluiy/" method="post">
              <!--   <input type="text" name="name" id="name" placeholder="Your Email"><br> -->
              <input class="custom-font" id="fieldEmail" name="cm-jiluiy-jiluiy" type="email" required />
              <br />
              <button type="submit" class="custom-font">Join our mailing list ›</button>
              <p class="custom-font response"></p>
            </form>
        </div>
    </div>
                
    <?php 
    $cloudSoftware = get_category_by_slug('cloud-software');
    $cloudCategoryID = $cloudSoftware->cat_ID;
    $socialID = get_category_by_slug('social-media-2')->cat_ID;
    $whatIsID = get_category_by_slug('what-is')->cat_ID;
    $yourWebsiteID = get_category_by_slug('your-website')->cat_ID;
    $all_verticles = get_category_by_slug('industries')->cat_ID;
    $ignore_cats = array('Advertising/Creative', 'Construction', 'Farming & Horticulture', 'Financial', 'Freelancers', 'Hospitality', 'marketplace', 'Retail', 'Tourism', 'Trades', ); ?>
    
    <?php if(postType("aboutus_marketplace", $post->ID)) {  ?>
       
        <div class="sidebar-widget list category-selection">
            <h4 class="custom-font">Article Categories</h4>       
            <ul>
                <h4 class="custom-font">Stumped? Start here</h4>
                <?php // wp_list_categories(apply_filters('widget_categories_args', $stumped)); ?> 
                <li><a href="<?php echo baseUrl('the_guide/'); ?>">The Guide</a></li>
                <li><a href="<?php echo baseUrl('category/what-is/'); ?>">What is...?</a></li>
                <li><a href="<?php echo baseUrl('category/faqs/'); ?>">FAQs</a></li>
                <h4 class="custom-font">Boost your Business with</h4>
                <?php wp_list_categories(apply_filters('widget_categories_args', postArgSingle('post', $socialID, 'name', 'ASC', 1, 1, $whatIsID, 'category', false) ) ); ?>
                <?php wp_list_categories( apply_filters('widget_categories_args', postArgSingle('post', $yourWebsiteID, 'name', 'ASC', 1, 1, 'category', false) ) ); ?> 
       
                <br />

                <h4 class="custom-font">Know your cloud apps</h4>
                <?php wp_list_categories( apply_filters('widget_categories_args', postArgSingle('post', $cloudCategoryID, 'name', 'ASC', 1, 1, 'category', false, '', '' ) ) ); ?> 

                <br />

                <h4 class="custom-font">What business are you in?</h4>
                <?php wp_list_categories(apply_filters('widget_categories_args',  postArgSingle('post', $all_verticles, 'name', 'ASC', 1, 1, 'category', false, '', $ignore_cats ) ) ); ?> 
            </ul>
        </div>
    <?php } ?>
</aside>









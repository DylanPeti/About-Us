<div class="center news-section">  
   <h3 class="custom-font">News Feed</h3>
      <div id="article-options">
          <button id="posts-filter" class="pad-l-r-10 custom-button gray option-one" data-id="<?php echo get_the_ID(); ?>">Recommended for you</button>
          <button id="posts-filter" class="pad-l-r-10 custom-button gray option-two charcoal-background" data-id="all-news">All News</button>
          <button id="posts-filter" class="pad-l-r-10 custom-button gray option-three" data-id="offers">Tools you need</button>
      </div>
   <div id="tab-pointer">
     <ul>
       <li id="pointer-one"><div class=""></div></li>
        <li id="pointer-two"><div class="pointer"></div></li>
         <li id="pointer-three"><div class=""></div></li>
     </ul>
   </div>
</div>
  
<div class="extend-background fade-white">



  <?php $ismobile = check_user_agent('mobile'); ?>
  <?php if(!$ismobile) : ?>
  
           <div class="container article-suggestions">
  
           <?php else : ?>
  
           <div class="container" style="width:100%;">
     
  <?php endif; ?>


           <div class="bottom-half">
              <div id="filter-container" class="one left-section masonry">

               <?php if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT'])) :
                     echo articles( wp_get_recent_posts(postArgs(5, 0, 0, 'post_date', 'DESC', '', '', 'post', 'publish', 'true'), ARRAY_A ) );
                     else :
                     echo articles( wp_get_recent_posts(postArgs(9, 0, 0, 'post_date', 'DESC', '', '', 'post', 'publish', 'true'), ARRAY_A ) );
                     endif;
                ?>
              </div>

       <?php require_once('advert.php'); ?>

           </div>

              <?php $ismobile = check_user_agent('mobile'); 
              echo ( !$ismobile ? get_sidebar() : false );                             
              echo ( !$ismobile ? require('extraposts.php') : false ); ?>

       </div>
</div>

    

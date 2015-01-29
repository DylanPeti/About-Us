 <div class="search-business">
   <div id="search-business-title"><h2>Search About Us in your Town!</h2></div>
    <div id="search-business-tags">

      <?php
       $search_q = new WP_Query( array( 'post_type' => 'aboutus_citie') );
      $search_q = get_posts(array('post_type' => 'aboutus_citie'));

  foreach ($search_q as $qs) { ?>
       <button class="btn2"><a href="/citue/Auckland?selected=Dunedin"><?php echo $qs->post_title; ?></a></button>

<?php } ?>
    

    </div>
 </div>
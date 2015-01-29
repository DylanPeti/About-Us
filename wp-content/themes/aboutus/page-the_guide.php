<?php
  
global $post;

$posts_in = 1;
$posts_in_two = 4;
$sponsor = get_sponsor();
define("POST_IN_CATEGORY", 1);

?>

<!DOCTYPE html>


<html>
<head><title></title>
</head>
<body>
<?php get_header(); ?>

     

       
         <div class="container">
         <div class="category-top-banner">
             <div class="category-top-banner-container">
                 <article>
                     <h1><?php the_title();
                           ?></h1>
                
                     
                 </article>
             </div>
    
         </div>








                      <div class="bottom-half">

                      <div class="left-section">


                     <?php

           
      while ( have_posts() ) : the_post(); ?>
                       <a href="<?php the_permalink(); ?>">


                      <section class="single-page">

             <div class="single-page-description" style="padding:10px;">
                    


                      <p id="single-page-content"> <?php nl2br(the_content()); ?> </p>
      

              
                      </div>
                      </section>
                      </a>
                      <?php endwhile; wp_reset_postdata(); ?>

                      <aside class="add-spot">    
                      <div ID="DivBigBanner">
                      <script language="javascript" type="text/javascript">
                      aimRenderAd(760, 120, '760x120','BigBanner','');
                      if(!jQuery.browser.msie){
                      BigBanner_frame = jQuery("#BigBanner")[0];
                      BigBanner_frame.src = BigBanner_frame.src;
                      }</script></div>
                      </aside>



                               
         </div>
       <?php get_sidebar(); 
            get_footer();
       ?>
             </div>
           </div>       
        </div>
</div>
</div>

<script type="text/javascript">
  $('.single-page p img').attr('id', 'image');
</script>


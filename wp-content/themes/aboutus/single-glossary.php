<?php
  
global $post;

$posts_in = 1;
$posts_in_two = 4;
$sponsor = get_sponsor();
define(POST_IN_CATEGORY, 1);

?>

<!DOCTYPE html>


<html>
<head><title></title>
</head>
<body>
<?php require 'header-newsroom.php'; ?>

     

         <!--dynamically add this-->
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

             <div class="single-page-description">
                      <div class="single-page-thumbnail" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>

                      <p id="single-page-content"> <?php nl2br(the_content()); ?> </p>
      

              
                      </div>
                      </section>
                      </a>
                      <?php endwhile; wp_reset_postdata(); ?>

                      <header class="bottom-half-header-two"><h2>More articles ></h2></header>
                      <aside class="add-spot">    
                      <div ID="DivBigBanner">
                      <script language="javascript" type="text/javascript">
                      aimRenderAd(760, 120, '760x120','BigBanner','');
                      if(!jQuery.browser.msie){
                      BigBanner_frame = jQuery("#BigBanner")[0];
                      BigBanner_frame.src = BigBanner_frame.src;
                      }</script></div>
                      </aside>


<section class="bottom-mini-articles">
                <ul id="bma-list">
                    <li id="category-bottom-mini">
                  

                  <?php foreach (get_categories() as $cat) {
                      if ($cat->name == 'Marketplace') continue; 
                      if ($cat->parent > 0) { continue; }?>
                      <ul id="category-mini-list" class="category-mini-article-list">   
                      <?php   $sixth_small_post = new WP_Query(mini_post($cat->name, $do_not_duplicate, POST_IN_CATEGORY));
                      
                      while ($sixth_small_post->have_posts()) : $sixth_small_post->the_post(); ?>
                      <?php $do_not_duplicate[] = $post->ID; ?>
                      <?php $counting_posts = $sixth_small_post->current_post +1; 
                      if($counting_posts == 1){ 

                      $names = get_cat_ID($cat->name); ?>
                       <a href="<?php echo get_category_link($names); ?>" id="linker">  
                     <!--  <h1 id="mini-heading"><?php $mini_title = get_the_category($post->ID); echo $mini_title[0]->cat_name; ?> </h1> -->
                      <h1 id="mini-heading"><?php $mini_title = $cat->name; echo $mini_title; ?> </h1>
                      <?php } ?>
                      <li id="bot-mini-passage">
                      <div class="bot-mini-image" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
                      <div class="bot-mini-paragraph">
                      <h5><?php the_title(); ?></h5>
                      <p><?php echo trim_the_content(); ?></p>
                      </div>
                      </li>
                      </a>
                      <?php endwhile; ?>  </ul> <?php } ?>
                      <h1 id="mini-more">More Social><h1>
                      </ul> 
                      </li>
           </ul>
</section>

                               
         </div>
       <?php require 'newsroom-sidebar.php'; 
             require 'footer-newsroom.php';
       ?>
             </div>
           </div>       
        </div>
</div>

<script type="text/javascript">
  $('.single-page p img').attr('id', 'image');
</script>
</body>
</html>

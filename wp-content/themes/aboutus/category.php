<?php
global $post;
$posts_in = 9;
$posts_in_two = 4;

$sponsor = get_sponsor();
define('POST_IN_CATEGORY', 1);
$current_cat = get_category( get_query_var( 'cat' ) );
$cat_id = $current_cat->slug;

?>


  

<?php get_header(); ?>

</div>
<?php if ( is_user_logged_in() ) { ?>
<?php // include 'promotions.php';
  } else { ?>
<div class="extend-background white">

<?php include 'inc/welcome.php'; ?>

 <?php }  ?>
 </div>
 </div>


<div class="extend-backgorund white">
<div class="container white center category-container">
<header class="bottom-half-header cat"><h1 class="custom-font">Latest <?php echo $cat_id; ?> Articles</h1></header>
   <div class="bottom-half">

        <div class="one left-section masonry" id="filter-container">
        <?php
        $fill = array();
        $small_post_one = new WP_Query(mini_post($cat_id, '', $posts_in));
        while ($small_post_one->have_posts()) : $small_post_one->the_post(); 
        $do_not_duplicate[] = $post->ID; 
         $fill[] = $post;
        ?>        

       
       <section class="bottom-section-one">
          <a href="<?php the_permalink($post->ID); ?>" target="_blank"> 
          <div class="left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
          </a>



          <span id="tag"><?php echo $cat_id; ?></span>
          <div class="left-section-description">
          <h3><?php the_title(); ?></h3>
          <p id="large-content"><?php echo trim_the_content(50); ?></p>
          <p id="small-content"><?php echo trim_the_content(10); ?></p>
          </div>
          <a href="<?php the_permalink($post->ID); ?>" target="_blank"> 
           <span id="read-more">Read More ›</span>
          </a>
          </section>

        <?php endwhile; wp_reset_postdata(); ?>

        

                               
         </div>
         </div>
          <?php get_sidebar();  ?>
          

          <div class="left-section bottom-content" style="width: 754px;">
             <?php if( count($fill) >= 5 ) { ?>

          <div class="adder" style="width:100%; height:auto; "></div>
       <!--    <header class="bottom-half-header-two">
           <div class="load"></div>
           </header> -->

               <aside class="add-spot">    
            <div ID="DivBigBanner">
            <script language="javascript" type="text/javascript">
            aimRenderAd(760, 120, '760x120','BigBanner','');
            if(!jQuery.browser.msie){
            BigBanner_frame = jQuery("#BigBanner")[0];
            BigBanner_frame.src = BigBanner_frame.src;
            }</script></div>
            </aside>
         <?php } ?>
        




          </div>
      </div>
       </div>
    </div>
    </div>
    </div>

    

<div class="center">            
<?php require('inc/extraposts.php') ?>
</div>



        <div class="center">
                   <?php get_footer(); ?>
                   </div>
   
         
       </div>       
    </div>
</div>
<div class="promotions">
<div class="center">

 <?php
        $fill = array();
        $small_post_ones = new WP_Query(mini_post('marketplace','', 4));
        while ($small_post_ones->have_posts()) : $small_post_ones->the_post(); 
        $do_not_duplicate[] = $post->ID; 
         $fill[] = $post;
        

        ?>   
          <section class="promotion-block">
        <div class="promotion-thumnail" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')">

         <p id="tager"></p>
                 <h4><?php echo the_title(); ?></h4>
         
        </div>
        </section>
  
        <?php endwhile; wp_reset_postdata(); ?>


  
</div>
  
</div>
<section class="extra-posts center">   

    <?php foreach ($trim_the_results as $item) { ?>
      <div class="column single">
        <ul>  


               <?php $post_item = new WP_Query( mini_post($item->name, $do_not_duplicate, 3));
               if( $post_item->have_posts() ) : while ($post_item->have_posts()) : $post_item->the_post(); ?>
               <?php $do_not_duplicate[] = $post->ID; ?>
               <?php $post_count = $post_item->current_post +1; 
               if($post_count == 1){ ?>
       
               <h3 id="mini-heading"> <?php $length = 3; $wrapper_length = 3; $mini_heading = trim_mini_title_length($length, $wrapper_length, $item->name); echo $item->name;   ?> </h3> 
               <?php } ?>
                 <li id="post-item">
                 <a href="<?php the_permalink($post->ID); ?>">  
                 <div class="extra-post-image" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
                 <div class="extra-post-content">
                 <h5><?php the_title(); ?></h5>
                 <h6><?php echo trim_the_content(); ?></h6>
                 </div>
                 </a>
                 </li>
              <?php  endwhile; endif; ?>
        </ul> 
      </div>
    <?php } ?>
                                               
 </section> 
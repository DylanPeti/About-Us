<?php
                    $do_not_duplicate = array();
                     $small_post_one = new WP_Query(mini_post('marketplace', $do_not_duplicate, 8));
                     while ($small_post_one->have_posts()) : $small_post_one->the_post(); 
                     $do_not_duplicate[] = $post->ID; 

                      $meta_values = array();
            $meta_values[] = get_post_meta($post->ID, 'video', true );
            $meta_values[] = get_post_meta($post->ID, 'description', true );
            $meta_values[] = get_post_meta($post->ID, 'link', true );
            $meta_values[] = get_post_meta($post->ID, 'button', true );
            $meta_values[] = get_post_meta($post->ID, 'image', true );
?>        

<aside class="marketplace-articles two" onClick="offerSelect(<?php echo $post->ID; ?>)">
     <!-- <a href="<?php echo get_permalink(get_the_ID()) ?>" id="linker">   -->


             <div class="marketplace-sidebar-image" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
             <div class="marketplace-sidebar-description two">

                 <h4 class="cont"><?php the_title(); ?></h4>
                 <p id="large-content cont"  class="cont"><?php 
                 $length = 80;
                 $wrapper_length = 80;
                 echo excerpt_string_length($length, $wrapper_length);   ?>
                 </p>
                 <button> <?php echo $meta_values[3]; ?></button>
          <!--        <h6 id="small-content cont"  class="cont"><?php 
                 $length = 70;
                 $wrapper_length = 70;
                 echo excerpt_string_length($length, $wrapper_length);   ?>
                 </h6> -->
              <!--    <p id="read-more" class="cont">View this offer ›</p> -->
             </div>

<!--  </a>     -->      
</aside>

                   <?php endwhile; ?>
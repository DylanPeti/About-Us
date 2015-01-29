<?php 
define('WP_USE_THEMES', false);
require_once('../../../core/wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;


query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page
));
?>

<!--  ==========================================================================
      HEADER POST BEGINS TWO
      ========================================================================== -->

<ul id="newslettercontainerlist">
        
        <?php
        $custom = get_posts($args);
        foreach($custom as $post) : setup_postdata($post);
        $do_not_duplicate[] = $post->ID;      
        ?>
 
        <li class="top-header-post-list">   
        <a href="<?php echo get_permalink(get_the_ID()) ?>">  
        <article class="newsroom-header-top">
        <?php the_post_thumbnail('homepage-thumb-top'); ?>
        <h1><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title();  ?></a></h1>
        <div class="content-text">
        <?php $field = get_post_field('post_content', $post_id); ?>
        <?php $trimmed = wp_trim_words($field, 60); 
        echo $trimmed; ?>
        </div>
        <a class="readmore"><span class="read-this">Read More</span> </a>
        <a class="readmore-two"><span class="read-this">Read More</span></a>
        </article>  

        </a>
        </li>
        <?php  //break;
        wp_reset_postdata(); ?>
        <?php endforeach;   ?>
</ul>


<!-- ==========================================================================
      SECOND POST LAYOUT
      ========================================================================== -->

<ul class="last-section">

             <?php  
             $custom_posts_four = get_posts($argsfour);  
             foreach($custom_posts_four as $post) : setup_postdata($post); 
             if (in_array($post->ID, $do_not_duplicate)) continue;
             $ids[] = $post->ID;
        

             ?>

             <li class="second-post-layout-section">
             <a href="<?php echo get_permalink(get_the_ID()) ?>">     
             <article class="newsroom-header-second-section-dif">
             <?php the_post_thumbnail(); ?>
             <h1><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title(); ?></a></h1>
             <div class="content-text-two">
             <?php $field = get_post_field('post_content', $post_id); ?>
             <?php $trimmed = wp_trim_words($field, 16); 
             echo $trimmed;
             ?>
             </div>
             <a class="readmore"><span class="read-this">Read More</span> </a>
             <a class="readmore-two"><span class="read-this">Read More</span></a> 
             </article>
             </a>
             </li>
             <?php   endforeach;   ?>    
             </ul>  
             <?php   ?>


<?php wp_reset_query(); ?>

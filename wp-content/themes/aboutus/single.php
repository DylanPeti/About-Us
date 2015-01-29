<?php
  
global $post;

$posts_in = 1;
$posts_in_two = 4;
define("POST_IN_CATEGORY", 1);

?>

<?php get_header(); ?>
 
</div>

<?php echo (!is_user_logged_in()) ? include 'inc/welcome.php': false; ?> 

<?php if (is_user_logged_in()) : ?>  

<div class="contianer extend-background fade-white" style="padding-top: 20px;"> 

<?php elseif (is_user_logged_in()) : ?>

<div class="contianer extend-background gray" style="padding-top: 20px;"> 

<?php else : ?> <div class="contianer extend-background gray" style="padding-top: 20px;">

<?php endif; ?> 

    <div class="container">
      <div class="bottom-half center">
        <div class="left-section single">

        <?php

        $do_not_duplicate = array();
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $do_not_duplicate[] = $post->ID;
        ?>
         <h1 class="custom-font"><?php echo the_title(); ?></h1>

         <section class="single-page">

           <div class="single-page-description single padding">
           <span id="date-and-time">Posted: <?php  echo get_the_date() . "  " .  get_the_time() . " EDT"; ?></span>
           <span id="modified-date-and-time">Updated: <?php  echo the_modified_date() . "  " .  get_the_time() . " EDT"; ?></span>
           <span class="border"></span>
           <?php   

           $minithumb = get_post_thumbnail_id($id);
           $dynamic_img_src = thumbnail_in_style();  
           $replace_this = preg_replace('/dev.aboutus.co.nz/', 'd1v3jyvmwzvll7.cloudfront.net', $dynamic_img_src, 1);
           $single_cdn_img = "http://d1v3jyvmwzvll7.cloudfront.net/"; ?>
           <div class="single-page-thumbnail" id="image" style="background-image: url('<?php echo $replace_this; ?>')"></div>
           <?php the_content(); ?> 
           </div>
         </section>



          <?php //if(isset($_POST['submit'])) { print_r(store_user_post($current_user->ID, get_the_title())); }    
          endwhile; endif; wp_reset_postdata(); ?>

       </div>
   </div>
    <?php $ismobile = check_user_agent('mobile'); 
           echo ( !$ismobile ? get_sidebar() : false );                             
    ?>
   </div> 

<?php  echo "<div class='center'>" . ( !$ismobile ? require('inc/extraposts.php') : false ) . "</div>"; ?>
<?php echo "<div class='center'>" . get_footer() . "</div>"; ?>
                   


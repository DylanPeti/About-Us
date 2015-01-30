<?php
$posts_in = 5 ;
$posts_in_two = 4;
$sponsor = get_sponsor();
define('POST_IN_CATEGORYS', 4);
global $post;
 $f = get_category_by_slug('marketplace')->cat_ID;
           $section_one = array(
            'post_type'=> 'post',
            'cat' => $f,
            'order' => 'DESC',
            'post_status' => 'publish',
            'posts_per_page' => 2,
            'taxonomy' => 'category',
            );


?>
<?php
$category_query_args = array(
    'cat' =>  $f,
);

//print_r($category_query);
?>

<div class="right-section">
             <aside class="sidebar">
<div class="more-offers">
<div class="offers-title">
 <h1>More offers</h1>
 </div>
    <ul id="offers-list">
        <li id="offers-items">

            <?php $l = get_categories($section_one); ?>
                     <ul id="offers-collection">   
                        <?php   $sixth_small_post = new WP_Query(mini_post('marketplace', '', 4));
    
                        while ($sixth_small_post->have_posts()) : $sixth_small_post->the_post(); ?>
                        <?php $do_not_duplicate[] = $post->ID; ?>
                        <?php $counting_posts = $sixth_small_post->current_post +1; 
                        if($counting_posts == 1){ ?>
                       <!--  <h1 id="mini-heading"><?php $mini_title = get_the_category($post->ID); echo $mini_title[0]->cat_name; ?> </h1> -->

                        <?php } ?>
                        <li id="sidebar-content">
                        <div class="thumbnail-side" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
                        <div class="sidebar-more-content">
                        <h5><?php the_title(); ?></h5>
                        <p><?php $length = 45;
                       $wrapper_length = 45;
                        echo excerpt_string_length($length, $wrapper_length) . "...";   ?></p>
                        </div>
                        </li>
                        <?php endwhile; ?>  </ul> <?php  ?>
                       
                        </ul> 
                        </li>
                     </ul>
</div>
<!--   <div class="social"> -->
   <!--                <div id="create-passge">
                      <div class="social-icons">
                                            <div ID="DivHeadlineRect" style="margin-bottom:40px;">
<script language="javascript" type="text/javascript">
aimRenderAd(300, 250, '300x250','HeadlineRect','/SR=0/POS=POS1');
if(!jQuery.browser.msie){
HeadlineRect_frame = jQuery("#HeadlineRect")[0];
HeadlineRect_frame.src = HeadlineRect_frame.src;
}</script></div>


                      </div>
                  </div>
                     
                 </div> -->

               
                 <div class="create">
                 <h1>Get our newsletter</h1>
                 <div class="pencil"></div>
                  <div id="create-passge">

                       <h5>News and updates delivered right to your inbox - convenient!</h5>
                      <input type="text" name="name" id="name" placeholder="Your Email"><br>
                      <button>Sign Up ›</button>
                  </div>
                     
                 </div>
                  </div>


             

              
           

    <!--              </div> -->
                     
            

             </aside>
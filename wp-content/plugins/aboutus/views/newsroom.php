<?php
/**
 * The template for displaying Category pages.
 * try assigning aside format to the bottom of the post to get an alternative outcome, also clean up filezilla!
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


/*------------------------------
NEWSROOM GLOBALS & ARGS 
------------------------------*/

global $post;
global $newsroom_globals;
$newsroom_globals['newsroom_current_category'] = single_cat_title( '', false );


$category = get_the_category();
$archive_feed_category = $category['0']->cat_ID;
$format = has_post_format('image');
//$formattwo = get_post_format();
$twitter_feed_hashtags = '';
//$thumbnail_format = get_post_format('content-image.php');
$formatanother = has_post_format('image'); 
//$formatanothertwo = get_post_format(); 
// add_image_size( 'postimagewhat', '690', '340',false);
// set_post_thumbnail_size( 150, 150 );
$args = array(
    'post_type'=> 'post',
    'order' => 'DESC',
    'post_status' => 'publish',
    'posts_per_page' => 1,

    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('news')
        )
        
    )
);


$argstwo = array(
    'post_type'=> 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 2,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('news')
        )
    )
);
$argsthree = array(
    'post_type'=> 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 2,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('social media 101')
        )
    )
);

$argsfour = array(
    'post_type'=> 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 9,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('news')
        )
    )
);
$args_five = array(
    'post_type'=> 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 1,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('blogging')
        )
    )
);
$args_six = array(
    'post_type'=> 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'posts_per_page' => 1,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('about us')
        )
    )
);




get_header('newsroom'); ?>

  <div class="newsroom-container-one clearfix" style="">
  <div class="newsroom-container clearfix">
  <?php include ('../../../aboutus/newsroom-sidebar.php'); ?>
  </div>
  <?php  include('posts-in-category.php');  ?>



<!--SECOND AD PLACEMENT-->

<div class="add" style="width: 760px; height: 120px; float:left; padding-bottom: 10px; margin-left: 1%;">
<div ID="DivBigBanner">
<script language="javascript" type="text/javascript">
aimRenderAd(760, 120, '760x120','BigBanner','');
if(!jQuery.browser.msie){
BigBanner_frame = jQuery("#BigBanner")[0];
BigBanner_frame.src = BigBanner_frame.src;
}</script></div>
</div>
</div>

<!-- START Nielsen Online SiteCensus V6.0 -->
<!-- COPYRIGHT 2012 Nielsen Online -->
<script type="text/javascript" src="//secure-nz.imrworldwide.com/v60.js">
</script>
<script type="text/javascript">
var pvar = { cid: "nz-adhub", content: "0", server: "secure-nz" };
var trac = nol_t(pvar);
trac.record().post();
</script>
<noscript>
<div>
<img src="//secure-nz.imrworldwide.com/cgi-bin/m?ci=nz-adhub&amp;cg=0&amp;cc=1&amp;ts=noscript"
width="1" height="1" alt="" />
</div>
</noscript>
<!-- END Nielsen Online SiteCensus V6.0 -->


<script language="JavaScript" type="text/javascript" src="../../js/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(".top-arrow").click(function() {
$("html, body").animate({ scrollTop: 0 }, "slow");
return false;
});

</script>


<?php 
 include('mobile-java.php');


 
 get_footer('newsroom'); 
 include ('footer.php'); ?>
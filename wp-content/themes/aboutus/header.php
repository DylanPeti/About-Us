  <?php ob_start(); 
  date_default_timezone_set('NZ');
  $page_title = basename(get_permalink());
    $verticles = get_category_by_slug('industries')->cat_ID;
    $market_cat = get_category_by_slug('marketplace')->cat_ID;
    $ignore_cats = array("$verticles","$market_cat");
    $cat_args = array('orderby' => 'ASC');
    $cat_args['title_li'] = 'Categories';
    $cat_args['exclude_tree'] = 1;
    $cat_args['exclude'] = $ignore_cats;
    $cat_args['depth'] = 1;

  ?>
<?php 
global $current_user;
get_currentuserinfo();
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<title>About Us | <?php if(!empty($page_title) && !is_single() ) {  echo $page_title;  } elseif ( is_single() ) {  htmlspecialchars_decode( the_title() ); }  else { ?> Home <?php } ?> </title>

<!-- <meta name="viewport" content="width=320, initial-scale=1"> -->
<!-- <meta name="viewport" content="initial-scale=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:title" content="About Us: <?php the_title() ?>" />
<?php 

$addressfb = implode('</br>',TheFold\AboutUs\get_biz_address( get_the_ID() ));
$description = get_post_field('post_content', get_the_ID());


    // echo '<meta property="fb:admins" content="' . TheFold\AboutUs\get_biz_from_user($current_user->ID)->ID . '"/>';
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:url" content="' .  meta_current_url() . '"/>';
        echo '<meta property="og:site_name" content="About Us"/>';
?>
     <meta property="og:description" content="<?php echo strip_tags($description) ?>" />
     <?php
  if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    $thumbfbid = get_post_thumbnail_id($post->ID);
    $img = TheFold\AboutUs\get_biz_background_src( get_the_ID() );
    $thumblinkfb = wp_get_attachment_thumb_url($thumbfbid);

  //  $default_image="http://wp.aboutus.s3.amazonaws.com/assets/home/background.jpg"; //replace this with a default image on your server or an image in your media library

    echo '<meta property="og:image" content="' . $img . '"/>';
  }
  else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  }
  ?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="About Us is.." />
<meta name="google-site-verification" content="j70u4_rF9oO0GTeashdciAoSx_liVjbrtQGuc2S0iak" />

<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="/wp-content/themes/aboutus/css/custom.css">
<link rel="apple-touch-icon" href="/wp-content/themes/aboutus/images/icons/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/aboutus/images/icons/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/aboutus/images/icons/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/wp-content/themes/aboutus/images/icons/apple-touch-icon-144x144.png" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="shortcut icon" href="/favicon.ico">

<script type="text/javascript">

var siteTarget = "/SITE=ABOUTUS/AREA=HOME.ITEM";
var keyword = '';

</script>
  <?php wp_head(); ?>

</head>

<body>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({appId: 1537167169848949, status: false});
};
</script>


<?php 
$user = \wp_get_current_user();
$profile_url = get_permalink(TheFold\AboutUs\get_biz_from_user());
$actualLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page = "$_SERVER[REQUEST_URI]";




?>


<?php require 'inc/toolbar.php'; ?>

<?php require 'inc/toolbar-helper.php'; ?>

<div class="container">
   <div class="mobile-header" style="display:none;">
     <ul class="page-elements">
       <li><a href="/"><div id="logo"></div></a></li>
       <li><div id="strapline"><p>Use the internet better</p></div></li>
     </ul>
    </div>
</div>






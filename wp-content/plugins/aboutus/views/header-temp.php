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

<meta name="viewport" content="width=320, initial-scale=1">
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
  <?php// wp_head(); ?>

</head>

<body>
<?php 
$user = \wp_get_current_user();
$profile_url = get_permalink(TheFold\AboutUs\get_biz_from_user());
$actualLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page = "$_SERVER[REQUEST_URI]";




?>
   <div class="marketplace-hidden"></div> 
  
   <div class="toolbar">
    
      <?php if (current_user_can( 'manage_options' )): ?>
      <a class="btn" href="/wp-admin/">OPEN ADMIN</a>
      <a class="btn" href="<?php echo wp_logout_url('/'); ?>">Logout</a>
      <?php else: if ( is_user_logged_in() ):
      if(strpos($_SERVER['REQUEST_URI'], '/dash') !== false): ?>
      <?php else: ?>

      <?php endif ?>


    <div class="toolbar-menu">
       <ul id="toolbar-dates">
         <li> <p id="date"><?php echo date('F j, o'); ?> </p>      </li> 
         <li> <p id="time"><?php echo date('H:i a') . "NZT"; ?></p> </li> 
       </ul>
       
       <a href="/" style="margin:0;"> <div class="mobile-logo"></div> </a>
       <ul id="toolbar-list-two">

       <?php if($profile_url == $actualLink){ ?>    
        <li><a id="login-here" class="btn outline" href="aboutus.co.nz/wp-login.php" data-toggle="modal" data-target="#loginmodal">Logged in as <?php echo ($current_user->display_name)?$current_user->display_name:$current_user->user_login ?></a></li>
        <li><button id="your-dash"><a id="goto-dashboard" href="/dash">Your Dashboard</a></button></li>
        <?php   } else { ?>
        <li><a id="login-here" class="btn outline" href="aboutus.co.nz/wp-login.php" data-toggle="modal" data-target="#loginmodal">Logged in as <?php echo ($current_user->display_name)?$current_user->display_name:$current_user->user_login ?></a></li>
        <li><button id="your-dash"><a id="goto-dashboard" href="<?php echo $profile_url ?>">Your Page</a></button></li>
      <?php  } ?>


       </ul>
    </div>

      
    <div class="dropdown">
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
        <li><a href="/profile/">Edit Page</a></li>
        <li><a href="<?php echo get_permalink(TheFold\AboutUs\get_biz_from_user()) ?>">My Page</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo wp_logout_url('/'); ?>">Logout</a></li>
      </ul>
    </div>

<?php else: ?>

      <div class="toolbar-menu">
        <ul id="toolbar-dates">
          <li> <p id="date"><?php echo date('F j, o'); ?> </p></li> 
          <li> <p id="time"><?php echo date('H:i a') . " NZT"; ?></p> </li> 
        </ul>
        <a href="/" style="margin:0;"> <div class="mobile-logo"></div></a>
        <ul id="toolbar-list-two">
   <?php  if($page != "/signup") { ?>
          <li><button id="your-dash"><a id="goto-dashboard" href="/signup">Get started for free</a></button></li>
   <?php } ?>
          <li><a id="login-here" class="btn outline" href="javascript:;" data-toggle="modal" data-target="#loginmodal">
          <p>Already a member? Login</p></a></li>
        </ul>
      </div>


<?php endif; endif; ?>
  

</div>

<div class="h">
  <div class="c">
  <a href="/" id="logo-link"><div class="logos-link"></div></a>
     <div class="header-right">

     <?php //wp_nav_menu( array('menu' => 'header') ); ?>
       <li id="mobile-more"></li>     


    <div class="header-social-icons">
    <ul id="header-icons">
    <a href="https://www.facebook.com/theaboutuspage?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
     <a href="https://twitter.com/_aboutus" target="_blank"><i class="fa fa-twitter"></i></a>
     <a href="https://www.linkedin.com/groups/AboutUs-1109397" target="_blank"><i class="fa fa-linkedin"></i></a>
     <a href="https://www.youtube.com/channel/UCxOILdYtZMP4QZ3GDF4EHeA" target="_blank"><i class="fa fa-youtube"></i></a>
     <a href="http://www.instagram.com/aboutuspix" target="_blank"><i class="fa fa-instagram"></i></a>
     <a href="https://plus.google.com/+AboutusCoNz/videos" target="_blank"><i class="fa fa-google-plus"></i></a>
     <a href="http://www.pinterest.com/aboutuspix/" target="_blank"><i class="fa fa-pinterest"></i></a>

    </ul>
   </div>

   <div class="wordpress-search"> <?php  get_search_form(); ?> </div>

   <div class="mobile-dropdown">
      <ul> <?php wp_list_categories(apply_filters('widget_categories_args', $cat_args)); ?> </ul>
        <?php if (is_user_logged_in()){ ?> 
        <li>Profile</li>  
        <li>Dashboard</li> <?php } ?>
      </ul>
    </div>
    </div>






  </div>
</div>

<div class="container">
   

   <div class="mobile-header" style="display:none;">
     <ul class="page-elements">
       <li><a href="/"><div id="logo"></div></a></li>
       <li><div id="strapline"><p>Use the internet better</p></div></li>
     </ul>
    </div>








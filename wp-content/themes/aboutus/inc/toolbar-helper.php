<?php $baseurl  = "http://" . $_SERVER['SERVER_NAME'] . "/"; 
$actualLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div class="header">

  <div class="center">
  <a href="/" id="logo-link"></a>
  <?php if (is_user_logged_in()){ ?>
 <button id="mobile-your-page" class="computer-hide"><a id="goto-dashboard" href="<?php echo $profile_url ?>">Your Page</a></button>
 <?php } ?>
     <div class="header-right">

     <?php //wp_nav_menu( array('menu' => 'header') ); ?>


       <li id="mobile-more"></li>     

<?php // if ($baseurl != $actualLink) { ?>
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
    </div>
    </div>






  </div>
</div>
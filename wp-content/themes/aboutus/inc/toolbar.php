
<div class="toolbar">
    
      <?php if (current_user_can( 'manage_options' )): ?>
      <a class="btn" href="/wp-admin/">OPEN ADMIN</a>
      <a class="btn" href="<?php echo wp_logout_url('/'); ?>">Logout</a>
      <?php else: if ( is_user_logged_in() ):
      if(strpos($_SERVER['REQUEST_URI'], '/dash') !== false): ?>
      <?php else: ?>

      <?php endif ?>


    <div class="center">
       <ul id="toolbar-dates">
         <li> <p id="date"><?php echo date('F j, o'); ?> </p>      </li> 
         <li> <p id="time"><?php echo date('H:i a') . "NZT"; ?></p> </li> 
       </ul>
       
       <a href="/" style="margin:0;"> <div class="mobile-logo"></div> </a>
       <ul id="toolbar-list-two">

       <?php if($profile_url == $actualLink){ ?>    

        <li><a id="login-here" class="btn outline toolbar-login" href="aboutus.co.nz/wp-login.php" data-toggle="modal" data-target="#loginmodal">Logged in as <?php echo ($current_user->display_name)?$current_user->display_name:$current_user->user_login ?></a></li>
        <li><button id="your-dash"><a id="goto-dashboard" href="/dash" class="your-dashboard-text">Your Dashboard</a></button></li>
        <?php   } else { ?>
        <?php
           $splitName = explode(' ', $current_user->display_name);
           $splitName = array_slice($splitName, 0, 2);
           $fixedName = implode(' ', $splitName);
        ?>
        <li><a id="login-here" class="btn outline toolbar-login" href="aboutus.co.nz/wp-login.php" data-toggle="modal" data-target="#loginmodal">Logged in as <?php echo ($fixedName)?$fixedName:$current_user->user_login ?></a></li>
        <li><button id="your-dash"><a id="goto-dashboard" href="/dash" class="your-dashboard-text">Your Dashboard</a></button></li>
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





      <div class="center">
        <ul id="toolbar-dates">
          <li> <p id="date"><?php echo date('F j, o'); ?> </p></li> 
          <li> <p id="time"><?php echo date('H:i a') . " NZT"; ?></p> </li> 
        </ul>
        <a href="/" style="margin:0;"> <div class="mobile-logo"></div></a>
        <ul id="toolbar-list-two">
   <?php  if($page != "/signup") { ?>
          <li><a class="your-dash custom-font" id="goto-dashboard" href="/signup">Get started for free</a></li>
   <?php } ?>
          <li>
          <p><a id="login-here" class="btn outline already-a-member" href="javascript:;" data-toggle="modal" data-target="#loginmodal">Already a member? Login</a></p></li>
        </ul>
      </div>


<?php endif; endif; ?>
  

</div>
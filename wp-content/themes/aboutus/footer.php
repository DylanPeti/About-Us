<?php

$actual_link =  urldecode($_SERVER['REQUEST_URI']);
$signup_page = '/signup';
$whos_using_page = '/about-us-profiles/'

?>
              

       
 <div class="foot">
 <div class="center">

   <div class="all-footer-menu">
    <?php wp_nav_menu(array('menu' => 'foot')); ?> 
   </div>

   <div class="footer-social-icons">
    <ul id="footer-icons">
     <a href="https://www.facebook.com/theaboutuspage?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a>
     <a href="https://twitter.com/_aboutus" target="_blank"><i class="fa fa-twitter"></i></a>
     <a href="https://www.linkedin.com/groups/AboutUs-1109397" target="_blank"><i class="fa fa-linkedin"></i></a>
     <a href="https://www.youtube.com/channel/UCxOILdYtZMP4QZ3GDF4EHeA" target="_blank"><i class="fa fa-youtube"></i></a>
     <a href="http://www.instagram.com/aboutuspix" target="_blank"><i class="fa fa-instagram"></i></a>
     <a href="https://plus.google.com/+AboutusCoNz/videos" target="_blank"><i class="fa fa-google-plus"></i></a>
     <a href="http://www.pinterest.com/aboutuspix/" target="_blank"><i class="fa fa-pinterest"></i></a>

    </ul>
   </div>

   <div id="loginmodal" class="modal hide fade login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

        <?php if ( !is_user_logged_in() ) {  ?>

          <h2>AboutUs</h2>

        <?php } else{ ?>
            
         <h2>Options</h2>

         <?php } ?>

    </div>

    <div class="modal-body">
     <?php if ( !is_user_logged_in() ) {  ?>
      <div class="buttons">
<!--         <a href="/login-hauth?s=Facebook" class="btn">LOGIN WITH FACEBOOK</a>
        <a href="/login-hauth?s=Twitter" class="btn">LOGIN WITH TWITTER</a>
        <a href="/login-hauth?s=LinkedIn" class="btn">LOGIN WITH LINKEDIN</a> -->

      </div>
      <?php
          login_with_ajax(array(
                'label_username' => __( 'Email' ),
                'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . '/dash'));
                ?>
     <?php } else { ?>

   <div class="buttons">
            <a href="/dash" id="edit-page" class="btn">Dashboard</a>
            <a href="<?php echo get_permalink(TheFold\AboutUs\get_biz_from_user()) ?>" id="my-page" class="btn">My Page</a>
            <a href="/account/" id="edit-page" class="btn">Edit Page</a>
            <a href="<?php echo wp_logout_url('/'); ?>" id="profile-logout" class="btn">Logout</a>
            <!--   <a href="/login-hauth?s=LinkedIn" class="btn">LOGIN WITH LINKEDIN</a> -->
   </div>
   <?php  } ?>

   <?php 


   ?>

   </div>
   </div>
 
   </div>
   </div>
   
     <div class="foot-lower">
     <div class="center">
       <?php wp_nav_menu(array('menu' => 'Footer Menu 2')); ?> 
        </div>
     
   </div>
  


<!--NIELSON-->

<script type="text/javascript">
 var pvar = { cid: "nz-adhub", content: "0", server: "secure-nz" };

if (typeof nol_t == 'function') {
 var trac = nol_t(pvar);
  trac.record().post();
}

</script>

<script type="text/javascript" src="//secure-nz.imrworldwide.com/v60.js"></script>

<script language="JavaScript">

function PopUp(URL) {          
window.open(URL, 'Windowname', 'width=450, height=300, toolbar=0, scrollbars=1 ,location=0 ,statusbar=0,menubar=0, resizable=0');
}

</script>


<script>
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47490929-1', 'aboutus.co.nz');
  ga('send', 'pageview');
</script>









<script type="text/javascript">
// $( "input" ).css('background-color', '#000');
//   }).change();





</script>

<?php if ( current_user_can( 'administrator' ) ) { ?>

<script type="text/javascript">
$(document).ready(function () {
$('.navigation').css({
 'float': 'none',
 'position': 'absolute',
 'z-index': '2',
});

});
</script>
<?php } else{
  }?>




<script type="text/javascript" src="//use.typekit.net/ahc0gyy.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script src='http://getbarometer.s3.amazonaws.com/assets/barometer/javascripts/barometer.js' type='text/javascript'></script>
<script type="text/javascript" charset="utf-8">BAROMETER.load('1F2g2ec7DZEmE3mNdaORD');</script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  -->
 <div>
<!--  <img src="//secure-nz.imrworldwide.com/cgi-bin/m?ci=nz-adhub&amp;cg=0&amp;cc=1&amp;ts=noscript"
 width="1" height="1" alt="" /> -->
 </div>
 <?php wp_footer(); ?>
</noscript>
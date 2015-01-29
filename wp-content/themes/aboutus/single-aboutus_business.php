<?php
/**
 * Display a single business
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$banner = get_profile_banner();



get_header();
?>
<?php

$background_image = TheFold\AboutUs\get_biz_background_src(get_the_ID()); 
$ads = array();
$arguments = array(
   'post_type' => 'aboutus_offer',
  );
$aboutus_adverts = new WP_Query($arguments);

$advert = $aboutus_adverts->posts[0];

?>

<?php if($background_image): ?>
    <div class="profile" style="background-image: url(<?php echo $background_image ?>); background-color:#333;">
<?php else: ?>
      <div class="profile">
<?php endif ?>

    <?php // if(!isset($background_image)){ ?>
      <div id="map-container" class="map-container"><div id="mapCanvas"></div></div>
      <?php //} ?>
      <div class="container">
        <div class="profile-panel">
          <div class="column1">
<?php if( TheFold\AboutUs\get_biz_logo_src(get_the_ID(), 'full') ){ ?>
            <div class="profile-image">
              <img src="<?php echo TheFold\AboutUs\get_biz_logo_src(get_the_ID(),'medium'); ?>" alt="<?php echo the_title() ?>" />
            </div>
<?php } if(is_user_logged_in()){ ?>

<!-- <div class="profile-image upload-btn-businness" style="margin: 10px 0 30px 0">
<a href="/upload-image"><button>Upload Logo/Image</button></a>
</div> -->

  <?php } ?> 
            <h1><?php echo the_title() ?></h1>
            <h2 class="slogan"><?php $slogan = get_post_field('slogan', get_the_ID()); if($slogan !== array()): echo $slogan; endif ?></h2>
<?php if(1==1): ?>
            <p><?php echo get_post_field('post_content', get_the_ID()) ?></p>
<?php endif ?>
<?php 

if($active_sms = TheFold\AboutUs\get_biz_sms($post)): ?>
            <h5>Follow Us</h5>
            <ul class="profile-social">
<?php foreach($active_sms as $sms): ?>
              <li><a data-tab="<?php echo $sms->post_name ?>" href="www.facebook.com" class="<?php echo $sms->post_name ?>" data-target="#social-modal"><?php echo $sms->post_title ?></a></li>
<?php endforeach ?>
            </ul>
<?php endif ?>
          </div>
          <div class="column2">
            <h4>Contact Details</h4>

<?php $phone = get_field('phone'); $mobile = get_field('mobile'); if($phone && $mobile): ?>
            <p class="phone">Ph <strong><?php echo $phone ?></strong><br />Mob <strong><?php echo $mobile ?></strong></p>
<?php else: if($phone && $phone !== array()): ?>
            <a class="btn phone" href="javascript:;" ><?php echo $phone ?></a>
<?php endif; endif ?>
            <a class="btn email" data-toggle="modal" data-target="#contact-modal" href="javascript:;">EMAIL US</a>
<?php $website = get_field('website');
      if(is_array($website) && count($website) > 1): $website = end($website); endif;
      if(!is_array($website)) {
        if(strpos($website, ',') !== false) {
          $website = explode(',', $website);
          $website = trim(end($website));
        }
      }

    if($website && $website !== array()): ?>
            <a class="btn website" href="http://<?php echo str_replace('http://','',$website)?>" class="weblink" target="_blank">Website</a>
<?php endif ?>
            <p class="address"><?php echo implode('</br>',TheFold\AboutUs\get_biz_address( get_the_ID() )) ?><br /><?php
if($background_image): ?>
<a id="toggle-map" href="javascript:;">View map</a> <a id="focus-map" href="javascript:;">Focus map</a>
<?php else: ?>
<a id="focus-map" href="javascript:;" style="display: block;">View on map</a>
<?php endif; ?></p>
            <h4>Share this page</h4>
            <div class="business-page-social-share">
<!--               <div class="fb-like" data-href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo get_post_field('post_name', get_the_ID()) ?>" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false"></div>

 -->      
<!--  <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button"></div> -->
<button id="facebook-share" onclick="gogogo()">Share</button>

<script>
function gogogo() {

  console.log("'" + location.href + "'");
FB.ui({
  method: 'share_open_graph',
  action_type: 'og.likes',
  action_properties: JSON.stringify({
      object: location.href,
  })
}, function(response){
  console.log(response);
});

}
  
</script>





 <br />       
 <a href="https://twitter.com/share" class="twitter-share-button" data-via="DylanFruit" data-related="_aboutus" data-url="<?php echo wp_get_shortlink(); ?>" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
          </div>
        </div>
<?php if(is_user_logged_in()): if(TheFold\AboutUs\get_biz_from_user()->ID === get_the_ID()): ?>
        <div class="profile-info-panel">
          <h3>This Week</h3>
          <ul id="profile-stats" class="profile-stats ajax-load" data-url="/profile-stats" data-image="none">
            <li class="profile-stats-loading">Loading...</li>
          </ul>
          <a class="btn dashboard" href="/dash"></a>
        </div>
<?php endif; endif ?>
        <!-- <div class="advertising"> -->

<?php if($advert){ ?>
<!-- <a href="http://gigatown.co.nz/" target="_blank"><?php echo get_the_post_thumbnail($advert->ID)?></a> -->
        
<?php  } ?>


<!--         </div> -->

      </div>
    </div>

<?php if ( !is_user_logged_in() ): ?>
    <div class="section get-started">
      <div class="container">
        <div class="column1">
          <a href="/signup" class="btn">GET STARTED FOR FREE</a>
        </div>
        <div class="column2">
          <strong>Create your own About Us page.</strong><br />
          It’ll only take a couple of minutes.
        </div>
      </div>
    </div>
<?php endif ?>


<?php /*
<div id="sms-modal" class="modal hide fade">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
              <img src="/loading.gif" alt="loading" />
          </div>
          <div class="modal-footer">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          </div>
    </div>
*/ ?>

<?php if($active_sms): ?>
    <div id="social-modal" class="modal hide fade">
          <div class="modal-body social-modal-body">
              <ul id="social-modal-tabs" class="nav nav-tabs social-modal-tabs">
<?php foreach($active_sms as $sms): ?>
                <li data-tab="<?php echo $sms->post_name ?>"><a href="#<?php echo $sms->post_name ?>" data-url="/activity?bizid=<?php echo get_the_ID(); ?>&provider=<?php echo $sms->ID; ?>"><?php echo $sms->post_title; ?></a></li>
<?php endforeach ?>
                <li class="pull-right"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane active" id="facebook"><img src="/loading_drk.gif" class="loading" alt="loading" /></div>
                <div class="tab-pane" id="twitter"><img src="/loading_drk.gif" class="loading" alt="loading" /></div>
                <div class="tab-pane" id="linkedin"><img src="/loading_drk.gif" class="loading" alt="loading" /></div>
              </div>
          </div>
          <div class="modal-footer">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          </div>
    </div>
<?php endif ?>

<div id="contact-modal" class="modal hide fade">
  <?php /*(<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
  </div>*/ ?>
  <div class="modal-body modal-body-contact get-in-touch-form">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h2 class="custom-font">Get in touch</h2>
    <form id="contact-form" action="/email-business" method="post" class="form form-contact business-page">
      
      <input type="text" id="name" name="name" placeholder="Your Name*" class="text required">
      <input type="text" id="email" name="email" placeholder="Email Address*" class="text required email">
      <input type="text" id="phone" name="phone" placeholder="Phone Number" class="text">
      <textarea class="textarea required" name="message" placeholder="Message / Enquiry*"></textarea>
      <div id="form-contact-message"></div>
      <div class="control-group control-group-actions">
        <div class="controls">
          <input id="form-contact-submit" type="submit" value="Send Email" class="btn btn-primary pull-right" />
<!--           <span>* Mandatory Fields</span> -->
        </div>
      </div>
      <input type="hidden" name="business" value="<?php echo get_the_ID() ?>" />
    </form>
  </div>
</div>

<?php /*    <div id="map-modal" class="modal hide fade">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3></h3>
          </div>
          <div class="modal-body">
            <div id="mapCanvas" style="width: 530px; height: 400px"></div>
          </div>
          <div class="modal-footer">
             <div class="map-modal-details">
              <h2><?php echo the_title() ?></h2>
              <div class="column">
                <p class="title">Address</p>
                <p><?php echo implode('</br>',TheFold\AboutUs\get_biz_address( get_the_ID() )) ?></p>
              </div>
              <div class="column">
                <p class="title">Phone</p>
                <p><?php echo the_field('phone') ?></p>
              </div>
             </div>
             <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          </div>
    </div>*/ ?>


    <?php

     /*
        var mapVisible = false;
        var_dump(get_the_ID());
        get_post_meta(get_the_ID(),'LatLng');
*/ ?>
<script type="text/javascript">
jQuery(document).ready(function($){

    $("a[data-target=#social-modal]").click(function(ev) {
        ev.preventDefault();
        var target = $(this).attr("href"),
            tab = $(this).attr('data-tab');
        $("#social-modal").modal("show");
        $("#social-modal-tabs").find("li[data-tab='" + tab + "'] a").trigger('click');
        // Google Analytics tracking
        ga('send', 'event', 'Social Modal', 'View', '<?php echo get_the_ID() ?>', tab);
        return false;
    });

    $('#social-modal-tabs a').click(function(e){
      e.preventDefault();
      $(this).tab('show');
      var button = $(this),
          target = $(this).attr("data-url"),
          tab = $(this).attr('href'),
          loaded = $(this).data('loaded');
		  if(!loaded) {
        // load the url and show modal on success
        $(tab).load(target, function() {
          $(button).data('loaded', true);
        });
      }

    });
        
     var latlng = new google.maps.LatLng(<?php echo get_post_meta(get_the_ID(),'LatLng',true) ?>);
             
        var mapOptions = {
            scrollwheel: false,
            center: latlng,
            zoom: 17,
            zoomControl: true,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        };
    
        
        var map = new google.maps.Map(document.getElementById("mapCanvas"),mapOptions);
       
        var marker = new google.maps.Marker({
            position: latlng,
            title: '<?php echo the_title() ?>'
        });


        marker.setMap(map);

        $("#focus-map").on('click', function(e){
          e.preventDefault();
          // console.log("clickedy clicked");

          map.setCenterWithOffset(latlng, -150, 0, true);
          google.maps.event.trigger(map, "resize");
        });

<?php if($background_image): ?>
        var mapVisible = false;

        //map.setCenterWithOffset(latlng, -150, 0);
        $("#toggle-map").on('click', function(e){
          e.preventDefault();
          $("#map-container").toggleClass('visibility-on');
          $("#map-container").show();

          if(mapVisible) {
            $(this).html('View Map');
            $("#map-container, #focus-map").hide();
          } else {
            $(this).html('Hide Map');
            $("#map-container, #focus-map").show();
          }
          mapVisible = !mapVisible;

          google.maps.event.trigger(map, "resize");
          map.setCenter(latlng);
        });

<?php else: ?>

if (google.maps) {
        $("#map-container").show();
        map.setCenterWithOffset(latlng, -150, 0);
console.log("works");

}

        /*$("#toggle-map").on('click', function(e){
          e.preventDefault();
          map.setCenterWithOffset(latlng, -150, 0, true);
          google.maps.event.trigger(map, "resize");
        }).trigger('click');*/
<?php endif; ?>

<?php /*
        $("#map-container").show();

        map.setCenterWithOffset(latlng, -150, 0);

        $("#toggle-map").on('click', function(e){
          e.preventDefault();

          if(mapVisible) {
            $("#map-container").hide();
          } else {
            $("#map-container").show();
          }
          mapVisible = !mapVisible;

          map.setCenterWithOffset(latlng, -150, 0, true);
          google.maps.event.trigger(map, "resize");

        }).trigger('click');
*/ ?>

<?php /*
        $('#map-modal').on('shown', function () {
            google.maps.event.trigger(map, "resize");
            map.setCenter(latlng);
        });
*/ ?>

    // })();



});
</script>

<?php get_footer();
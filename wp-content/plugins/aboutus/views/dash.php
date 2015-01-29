<?php

// include('header.php');
get_header();
include(locate_template('inc/welcome-back.php'));
include(locate_template('inc/dashboard/tool-tips.php')); //
include(locate_template('inc/dashboard/stats.php'));
// include(locate_template('inc/dashboard/offers.php'));
// AMQPChannel

global $business_categories;
global $post;


include(locate_template('inc/left-section.php'));
?>
 <div id="connect-facebook-page-modal" class="modal hide fade connect-facebook-page-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header modal-header-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h2>Connect Facebook Page</h2>
        </div>
        <div class="modal-body modal-body-center">
          Loading...
        </div>
    </div>
    <?php

get_footer();

?>




<?php if(isset($_GET['connected']) && $_GET['connected']): $connectedService = $_GET['connected']; ?>
    <!-- Service Connection popup -->
 

  <script type="text/javascript">
		  $('#connect-service-modal').modal({});
		  var refreshId = setInterval(function() {
		  if ($(".connect-facebook-page").length || $(".twitter").length) {
      // $('#fcbk-next-container').html('<a href="javascript:;" class="btn" id="fcbk-next">Next</a>');
        $('#fcbk-next-container').html('<a href="." class="btn" id="fcbk-next">Next</a>');
  		  $("#fcbk-next").click( function(){
  			$('#connect-service-modal').modal('hide');
  			$(".connect-facebook-page").trigger("click");
  		  });
		      clearInterval(refreshId);
		    }
		  }, 1000);
  </script>
<?php endif ?>

<script type="text/javascript">
   //check if any connected

   //If any aren't connected, don't show the post to button
   if(!$("#stats_tab_Twitter").length){
   	$("#postto_twitter").hide();
   }
   if(!$("#stats_tab_Facebook").length){
   	$("#postto_facebook").hide();
   }
    if(!$("#stats_tab_LinkedIn").length){
    $("#postto_linkedIn").hide();
   }
   

  $(".postto_btn").on('click', function(e){
	  $("#social-post-provider").val(this.value);
    $("#social-post-form").find('textarea').attr('placeholder', 'What’s on your mind?');
    });	
  $("#channel-feed-buttons a").on('click', function(e){
    e.preventDefault();

  if(!$(this).parent().hasClass('active')) {
      var feed = $("#channel-feed"),
      url = $(this).attr('data-provider'),
      service = $(this).attr('data-service');
      $("#channel-feed-buttons li").removeClass('active');
      $(this).parent().addClass('active');
      //
	//check if service is undefined
	if (!service) {
  	  	//set twitter as default
		$("#social-post-provider").val("Twitter");
    $("#social-post-form").find('textarea').attr('placeholder', 'What’s on your mind?');

	} else {

  	    $("#social-post-provider").val(service);
        $("#social-post-form").find('textarea').attr('placeholder', 'What’s on your mind?');		
	}
	  
      feed.css('position', 'relative');
      feed.html('<img src="/loading_drk.gif" alt="loading" style="left: 50%; top: 50%; margin-left: -12px; margin-top: -12px; position: absolute;" />');
	  
	  //console.log("URL: -> "+url); //MM
	  
      $.get(url, function(html){
        feed.html(html);
      });
    }

  });

  // If a connect facebook page link is clicked, display the modal.
  $("#dashboard-stats").on('click', '.connect-facebook-page', function(e){
    e.preventDefault();
    console.log("works");
    console.log('connecting');

    $('#connect-facebook-page-modal').modal({});
  });

  // Load the connect page request when modal opens.
  $('#connect-facebook-page-modal').on('show', function(e){
    $(this).find('.modal-body').load('/connect-facebook-page');
    console.log('connecting facebook');
  });

  var socialPostForm = $("#social-post-form");

  socialPostForm.on('submit', function(e){
    e.preventDefault();
    $(this).find('a').html('Posting').css({opacity: 0.5});
    $.ajax({
      url: '/create-social-post',
      data: $("#social-post-form").serialize(),
      success: function(data) {
        socialPostForm.find('a').html('Post').css({opacity: 1});
        socialPostForm.find('.message').addClass('social-post-message').html(data.message);
        if(data.status === 'success') {
          socialPostForm.find('textarea').val('');
          ajaxLoad($("#channel-feed"));
        }
      }
    })
  });

  $("#social-post-form").find('a').on('click', function(e){
    e.preventDefault();
    $("#social-post-form").trigger('submit');
  });

  $("#dashboard-feed-filter").on('click', 'a', function(e){
    e.preventDefault();

    if(!$(this).parent().hasClass('active')) {
      $("#dashboard-feed-filter").find('li').removeClass('active');
      $(this).parent().addClass('active');

      var feed = $("#news-feed"),
          url  = '/dashboard-feed?category=' + $(this).attr('data-id');

      feed.css('position', 'relative');
      //feed.html('<img src="http://localhost/wp-content/uploads/2014/11/ajax-loader.gif" alt="loading" style="left: 50%; top: 50%; margin-left: -12px; margin-top: -12px; position: absolute;" />');

      $.get(url, function(html){
        feed.html(html);
      });
    }
  });

</script>



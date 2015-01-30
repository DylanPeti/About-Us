
jQuery(document).ready(function($) {

$(function(){



$(document).on("click",".marketplace-init", function(){


event.preventDefault();
$("html, body").animate({ scrollTop: 0 }, "slow");
$(".marketplace-hidden").fadeIn(1000);
$(".video-box").fadeIn(1000);
$(".mh").fadeIn(1000);
$("html").css({
     "overflow": 'hidden',
  
});

  console.log('working');

});
});

// $(function(){
// $(document).on("click",".marketplace-hidden", function(){

// event.preventDefault();
// $(this).fadeOut(1000);
// $(".mh").fadeOut(1000);
// $(".video-box").fadeOut(1000);
// $("html").css({
//      "overflow": 'auto',
  
//   	});
// });
// });


});
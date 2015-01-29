jQuery(document).ready(function($) {
  // console.log($('#HeadlineRect').contents().find('img').attr('src'));




$(document).on('click', ".offer-arrow", function(e){
  e.preventDefault();
   $('#the-offer').html("<i class='fa fa-spinner spin-filter' id='spin'></i>");
  var identifier = $(this).data('id');
  var direction = $(this).data('dir');
  var server = window.location.origin;

$.ajax({
  url: server + '/wp-content/themes/aboutus/category-marketplace.php',
  type: 'post',
  data: {'id': identifier, "dir": direction },
  cache: false,
  success: function(json) {

$('#the-offer').load(server + "/wp-content/themes/aboutus/ajax/pagnation.php?identifier=" + identifier + "&dir=" + direction);
  },

  error: function(xhr, desc, err){
  console.log(xhr + "\n" + err);
  }

   }); 
  });




$(document).on('click', '#posts-filter' ,function(e){
e.preventDefault();
var identifier = $(this).data('id');
var container = $('.bottom-half');
if(!window.location.origin){
var server = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
} else {
var server = window.location.origin;
}


var icon = "<i class='fa fa-spinner spin-filter' id='spin'></i>";
container.html(icon + "<h1 class='custom-font' id='spin-text'>One moment...</h1>");
var ajaxLoaderLeft = $('.bottom-half').width();
console.log(ajaxLoaderLeft);


$(".spin-filter").css({
  'left': ajaxLoaderLeft/2 - 40,
  'top': 100,

});


$.ajax({
  url: server + '/wp-content/themes/aboutus/front-page.php',
  type: 'post',
  data: {'id': identifier},
  cache: true,
  success: function(json) {

   container.load(server + "/wp-content/themes/aboutus/ajax/posts-filter.php?identifier=" + identifier, function(){
    $(this).hide().fadeIn('slow');
   });
    
  },

  error: function(xhr, desc, err){
  console.log(xhr + "\n" + err);
  }

   }); 
}); //ends






// $(document).on('click', ".marketplace-articles", function(e){
//   e.preventDefault();

//   var windowPosition = $(window).scrollTop();
//   var browserHeight = $(window).height();
//   // var top = $('.info').offset().top;
//   var height = $('.info').height();
//   var pos = windowPosition - top;
//   var position = pos - height;
//   var target =('.m-appear');
//   var container = $(this).next(target)
//   var identifier = $(this).data('id');
//   var direction = $(this).data('dir');
//   var server = window.location.origin;

//   container.addClass('modal fade hide');
//   container.html("<i class='fa fa-spinner spin-filter' id='spin'></i>");
//   container.css({

//     'left': '50%',
//     'margin-left': -container.width()/2,


//   });
//   var half = browserHeight/2;
//   var posor = windowPosition;
//   container.addClass('in');

//   $('<div class="modal-backdrop"></div>').appendTo(document.body).hide().fadeIn();
//   container.toggleClass('info-show');
//   container.css('display', 'block');
//   $('.modal-backdrop').toggleClass('in');


//   $.ajax({
//            url: server + '/wp-content/themes/aboutus/category-marketplace.php',
//            type: 'post',
//            data: {'id': identifier},
//            cache: false,
//            success: function(json) {
         
//               container.load(server + "/wp-content/themes/aboutus/ajax/article-toggle.php?identifier=" + identifier, function(){
//                 $(this).fadeIn('slow');
//               });
         
//            },
         
//            error: function(xhr, desc, err){
         
//            console.log(xhr + "\n" + err);
         
//            }
         
//    }); //ajax end

// }); //end


$(document).on('click', ".modal-backdrop, .fa-close", function(e){

$('.modal-backdrop').hide().fadeOut(1000).remove();
$('.modal').hide().fadeOut(1000);
$('.m-appear').removeClass('modal fade hide info-show');



});



$(document).on('click', "#watch-vid-button", function(e){

$('.offer-vid').toggleClass('vid-show', 1000);


  });



// $(document).on('click', ".fa-close", function(e){
// var container = $('.m-appear');
// container.toggleClass('info-show', 1000, 'swing');
// $('html').toggleClass('freeze', 1000, 'swing');
// $('.marketplace-hidden').toggleClass('bring-in', 1000, 'swing');
//   });



// $(document).on('click', ".marketplace-articles", function(e){
//    e.preventDefault();
//    var identifier = $(this).data('id');

//     $('.offers-contain').fadeOut(3000);
//     $('#the-offer').html("<div id='ajax-pre-load'></div>");

   
// $.ajax({
//   url: 'http://localaboutus/wp-content/themes/aboutus/category-marketplace.php',
//   type: 'post',
//   data: {'id': identifier},
//   cache: false,
//   success: function(json) {


//   $('#the-offer').load("http://localaboutus/wp-content/themes/aboutus/ajax/offers.php?identifier=" + identifier).fadeIn(3000);
//   },

//   error: function(xhr, desc, err){
//   console.log(xhr + "\n" + err);
//   }

//     }); 
//    }); 


 }); //end


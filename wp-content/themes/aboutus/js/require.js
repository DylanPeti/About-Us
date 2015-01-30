jQuery(document).ready(function($) {


// font size handling

//   $(window).resize("#flowtype", function(){   

//         curSize= parseInt($('#flowtype').css('font-size')) - 2;


//   if(curSize<=20 && $(window).width() > 960)

//         $('#flowtype').css('font-size', curSize);

//         }); 

// $(window).resize("#flowtype", function(){    

//         curSize= parseInt($('#flowtype').css('font-size')) - 10;

//   if(curSize>=12 && $(window).width() < 960)

//         $('#flowtype').css('font-size', curSize);

//         });

var optionsTabs = $('#article-options');
var optionsTabsWidth = optionsTabs.width();
var optionOne = $('.option-one');
var optionTwo = $('.option-two');
var optionThree = $('.option-three');

var leftSection = $('.article-suggestions').height();
// $('.sidebar').css('height', leftSection);

var properties = function(variable){

  var element = variable;
  var paddingLeft = parseInt(element.css('padding-left'), 10);
  var paddingRight = parseInt(element.css('padding-right'), 10);
  var marginRight = parseInt(element.css('margin-right'), 10);
  return paddingLeft + paddingRight + marginRight;

};
// + properties(optionOne);
var optionOneWidth = optionOne.width() + properties(optionOne);
var optionTwoWidth = optionTwo.width() + properties(optionTwo);
var optionThreeWidth = optionThree.width() + properties(optionThree);
var TabPointerWidth = $('#tab-pointer').find('ul');
var pointerOne = $('#pointer-one');
var pointerTwo = $('#pointer-two');
var pointerThree = $('#pointer-three');



pointerOne.css({
  'width': optionOneWidth
})
pointerTwo.css({
  'width': optionTwoWidth
})
pointerThree.css({
  'width': optionThreeWidth
})
TabPointerWidth.css({
  'width': optionsTabsWidth
});



  $("#contact-form").validate({
      submitHandler: function(form) {
          $("#form-contact-message").html("Loading...").addClass("ui-message ui-message-loading");
          // $("#contact-form").attr('disabled', '/upload-image').css({opacity: 0.5}).html('good...');
          $.post(
            $(form).attr('action'), $(form).serialize(), function(data){
            $("#form-contact-message").html(data.message).removeClass().addClass('ui-message ui-message-' + data.status);
            if(data.status == 'success') {
              $("#form-contact-submit").attr('disabled', 'disabled');
              $("#contact-form").find('textarea, input').css({opacity: 0.5}).attr('disabled', 'disabled');
            }
          }, 'json');
    // form.submit();
        }
    });


$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
    $box.css("background-color", "#000");
  } else {
    $box.prop("checked", false);
    $box.css("background-color", "#eee");

  }
});




  $(document).on("click", "#posts-filter", function(){
    var pointerOne = $('#pointer-one').find('div');
   var pointerTwo = $('#pointer-two').find('div');
   var pointerThree = $('#pointer-three').find('div');
   var pointer = $('.pointer');


//get tab selector
//get pointer selector
//assign


   
   $(".option-one, .option-two, .option-three").removeClass('charcoal-background');

   $(this).addClass('charcoal-background');
   var lastClass = $(this).attr('class').split(' ')[3];

   if(lastClass == 'option-one'){
     pointerOne.removeClass('pointer');
     pointerTwo.removeClass('pointer');
     pointerThree.removeClass('pointer');
     $(pointerOne).addClass('pointer');
   }
   else if(lastClass == 'option-two'){
     pointerOne.removeClass('pointer');
     pointerTwo.removeClass('pointer');
     pointerThree.removeClass('pointer');
     $(pointerTwo).addClass('pointer');
   } 
   else if(lastClass == 'option-three'){
     pointerOne.removeClass('pointer');
     pointerTwo.removeClass('pointer');
     pointerThree.removeClass('pointer');
     $(pointerThree).addClass('pointer');
   }




   });




$('.offers-cat').find('.gform_body').after("<p class='gform_description'>Finished? Click 'send' and we'll be in touch!</p>");
$('.single-offers-message').find('.gform_body').after("<p class='gform_description'>Finished? Click 'send' and we'll be in touch!</p>");


$(document).on("click",".marketplace-init", function(){


event.preventDefault();
$("html, body").animate({ scrollTop: 0 }, "slow");
$(".marketplace-hidden").fadeIn(1000);
$(".video-box").fadeIn(1000);
$(".mh").fadeIn(1000);
$("html").css({
     "overflow": 'hidden',
  
});


});


$(document).on("hover", '#offer-advert', function(){
  $(this).find('.hider').slideToggle(400)
});


// var leftArtcilesOffset = $('#filter-container').offset().top;
var heights = $(".bottom-section-one").map(function ()
    {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);



   var add = maxHeight * 3 + 200;
  var sidebarHeight = $(".sidebar").height();
  var add = "auto";
 
    $('.one.left-section.masonry').css({

      'min-height': '1892px',

    });


  

    $('.column').find('ul')
    .filter(function() {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    })
    .remove()
       $('.column')
    .filter(function() {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
    })
    .remove()

        // var options = {
        //     
        //         $Class: $JssorArrowNavigator$,
        //         $ChanceToShow: 2
        //     }
        // };

        // var jssor_slider1 = new $JssorSlider$('slider1_container', options);


        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: false,
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slideshow is auto playing, default value is false
                $ArrowKeyNavigation: true,                    //Allows arrow key to navigate or not
                $SlideWidth: 600,                                   //[Optional] Width of every slide in pixels, the default is width of 'slides' container
                //$SlideHeight: 300,                                  //[Optional] Height of every slide in pixels, the default is width of 'slides' container
                $SlideSpacing: 0,                           //Space between each slide in pixels
                $DisplayPieces: 2,                                  //Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 100,  
                $SlideSpacing: 15,                              //The offset position to park slide (this options applys only when slideshow disabled).
                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

             function ScaleSlider() {
               // var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth) {
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));

             } 
                else {
                    window.setTimeout(ScaleSlider, 30);
                
            }
        }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
   // $('.one').html("<button id='slider-button' class='b-green'>Get Started for Free</button>");
   // $('#slider-button').css('-webkit-transform', 'scale(0)');
          
        });




  //      $("#email-lister").submit(function(e) {
  //         $.post($(this).attr("action"), // url 
  // // $(this).serialize(), // data
  // function (data) { //success callback function
  //    alert("Edit successful");
  // }).error(function () {
  //     alert('failure'); 
  // });
  //            e.preventDefault();
  //         });







 $(function () {
        $('#subForm').submit(function (e) {
            e.preventDefault();
            $.getJSON(
            this.action + "?callback=?",
            $(this).serialize(),
            function (data) {
                if (data.Status === 400) {
                    alert("Error: " + data.Message);
                } else { // 200
                  $('#subForm').find('button').remove();
                  $('#subForm').find('.response').html('Thanks for signing up!')
                    
                }
            });
        });
    });




   $('#more').mouseenter(function(){
   $(this).effect( "bounce", { times: 2 }, "slow" );
   });
   $(document).on('click', '#more', function(){
   	var target = $('.news-section');
     var targetPosition = target.offset().top -20;


     $('html, body').animate({ scrollTop: targetPosition }, 500);
   });
    

  if(!Modernizr.input.placeholder){
    $("input").each(function(){
      if($(this).val()=="" && $(this).attr("placeholder")!=""){
        $(this).val($(this).attr("placeholder"));
        $(this).focus(function(){
          if($(this).val()==$(this).attr("placeholder")) $(this).val("");
        });
        $(this).blur(function(){
          if($(this).val()=="") $(this).val($(this).attr("placeholder"));
        });
      }
    });
  }


    });



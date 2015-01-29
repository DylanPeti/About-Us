jQuery(function($) {

 //    $('.geocomplete input').geocomplete({
 //        details:"form",
 //        country:'nz',
 //    }).bind('geocode:result',function(event,result){


 //        console.log(result);

 //        $.each(result.address_components, function(cindx, component){

 //            var value = component.long_name;
 //            var field = component.types[0];




 //            var input = $('.'+field+' input');
 // console.log(value);
 //            if(input.length)
 //                input.val(value);

 //        });

 //        var input = $('.LatLng input');
 //        if(input.length){

 //            input.val(result.geometry.location.lat()+', '+result.geometry.location.lng());
 //        }

 //    });





    $('.ajax-load').each(function(){

        var me = $(this);
        me.css('position', 'relative');

        var image = 'img/loading';
        if(me.attr('data-image') == 'drk') {
            image = 'loading_drk';
        }

        me.html('<i class="fa fa-circle-o-notch"></i>');

        $.get( AboutUs.site_url+me.attr('data-url'), function(html){
            me.html(html);
        });
    });


    $('#logo-upload-file').ajaxfileupload({
        'action': '/upload-image',
        'onComplete': function(response) {

            if(!$('#logo-image').length){
                $('#logo-upload').prepend('<img src="'+response[0]+'" id="logo-image"/>');
            }else{

            $('#logo-image').attr('src',response[0]);//.attr('width',response[1]).attr('height',response[2]);
            }

            update_completion_percent();
        }
    });

    $('#change-background-image').ajaxfileupload({
        'action': '/upload-image?bg=t&size=full',
        'onComplete': function(response) {

            $('body.single-aboutus_business').css('background-image','url('+response[0]+')');

            update_completion_percent();
        }
    });

    var update_completion_percent = function(){
        $.getJSON( AboutUs.site_url+'/completion-stats', function(response){
            $('.knob').val(response.percent).trigger('change');
        });
    }

    $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });

    /*Skype.ui({
      "name": "call",
      "element": "SkypeButton_Call_field.tim_1",
      "participants": ["field.tim"],
      "imageSize": 32
    });*/

    // Tab-Pane change function
    var tabChange = function(){
        var tabs = $('.rotate-tabs > li');
        var active = tabs.filter('.active');
        var next = active.next('li').length? active.next('li').find('a') : tabs.filter(':first-child').find('a');
        // Use the Bootsrap tab show method
        next.tab('show');
    }
    // Tab Cycle function
    var tabCycle = setInterval(tabChange, 7000);

    // Tab click event handler
    $(this).find('.rotate-tabs a').click(function(e) {
        e.preventDefault();
        // Stop the cycle
        clearInterval(tabCycle);
        // Show the clicked tabs associated tab-pane
        $(this).tab('show');
        // Start the cycle again in a predefined amount of time
        //setTimeout(function(){
        //    tabCycle = setInterval(tabChange, 7000);
        //}, 15000);
    });

    $(".knob").knob({
        'min':0,
        'max':100,
        'readOnly': true,
        'width': 120,
        'height': 120,
        'fgColor': '#FA5833',
        'dynamicDraw': true,
        'thickness': 0.2,
        'tickColorizeValues': true,
        'skin':'tron'
    });

    // Load Bootstrap tooltips for any specified elements.
    $('.ui-tooltip').tooltip();
});

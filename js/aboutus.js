google.maps.Map.prototype.setCenterWithOffset= function(latlng, offsetX, offsetY, animate) {
    var map = this;
    var ov = new google.maps.OverlayView();
    ov.onAdd = function() {
        var proj = this.getProjection();
        var aPoint = proj.fromLatLngToContainerPixel(latlng);
        aPoint.x = aPoint.x+offsetX;
        aPoint.y = aPoint.y+offsetY;
        if(animate) {
            map.panTo(proj.fromContainerPixelToLatLng(aPoint));
        } else {
            map.setCenter(proj.fromContainerPixelToLatLng(aPoint));
        }
    };
    ov.draw = function() {};
    ov.setMap(this);
};

$(function(){
	$(".selectpicker").selectpicker();

	$("body").on('click', '.scroll-to', function(e){
		e.preventDefault();
		$.scrollTo($(this).attr('href'), 600);
	});

	$("#offers-slider-buttons").find('a.slide-trigger').on('click', function(e){
		e.preventDefault();
		$("#offers-slider-buttons li").removeClass('active');
		$("#offers-slider-content li").removeClass('active');
		$(this).parent().addClass('active');

		var target = $("#offers-slider").find('li[data-id="' + $(this).attr('data-id') + '"]');
		target.addClass('active');
		$("#offers-slider-content").stop().animate({ marginLeft: 0 - target.position().left + 'px' }, 800);
		$("#offers-slider-info").find('h3').html(target.attr('data-title'));
		$("#offers-slider-info").find('.btn').attr('href', target.attr('data-url'));

	});

    // Load Bootstrap tooltips for any specified elements.
    $('.ui-tooltip').tooltip();

    $('.geocomplete input').geocomplete({
        details:"form",
        country:'nz',
    }).bind('geocode:result',function(event,result){


        $.each(result.address_components, function(cindx, component){

            var value = component.long_name;
            var field = component.types[0];
            var input = $('.'+field+' input');

            if(input.length)
                input.val(value);
        });

        var input = $('.LatLng input');
        if(input.length){
            input.val(result.geometry.location.lat()+', '+result.geometry.location.lng());
        }

    });

    $('.ajax-load').each(function(){
        ajaxLoad($(this));
    });

});

function ajaxLoad(element) {
    var image = 'loading',
        dataImage = element.attr('data-image');

    element.css('position', 'relative');

    if(dataImage == 'drk') {
        image = 'loading_drk';
    }

    if(dataImage !== 'none') {
        element.html('<i class="fa fa-spinner spin-dash" id="spin"></i>');
    }

    $.get( AboutUs.site_url+element.attr('data-url'), function(html){
        element.html(html);
    });
}
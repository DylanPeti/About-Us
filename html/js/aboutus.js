$(function(){

	$(".selectpicker").selectpicker({

	});

	/*$("#offers-slider").cycle({
		fx: 'carousel',
		slides: 'div',
		timeout: 0,
		pager: "#offers-slider-pager"
	});*/

	$("#offers-slider-buttons").find('a').on('click', function(e){
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

});
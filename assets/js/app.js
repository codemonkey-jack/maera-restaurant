jQuery(function($) {'use strict',

	// Initiate WOW JS
	new WOW().init();

	// Accordion
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

		 $(this).closest('.panel-heading').toggleClass('active');
	});

	// Goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});

	// Parallax
	$(document).ready(function() {
		var origheight = $(".parallax").height();
		var height = $(window).height();
		if (height = origheight) {
			$(".parallax").height(height);
		}
		$(window).scroll(function(){
			var x = $(this).scrollTop();
			$('.parallax').css('background-position','center -'+parseInt(x/10)+'px');
		});

	});

	// Make input buttons look better.
	$(document).ready(function() {
		$('input#submit').addClass('btn btn-primary');
		$('input.search-submit').addClass('btn btn-primary');
	});

});

var $j = jQuery.noConflict();
$j(window).load(function () {
	$j('section[data-type="background"]').each(function() {
		var $bgobj = $j(this);
		$j(window).scroll(function() {
			var yPos = -($j(window).scrollTop() / $bgobj.data('speed'));
			var coords = '50% ' + yPos + 'px';
			$bgobj.css({
				backgroundPosition : coords
			});
		});
	});
});

// This checks to see if the window has scrolled below the first section.
// If it has, it will change the menu class and affix it to the top.

// jQuery( document ).ready(function( $ ) {
// 	$(window).scroll(function() {
// 		if ($(document).scrollTop() >= $('#section_1').height() - $('nav').height() ){
// 			$('nav').removeClass('bottom-nav', 500, 'linear' );
// 			$('nav').addClass('small-nav', 500, 'linear' );
// 			$('.navbar-nav').addClass('navbar-right', 100, 'linear' );
// 			$('.navbar-brand').addClass('show-brand', 100, 'linear' );
// 			$('.navbar-brand').removeClass('hide-brand' );
// 			$('.navbar-brand').animate({ opacity: 1, easing: 'linear', }, 100);
// 		} else {
// 			$('nav').addClass('bottom-nav' );
// 			$('nav').removeClass('small-nav' );
// 			$('.navbar-nav').removeClass('navbar-right' );
// 			$('.navbar-brand').addClass('hide-brand' );
// 			$('.navbar-brand').removeClass('show-brand' );
// 			$('.navbar-brand').animate({ opacity: 0, easing: 'linear', }, 50);
// 		}
// 	});
//  });

// This helps the above function work a lot smoother/better.
// jQuery( document ).ready(function( $ ) {
// 	$('nav').affix({
// 		  offset: {
// 			top: $('#section_1').height() - $('nav').height()
// 		  }
// 	});
// });


// ***** DEBUG ***** //

// Leave SmoothScroll out for now.
// jQuery( document ).ready(function( $ ) {
// 	smoothScroll.init();
// });

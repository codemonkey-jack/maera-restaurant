// This checks to see if the window has scrolled below the slider.
// If it has, it will change the menu class and affix it to the top.

jQuery( document ).ready(function( $ ) {
 	$(window).scroll(function() {
		if ($(document).scrollTop() >= $('#slider').height() - $('nav').height() ){
			$('nav').removeClass('bottom-nav', 500, 'linear' );
			$('nav').addClass('small-nav', 500, 'linear' );
		} else {
			$('nav').addClass('bottom-nav' );
			$('nav').removeClass('small-nav' );
		}
	});
 });

// This helps the above function work a lot smoother/better.
jQuery( document ).ready(function( $ ) {
$('nav').affix({
      offset: {
        top: $('#slider').height() - $('nav').height()
      }
});
});

// Leave SmoothScroll out for now.
// jQuery( document ).ready(function( $ ) {
// 	smoothScroll.init();
// });

// Leave the following javascript below  for debug purposes.  Remove during release.
$(document).ready(function() {
	$('.carousel').carousel({
	    pause: true,
	    interval: false
	});
});

// This checks to see if the window has scrolled below the slider.
// If it has, it will change the menu class and affix it to the top.

jQuery( document ).ready(function( $ ) {
	$(window).scroll(function() {
		if ($(document).scrollTop() >= $('#slider').height() - $('nav').height() ){
			$('nav').removeClass('bottom-nav', 500, 'linear' );
			$('nav').addClass('small-nav', 500, 'linear' );
			$('.navbar-nav').addClass('navbar-right', 100, 'linear' );
			$('.navbar-brand').addClass('show-brand', 100, 'linear' );
			$('.navbar-brand').removeClass('hide-brand' );
			$('.navbar-brand').animate({ opacity: 1, easing: 'linear', }, 100);
		} else {
			$('nav').addClass('bottom-nav' );
			$('nav').removeClass('small-nav' );
			$('.navbar-nav').removeClass('navbar-right' );
			$('.navbar-brand').addClass('hide-brand' );
			$('.navbar-brand').removeClass('show-brand' );
			$('.navbar-brand').animate({ opacity: 0, easing: 'linear', }, 50);
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

$(document).ready(function() {
	$('.frontpage_article').hover(
		function(){
			$(this).find('.caption').slideDown(250); //.fadeIn(250)
		},
		function(){
			$(this).find('.caption').slideUp(250); //.fadeOut(205)
		}
	);
});

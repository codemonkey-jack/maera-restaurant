var $j = jQuery.noConflict();

// Navbar
$j(document).ready(function () {
	var nav = $j('.navbar');
	var origOffsetY = nav.offset().top;

	function scroll() {
		if ($j(window).scrollTop() >= origOffsetY) {
			$j('.navbar').addClass('affix');
			$j('#wrap-main-section').addClass('nav-padding');
		} else {
			$j('.navbar').removeClass('affix');
			$j('#wrap-main-section').removeClass('nav-padding');
		}
	}
	document.onscroll = scroll;
});

// Parallax
$j(document).ready(function() {
	var origheight = $j(".parallax").height();
	var height = $j(window).height();
	if (height = origheight) {
		$j(".parallax").height(height);
	}
	$j(window).scroll(function(){
		var x = $j(this).scrollTop();
		$j('.parallax').css('background-position','center -'+parseInt(x/20)+'px');
	});

});

// Make input buttons look better.
$j(document).ready(function() {
    $j('input#submit').addClass('btn btn-primary');
});


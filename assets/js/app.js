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
$j(window).load(function () {
	$j('div[data-type="background"]').each(function() {
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

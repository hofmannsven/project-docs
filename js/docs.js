jQuery(document).ready(function ($) {
	// scroll down
	$('.navigation a').on('click', function() {
		var hash = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $(hash).offset().top-30
		}, 'slow');
		return false;
	});
});
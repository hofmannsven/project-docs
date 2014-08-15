jQuery(document).ready(function ($) {
	// scroll down
	$('.navigation a').on('click', function() {
		var thisClicked = $(this).attr('href');
		$('html, body').animate({ scrollTop: $(thisClicked).offset().top-30 }, 'slow');
	});
});
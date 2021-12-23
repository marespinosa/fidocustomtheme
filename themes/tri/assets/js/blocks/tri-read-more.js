(function ($) {

	// Shortcode: [read_more]
	// Show more text button
	$('.read-more-toggle').on('click', function(e) {
		var moreToggle = $(this),
			currentText = moreToggle.text(),
			moreText = moreToggle.data('more'),
			lessText = moreToggle.data('less');
		moreToggle.toggleClass('is-active').prev('.read-more-content').slideToggle().toggleClass('is-active');
		moreToggle.text( currentText == moreText ? lessText : moreText);
		e.preventDefault();
	});

})(jQuery);
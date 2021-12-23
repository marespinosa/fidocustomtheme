(function ($) {
	//Accordion
	$('.accord-title').click(function (e) {
		e.preventDefault();
		$(this).toggleClass('is-active').next('.accord-body').not(':animated').slideToggle(250);
	});
	$('.accord-body:not(.is-active)').hide();

})(jQuery);
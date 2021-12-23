(function ($) {

	// Tabs
	function showTab(tab) {
		$(tab).addClass('is-active')
			.siblings().removeClass('is-active')
			.parents('.tri-tabs').find('.tri-tab-pane').hide()
			.eq( $(tab).index() ).fadeIn();
	}
	$('.tri-tab-nav').delegate('span:not(.is-active)', 'click', function (e) {
		e.preventDefault();
		showTab($(this));
	});
	$('.tri-tab-pane').hide();
	$('.tri-tab-nav a:first-child').addClass('is-active');
	$('.tri-tab-content .tri-tab-pane:first-child').show();
	if ( document.location.hash !== '' ) {
		showTab( window.location.hash );
	}

})(jQuery);
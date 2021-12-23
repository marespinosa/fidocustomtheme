(function ($) {

	// Global variables
	var body = $('body'),
		header = $('#tri-header'),
		lastScrollTop = 0;

	// Add initial scroll class to body
	if ($(window).scrollTop() === 0) {
		body.addClass('scroll-near-top');
	}

	// Header scroll class
	$(window).scroll(function(event){
		var scrollTop = $(this).scrollTop();

		// Scrolling down or up
		if( scrollTop > lastScrollTop){
			body.addClass('scroll-down').removeClass('scroll-up');
		} else {
			body.addClass('scroll-up').removeClass('scroll-down');
		}

		// If user is scrolled within 70px from top
		if ( scrollTop === 0 ) {
			body.addClass('scroll-at-top');
		} else if ( scrollTop < 50 ) {
			body.addClass('scroll-near-top');
		} else {
			body.removeClass('scroll-near-top');
		}
		// If user is scrolled within 70px from bottom
		if (body.height() < ( $(window).height() + scrollTop + 50 ) ) {
			body.addClass('scroll-near-bottom');
		} else {
			body.removeClass('scroll-near-bottom');
		}

		// Record last scroll
		lastScrollTop = scrollTop;
	});


	// Make body content sit underneath the header menu
	function headerOnTop() {
		header.css('marginBottom', -header.outerHeight() + header.scrollTop());
	}
	if ( body.hasClass('header-on-top') ) {
		headerOnTop();

		$(window).on('resize orientationChanged load', function () {
			window.requestAnimationFrame(headerOnTop);
		});
	}


	// Position submenu items
	$("#tri-menu .menu-item-has-children:not(.tri-mm)").on('mouseenter mouseleave', function () {
		var element = $('ul:first', this);
		if ( element.offset().left + element.width() > body.width() ) {
			element.addClass('on-edge');
		} else {
			element.removeClass('on-edge');
		}
	});


	// Search box menu
	$('#menu-search').click(function (e) {
		e.preventDefault();
		$('#menu-search-form').toggleClass('d-none').find('input.search-field').focus();
	});
	$(document).mouseup(function (e) {
		var container = $('.menu-item-search');

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$('#menu-search-form').addClass('d-none');
		}
	});


	//Mobile Menu
	$('#mobile-menu-toggle, .mobile-menu-active #tri-menu a, #site-overlay').click(function (e) {
		body.toggleClass('mobile-menu-active'); //toggle site overlay
	});

	// Toggle Sub-menu on mobile
	if ($(window).width() < 768) {
		$('#tri-menu li').each(function(index, el) {
			var parentMenu = $(this);
			if (parentMenu.hasClass('menu-item-has-children')) {
				parentMenu.append('<button class="submenu-toggle" aria-label="Toggle sub-menu"></button>');
				parentMenu.find('.sub-menu').hide();
			}
		});

		$('#tri-menu').on('click', '.submenu-toggle', function(event) {
			event.preventDefault();
			$(this).prev('.sub-menu').toggle(300);
		});
	}


	// Share bar popup window
	$('.js-open-window').click(function (e) {
		e.preventDefault();
		tri_open_window( $(this).attr('href') );
	});

	// Opens the provided link in a small popup window
	function tri_open_window(url) {
		var left = (screen.width / 2) - 300,
			top = (screen.height / 2) - 225,
			url = url;

		return window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=450, top=' + top + ', left=' + left);
	}


	// Gallery Images
	if ($().magnificPopup) {
		//Galleries
		$('.is-popup-gallery, .wp-block-gallery').magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: { enabled: true }
		});
		// Div Content
		$('.is-popup-link').click(function(e) {
			$.magnificPopup.open({
				items: {
					src: $(this).is('a') ? $(this).attr("href") : $(this).find('a').attr("href")
				},
				type: 'inline',
				midClick: true,
				// Delay in milliseconds before popup is removed
				removalDelay: 300,

				// Class that is added to popup wrapper and background
				// make it unique to apply your CSS animations just to this exact popup
				mainClass: 'mfp-fade'
			});
		});
		// Maps/Youtube
		$('.is-popup-media').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			removalDelay: 300,
			fixedContentPos: false
		});
		// Single Image
		$('.image-popup').magnificPopup({
			type: 'image',
			closeOnContentClick: true
		});
	}


	// Scroll to anchors
	$('.js-scroll, .js-menu-scroll a').click(function(event) {
		// On-page links
		if ( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ) {
			// Figure out element to scroll to
			var target = $(this.hash),
				sOffset = 0;

			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			// Does a scroll target exist?
			if (target.length) {
				if ($(this).data('offset')) {
					sOffset = $(this).data('offset');
				}
				// If admin bar, add extra scroll
				if ( $('#wpadminbar').length ) {
					sOffset += $('#wpadminbar').outerHeight();
				}
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$('html, body').animate({
					scrollTop: target.offset().top - sOffset
				}, 1000, function() {
					$(target).attr('tabindex','-1'); // Adding tabindex for elements not focusable
				});
			}
		}
	});


	// Check to see if element is in the viewport - Version 1.3.2 MIT License 2014 Dirk Groenen
	$.fn.viewportChecker = function () {

		// Cache the given element and height of the browser
		var $elem = this,
			boxSize = $(window).height();

		this.checkElements = function (){
			// Set some vars to check with
			var viewportStart = Math.max(
					$('html').scrollTop(),
					$('body').scrollTop(),
					$(window).scrollTop()
				),
				viewportEnd = (viewportStart + boxSize);

			$elem.each(function (){
				var $obj = $(this);

				// define the top position of the element and include the offset which makes is appear earlier or later
				var elemStart = Math.round( $obj.offset().top ) + 100,
					elemEnd = elemStart + $obj.height();

				// Add class if in viewport
				if ((elemStart < viewportEnd) && (elemEnd > viewportStart)){
					$obj.addClass('has-animated').removeClass('show-on-scroll');
				}
			});
		};

		// Select the correct events
		if( 'ontouchstart' in window || 'onmsgesturechange' in window ){
			// Device with touchscreen
			$(document).bind("touchmove MSPointerMove pointermove", this.checkElements);
		}

		// Always load on window load
		$(window).bind("load scroll", this.checkElements);

		// On resize change the height var
		$(window).resize(function (e) {
			boxSize = $(window).height();
			$elem.checkElements();
		});

		// trigger inital check if elements already visible
		this.checkElements();

		// Default jquery plugin behaviour
		return this;
	};
	$('.show-on-scroll').viewportChecker();


	// Isotope
	// if (jQuery().isotope) {
	// 	jQuery('.post-feed-wrapper').isotope({
	// 		itemSelector: '.post-feed-item'
	// 	});

	// 	jQuery('.post-feed-filters a').click(function () {
	// 		var portfolioFilter = jQuery(this);

	// 		// Add active class to filter
	// 		portfolioFilter.closest('.post-feed-filters').find('.filter-item.is-checked').removeClass('is-checked');
	// 		portfolioFilter.parent('.filter-item').addClass('is-checked');

	// 		// Filter the items based on the item clicked
	// 		jQuery('.post-feed-wrapper').isotope({
	// 			filter: '.' + portfolioFilter.attr('data-filter')
	// 		});
	// 		return false;
	// 	});
	// }
})(jQuery);

// // Isotope Reload layout once images have loaded
// $(window).load( function() {
// 	if (jQuery().isotope) {
// 		jQuery('.post-feed-wrapper').isotope({
// 			itemSelector: '.post-feed-item'
// 		});
// 	}
// });
(function ($) {

	// Shortcode: [count_up]
	// Initiate count-up number shortcode on load
	$(".tri-count-up .count-number").each(function (i, el) {
		if ( $(el).hasClass('has-animated') ) {
			triCountUp( $(this) );
		}
	});

	// Initiate count-up shortcode on scroll
	$(window).scroll(function (event) {

		$(".tri-count-up .count-number").each(function (i, el) {
			var el = $(el);
			if ( el.hasClass('has-animated') && !el.hasClass('is-counting') && !el.hasClass('has-counted') ) {
				triCountUp( $(this) );
			} else if (!el.hasClass('has-animated') && el.hasClass('is-counting') ) {
				el.data('counter').stop(true);
				el.removeClass('is-counting');
			}
		});

	});

	// Add space to numbers under 10 for count-up shortcode
	function triPadNum( num ) {
		if ( num < 10 ) {
			return " " + num;
		}
		return num;
	}

	// Add commas to format for count-up shortcode
	function triAddCommas( num ) {
		num += '';
		x = num.split( '.' );
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while ( rgx.test(x1) ) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}

	// Count-up shortcode function
	function triCountUp(selector) {
		//Animate count
		var $selector = $(selector).addClass('is-counting'),
			$points = $selector.data('number');
			$duration = $selector.data('duration'),

			$counter = $({
				countNumber: $selector.text()
			}).animate({
				countNumber: $points
			}, {
				duration: $duration * 1000,
				easing: 'linear',
				step: function (now) {
					$selector.text( triAddCommas( triPadNum( parseInt( this.countNumber ) ) ) );
				},
				complete: function () {
					$selector.removeClass('is-counting').addClass('has-counted');
					$selector.text( triAddCommas( $points ) );
				}
			});
		$selector.data( 'counter', $counter );
	}

})(jQuery);
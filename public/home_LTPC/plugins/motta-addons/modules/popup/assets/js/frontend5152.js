(function($) {

	function closePopup($popup) {
		var date = new Date(),
			value = date.getTime(),
			options = $popup.data('options'),
			post_ID = options.post_ID,
			days = options.frequency;

		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		document.cookie = 'motta_popup_'+ post_ID +'=' + value + ';expires=' + date.toGMTString() + ';path=/';

		$popup.removeClass('open').fadeOut();
	}

	function openNextPopup($post_IDs) {
		var $next_popup_ID = $post_IDs[0],
			$next_popup = $('#motta_popup_' + $next_popup_ID);
			if( ! $next_popup.length ) {
				return;
			}

			var options = $next_popup.data('options'),
				visible = options.visiblle,
				seconds = options.seconds,
				seconds = Math.max( seconds, 0 );
				seconds = 'delayed' === visible ? seconds : 0;
				setTimeout( function() {
					$next_popup.fadeIn().addClass('open');
				}, seconds * 1000 );
	}

	$(function() {
		if ( ! $('.motta-popup').length ) {
			return;
		}
		var $post_IDs = [];
		$('.motta-popup').each(function() {
			var $this = $(this),
				options = $this.data('options'),
				post_ID = options.post_ID,
				visible = options.visiblle,
				seconds = options.seconds;
				seconds = Math.max( seconds, 0 );
				seconds = 'delayed' === visible ? seconds : 0;

				if( ! $post_IDs.length ) {
					$( window ).on( 'load', function() {
						setTimeout( function() {
							$this.fadeIn().addClass('open');
						}, seconds * 1000 );
					} );
				}

				$post_IDs.push(post_ID);

		});

		$('.motta-popup').on('click', '.motta-popup__close, .motta-popup__backdrop', function (e) {
			e.preventDefault();
			var $this = $(this),
				$popup = $this.closest('.motta-popup');

			closePopup($popup);
			$post_IDs.shift();
			if( $post_IDs.length ) {
				openNextPopup($post_IDs);
			}

		});
	});
})(jQuery);
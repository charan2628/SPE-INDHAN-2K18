jQuery(document).ready(function() {
	if( $('.stretchy-nav').length > 0) {
		var stretchyNavs = $('.stretchy-nav');

		stretchyNavs.each(function() {
			var stretchyNav = $(this),
			    stretchyNavTrigger = stretchyNav.find('.nav-trigger');

			stretchyNavTrigger.on('click', function(event) {
				event.preventDefault();
				stretchyNav.toggleClass('nav-is-visible');
				wScroll = $(window).scrollTop();
				$('.nav-visibler').toggle();
			});
		});
		$(document).on('click', function(event) {
			( !$(event.target).is('.nav-trigger') &&
			  !$(event.target).is('.nav-trigger span')) &&
			   stretchyNavs.removeClass('nav-is-visible');
		});
		$(document).on('click', function(event) {
			( !$(event.target).is('.nav-trigger') &&
			  !$(event.target).is('.nav-trigger span')) &&
			   $('.nav-visibler').hide();
		});
	}
});
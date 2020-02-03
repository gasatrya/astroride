(function ($) {

	// Mobile menu
	function mobileMenu () {
		let $wrapper = $('.site');

		$('.menu-toggle').on('click', function (e) {
			e.preventDefault();
			if ($wrapper.hasClass('mobile-nav-open')) {
				$wrapper.removeClass('mobile-nav-open');
			} else {
				$wrapper.addClass('mobile-nav-open');
			}
		});
	}

	// Sub-menu mobile
	function subMenuMobile () {
		$('.submenu-expand').each(function() {
			$(this).on('click', function(e) {
				e.preventDefault();
				$(this).parent().toggleClass('submenu-open');
				$(this).next('ul').slideToggle();
			});
		});
	}

	// Document ready
	$(function () {
		mobileMenu();
		subMenuMobile();
	});

})(jQuery);

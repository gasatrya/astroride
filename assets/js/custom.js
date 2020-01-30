(function ($) {

	// Mobile menu
	function mobileMenu() {
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

	// Document ready
	$(function () {
		mobileMenu();
	});

})(jQuery);

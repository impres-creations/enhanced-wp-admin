/*
 * Boilerplate from: https://github.com/jquery-boilerplate/jquery-patterns/blob/master/patterns/jquery.basic.plugin-boilerplate.js
 */

;(function ($)
{
	"use strict";

	/**
	 * Calculate the height of the container and determine the position for sticky
	 * We're doing this because sticky requires a top value, and we want to start sticky on the bottom of our element
	 */
	function stickyPosition()
	{
		var $stickyContainer = $('.sticky-container');

		$stickyContainer.each(function ()
		{
			var $this = $(this);

			// Check if the element is bigger in height than our window.
			if ($this.height() > $(window).height()) {
				$this.css({
					top: 'calc(100vh - ' + ( $(this).outerHeight() + 20) + 'px)'
				});
			} else {
				$this.removeAttr('style');
			}
		});
	}

	/**
	 * "Unhack" the entire WordPress form html on post or post-new.
	 * Because we want to use flexbox and position sticky to make some nice effects
	 */
	$(document).on('ready', function ()
	{
		var $body = $('body');
		var $highContent = $('#post-body-content');
		var $lowContent = $('#postbox-container-2');
		var $sideContent = $('#postbox-container-1');

		// Check if we are on the right page
		if (($body.hasClass('post-php') || $body.hasClass('post-new-php')) &&
			$highContent.length && $lowContent.length && $sideContent.length) {

			// Add some classes for our css to activate
			$body.addClass('flex').addClass('sticky');

			// Make some proper columns
			$highContent.wrap('<div class="column left"><div class="sticky-container left"></div></div>');
			$lowContent.insertAfter($highContent);

			$sideContent.wrap('<div class="column right"><div class="sticky-container right"></div></div>');

			/*
			 * Start stickying this stuff.
			 * P.S: No need to do this on a DOM Watcher.
			 * Because it doesn't matter if sticky is wrong only if we start scrolling
			 */
			$(window).on('load', function ()
			{
				stickyPosition();
			});

			$(window).on('scroll', function ()
			{
				stickyPosition();
			});
		}
	});
})(jQuery);
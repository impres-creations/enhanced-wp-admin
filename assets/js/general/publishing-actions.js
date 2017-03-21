/*
 * Boilerplate from: https://github.com/jquery-boilerplate/jquery-patterns/blob/master/patterns/jquery.basic.plugin-boilerplate.js
 */

;(function ($)
{
	"use strict";

	function fixPublishingAction()
	{
		var $publishingContainer = $('#major-publishing-actions');
		var $publishingAction = $('#publishing-action');

		if ($publishingAction.length) {
			$publishingAction.outerWidth($publishingContainer.width());

			if ($(window).scrollTop() > ($publishingContainer.offset().top +
				$('#delete-action').height() - $('#wpadminbar').height())) {
				$publishingAction.addClass('publishing-action--fixed');
			} else {
				$publishingAction.removeClass('publishing-action--fixed');
			}
		}
	}

	$(document).on('ready', function ()
	{
		fixPublishingAction();

		$(window).resize(function ()
		{
			fixPublishingAction();
		});

		$(window).on('scroll', function ()
		{
			fixPublishingAction();
		});

	});


})(jQuery);
/*
 * Boilerplate from: https://github.com/jquery-boilerplate/jquery-patterns/blob/master/patterns/jquery.basic.plugin-boilerplate.js
 */

;(function ($)
{
	"use strict";

	/**
	 * Edit the entire WordPress form html on post or post-new.
	 * Because we want to use flexbox and position sticky to make some nice effects
	 */
	$(document).on('ready', function ()
	{
		var $body = $('body');
		var $wpcontent = $('#wpbody-content');
		var $wrap = $('#wpbody-content .wrap');
		var $notice = $wrap.find('.notice, .acf-error-message, .update-nag');

		$wpcontent.prepend('<div class="growl"></div>');
		var $growl = $('.growl');

		$notice.each(function ()
		{
			var $this = $(this);
			$this.appendTo($growl);

			if ($this.hasClass('is-dismissible') && $this.hasClass('updated')) {
				console.log('hoi');
				setTimeout(function ()
				{
					$this.fadeTo(100, 0, function ()
					{
						$this.slideUp(100, function ()
						{
							$this.remove();
						});
					});
				}, 3000);
			}
		});

// 		$('.update-nag').appendTo($growl);


	});
})(jQuery);
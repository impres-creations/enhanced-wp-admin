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

		$wpcontent.prepend('<div class="growl"></div>');
		var $growl = $('.growl');

		growl();

		$.initialize(".acf-error-message", function ()
		{
			growl();
		});
	});

	function growl()
	{
		var $growl = $('.growl');
		var $notice = $('.notice, #post > .acf-error-message, .update-nag');

		$notice.each(function ()
		{
			var $this = $(this);
			$this.appendTo($growl);

			if (($this.hasClass('is-dismissible') && $this.hasClass('updated')) ||
				$this.hasClass('acf-error-message')) {
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
	}
})(jQuery);
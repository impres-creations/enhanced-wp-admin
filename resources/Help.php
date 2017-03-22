<?php

namespace EnhancedWPAdmin;

/**
 * Class Help
 *
 * We don't need any help. And even if we do, this isn't of any help.
 * It's like putting a donkey in charge of education
 * We have developer.wordpress.org or just wordpress.org, maybe even wpbeginner.com but not this.
 * Seriously ...
 */
class Help
{
	public function __construct()
	{
		$this->init();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	public function init()
	{
		add_filter('contextual_help', [$this, 'removeHelpTabs'], 100, 3);
	}

	/**
	 * Remove the help tabs
	 *
	 * @param $old_help
	 * @param $screen_id
	 * @param $screen
	 * @return mixed
	 */
	public function removeHelpTabs($old_help, $screen_id, $screen)
	{
		$screen->remove_help_tabs();
		return $old_help;
	}
}
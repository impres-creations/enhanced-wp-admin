<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedComments
 *
 * Comments are mostly spamming our websites. Not a lot of WordPress sites use comments, so we're disabling them.
 */
class Customizer
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
		// Drop some customizer actions
		remove_action('plugins_loaded', '_wp_customize_include', 10);
		remove_action('admin_enqueue_scripts', '_wp_customize_loader_settings', 11);

		add_action('load-customize.php', [$this, 'disableCustomizer']);
		add_filter('map_meta_cap', [$this, 'removeCustomizer'], 10, 2);
	}

	/**
	 * Manually overriding specific Customizer behaviors
	 */
	public function disableCustomizer()
	{
		wp_die(__('The Customizer is currently disabled.'));
	}

	/**
	 * Make sure no buttons are shown.
	 *
	 * @param array $caps
	 * @param string $cap
	 * @param int $user_id
	 * @param array $args
	 * @return array
	 */
	public function removeCustomizer($caps = [], $cap = '')
	{
		if ($cap == 'customize') {
			return ['nope']; // thanks @ScreenfeedFr, http://bit.ly/1KbIdPg
		}

		return $caps;
	}
}
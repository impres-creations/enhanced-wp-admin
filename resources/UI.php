<?php

namespace EnhancedWPAdmin;

/**
 * Class Styles
 *
 * To really improve the UI / UX, we do really need to teach WordPress some styling.
 */
class UI
{
	public function __construct()
	{
		$this->addHooks();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	private function addHooks()
	{
		// Remove the thank you notes
		add_filter('admin_footer_text', '__return_empty_string', 11);
		add_filter('update_footer', '__return_empty_string', 11);

		add_action('admin_enqueue_scripts', [$this, 'loadScripts']);
	}

	/**
	 * Load al the scripts and styles
	 */
	public function loadScripts()
	{
		wp_enqueue_style('enhanced-admin-css', ENHANCED_WP_ADMIN_ASSETS . 'css/enhanced-wp-admin.min.css', false,
			ENHANCED_WP_ADMIN_VERSION);

		wp_enqueue_script('enhanced-admin-js', ENHANCED_WP_ADMIN_ASSETS . 'js/enhanced-wp-admin.min.js', ['jquery'],
			ENHANCED_WP_ADMIN_VERSION, true);
	}
}
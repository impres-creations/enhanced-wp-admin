<?php

namespace EnhancedWPAdmin;

/**
 * Class Dashboard
 *
 * This class is like the EPA in Trump's administration.
 * It's awesome, but we just don't believe in it, so we're getting rid of it.
 */
class Dashboard
{
	public function __construct()
	{
		$this->init();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	private function init()
	{
		// Redirect away from dashboard
		add_action('load-index.php', [$this, 'dashboardRedirect'], 10, 3);
		add_action('login_redirect', [$this, 'dashboardRedirect'], 10, 3);
	}

	/**
	 * Make sure the dashboard redirects to pages
	 */
	public function dashboardRedirect($redirect_to, $request = null, $user = null)
	{
		$adminUrl = admin_url('edit.php?post_type=page');

		if (!empty($redirect_to)) {
			return $adminUrl;
		} else {
			wp_redirect($adminUrl);
		}
	}

	/**
	 * Remove default admin bar menu items.
	 */
	public function removeAdminBarItems()
	{
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('search');

		$wp_admin_bar->remove_node('dashboard');
		$wp_admin_bar->remove_node('themes');
		$wp_admin_bar->remove_node('menus');
	}
}
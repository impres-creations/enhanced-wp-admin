<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedDashboard
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
		add_action('admin_menu', [$this, 'removeDashBoard']);
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
	 * Remove the dashboard page in the menu
	 */
	public function removeDashboard() {
		remove_menu_page('index.php');
	}
}
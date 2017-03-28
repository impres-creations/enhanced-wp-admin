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
		$this->addHooks();
		$this->changeMenuItems();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	private function addHooks()
	{
		add_action('load-index.php', [$this, 'dashboardRedirect'], 20, 3);
		add_action('login_redirect', [$this, 'dashboardRedirect'], 20, 3);
		add_action('wp_before_admin_bar_render', [$this, 'removeAdminBarItems']);
	}

	/**
	 * Change the menu items
	 */
	private function changeMenuItems()
	{
		global $submenu;

		// Remove the dashboard from the menu
		remove_menu_page('index.php');

		// Move the updates submenu to the settings
		foreach ($submenu['index.php'] as $subItem) {
			if ($subItem[2] === 'update-core.php') {
				$submenu['options-general.php'][0.1] = $subItem;

				ksort($submenu['options-general.php']);
			}
		}
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

		$wp_admin_bar->remove_node('dashboard');
	}
}
<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedMenu
 *
 * This class is responsible for changing the WP Admin menu.
 *
 * @note: this is not a fully fledged menu plug-in. If you want full control over your menu use the provided code
 * by WordPress or use a plug-in that specifically targets this feature.
 * For example: https://wordpress.org/plugins/admin-menu-editor/
 */
class Menu
{
	public function __construct()
	{
		$this->addHooks();
		$this->addAdminMenuSeperator();
		$this->changeAdminMenuItems();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	private function addHooks()
	{
		add_action('wp_before_admin_bar_render', [$this, 'removeAdminBarItems']);
	}

	/**
	 * Function to add a white separator on the a given position in the admin side menu.
	 */
	public function addAdminMenuSeperator()
	{
		global $menu;


		unset($menu[4], $menu[30], $menu[59], $menu[99]); // Remove the seperators so we can reset the count.
		$seperators = [44.9, 49.9, 59.9];

		foreach ($seperators as $key => $seperator) {
			$menu[$seperator] = ['', 'read', 'separator' . $key, '', 'wp-menu-separator'];
		}

		ksort($menu);
	}

	/**
	 * This helper function is used in the addAdminMenuSeperator() function to replace certain admin menu items
	 *
	 * @param $oldPosition
	 * @param $newPosition
	 */
	private function adminMenuCount($oldPosition, $newPosition)
	{
		global $menu;

		$menu[$newPosition] = $menu[$oldPosition];
		unset($menu[$oldPosition]);
	}

	/**
	 * Change the order of several menu items.
	 */
	public function changeAdminMenuItems()
	{
		global $menu;
		global $submenu;
		$acfOptions = 0; // Count how many acf option pages there are.

		foreach ($menu as $key => $item) {
			switch ($item[2]) {
				case 'upload.php': // Change the position of media
					$this->adminMenuCount($key, 46);
					break;
				case 'gf_edit_forms': // Change the position of gravityforms
					$this->adminMenuCount($key, 47);
					break;
				case 'users.php': // Change the position of users
					$this->adminMenuCount($key, 50);
					break;
				case 'wpseo_dashboard': // Change the position of users
					$this->adminMenuCount($key, 51);
					break;
				case 'acf-options': // Change the position of the acf options
					$this->adminMenuCount($key, 52 + $acfOptions);
					$acfOptions++;
					break;
			}
		}

		ksort($menu);
	}

	/**
	 * Remove default admin bar menu items.
	 */
	public function removeAdminBarItems()
	{
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('search');
		$wp_admin_bar->remove_node('themes');
		$wp_admin_bar->remove_node('menus');
		$wp_admin_bar->remove_node('view-site');
	}
}
<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedMenu
 *
 * This class is responsible for removing / editing the meta boxes.
 */
class Menu
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
		// Change the menu
		add_action('wp_before_admin_bar_render', [$this, 'removeAdminBarItems']);
		add_action('admin_init', [$this, 'addAdminMenuSeperator'], 5);
		add_action('admin_init', [$this, 'changeAdminMenuItems'], 1);
	}

	/**
	 * Function to add a white separator on the a given position in the admin side menu.
	 */
	public function addAdminMenuSeperator()
	{
		global $menu;

		unset($menu[4]); // Remove the first seperator
		unset($menu[59]); // Remove the second seperator so we can reset the count

		$seperators = [49, 59];

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
				case 'themes.php': // Remove the appearence menu item and add the menus in the main menu
					foreach ($submenu['themes.php'] as $subItem) {
						if ($subItem[2] === 'nav-menus.php') {
							$menu[50] = $subItem;
							$menu[50][] = '';
							$menu[50][] = 'menu-top menu-icon-appearance menu-top-first';
							$menu[50][] = 'menu-appearance';
							$menu[50][] = 'dashicons-menu';
						}
					}
					unset($menu[$key]);
					break;
				case 'upload.php': // Change the position of media
					$this->adminMenuCount($key, 51);
					break;
				case 'gf_edit_forms': // Change the position of gravityforms
					$this->adminMenuCount($key, 52);
					break;
				case 'acf-options': // Change the position of the acf options
					$this->adminMenuCount($key, 53 + $acfOptions);
					$acfOptions++;
					break;
				case 'users.php': // Change the position of gravityforms
					$this->adminMenuCount($key, 58);
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
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('customize');
		$wp_admin_bar->remove_menu('search');

		$wp_admin_bar->remove_node('dashboard');
		$wp_admin_bar->remove_node('themes');
		$wp_admin_bar->remove_node('menus');
	}
}
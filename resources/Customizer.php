<?php

namespace EnhancedWPAdmin;

/**
 * Class Customizer
 *
 * Clients don't need this. We professionals take care of all the sweet stuff ;)
 */
class Customizer
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
		// Drop some customizer actions
		remove_action('plugins_loaded', '_wp_customize_include', 10);
		remove_action('admin_enqueue_scripts', '_wp_customize_loader_settings', 11);

		add_action('load-customize.php', [$this, 'disableCustomizer']);
		add_action('wp_before_admin_bar_render', [$this, 'removeAdminBarItems']);
		add_filter('map_meta_cap', [$this, 'removeCustomizer'], 10, 2);
	}

	/**
	 * Change the menu items
	 */
	private function changeMenuItems()
	{
		global $menu;
		global $submenu;

		foreach ($submenu['themes.php'] as $subItem) {
			if ($subItem[2] === 'nav-menus.php') {
				$menu[45] = $subItem;
				$menu[45][] = '';
				$menu[45][] = 'menu-top menu-icon-appearance menu-top-first';
				$menu[45][] = 'menu-appearance';
				$menu[45][] = 'dashicons-menu';

				ksort($menu);
			}
		}

		remove_menu_page('themes.php');
	}

	/**
	 * Manually overriding specific Customizer behaviors
	 */
	public function disableCustomizer()
	{
		wp_die(__('The Customizer is currently disabled.'));
	}

	/**
	 * Remove default admin bar menu items.
	 */
	public function removeAdminBarItems()
	{
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('customizer');
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
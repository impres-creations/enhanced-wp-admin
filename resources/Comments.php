<?php

namespace EnhancedWPAdmin;

/**
 * Class Comments
 *
 * Comments are mostly for russian spam.
 * We don't need viagra, so we're disabling them.
 */
class Comments
{
	public function __construct()
	{
		$this->addHooks();
		$this->changeMenuItems();
		$this->disableComments();
		$this->removeCommentsForDefaultPostTypes();
	}

	/**
	 * Make sure all hooks are being executed.
	 */
	private function addHooks()
	{
		add_action('wp_before_admin_bar_render', [$this, 'removeAdminBarItems']);
		add_action('do_meta_boxes', [$this, 'removeMetaBoxes']);
		add_filter('wp_headers', [$this, 'removeXPingback']);
	}

	/**
	 * Change the menu items
	 */
	private function changeMenuItems()
	{
		// Remove the pages from the menu's
		remove_menu_page('edit-comments.php');
		remove_submenu_page('options-general.php', 'options-discussion.php');
	}

	/**
	 * Make sure we don't see the comments in the menu
	 */
	private function disableComments()
	{
		global $pagenow;

		// Die if visited
		if ($pagenow === 'comment.php' || $pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
			wp_die(__('Comments are closed.'), '', ['response' => 403]);
		}
	}

	/**
	 * Remove default admin bar menu items.
	 */
	public function removeAdminBarItems()
	{
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu('comments');
	}

	/**
	 * Remove comments for the default post types
	 */
	private function removeCommentsForDefaultPostTypes()
	{
		remove_post_type_support('page', 'comments');
		remove_post_type_support('post', 'comments');
	}

	/**
	 * Remove all the meta boxes we don't use.
	 *
	 * @param $screen
	 */
	public function removeMetaBoxes($screen)
	{
		remove_meta_box('commentsdiv', $screen, 'normal');
		remove_meta_box('commentstatusdiv', $screen, 'normal');
	}

	/**
	 * Remove xpingback header
	 *
	 * @param $headers
	 * @return mixed
	 */
	public function removeXPingback($headers)
	{
		unset($headers['X-Pingback']);

		return $headers;
	}
}
<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedComments
 *
 * Comments are mostly spamming our websites. Not a lot of WordPress sites use comments, so we're disabling them.
 */
class Comments
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
		add_action('admin_menu', [$this, 'disableComments']);
		add_action('do_meta_boxes', [$this, 'removeMetaBoxes']);
		add_action('init', [$this, 'removeCommentsForDefaultPostTypes']);
		add_filter('wp_headers', [$this, 'removeXPingback']);
	}

	/**
	 * Make sure we don't see the comments in the menu
	 */
	public function disableComments()
	{
		global $pagenow;

		if ($pagenow === 'comment.php' || $pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
			wp_die(__('Comments are closed.'), '', ['response' => 403]);
		}

		remove_menu_page('edit-comments.php');
		remove_submenu_page('options-general.php', 'options-discussion.php');
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
	 * Remove comments for the default post types
	 */
	public function removeCommentsForDefaultPostTypes(){
		remove_post_type_support('page', 'comments');
		remove_post_type_support('post', 'comments');
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
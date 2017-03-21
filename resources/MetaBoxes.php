<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedMetaBoxes
 *
 * this class is responsible for removing / editing the meta boxes
 */
class MetaBoxes
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
		add_action('do_meta_boxes', [$this, 'removeMetaBoxes']);

		if (class_exists('WPSEO_Metabox')) {
			add_filter('wpseo_metabox_prio', [$this, 'changeWPSeoPriority'], 10);
		}
	}

	/**
	 * Remove all the meta boxes we don't use.
	 *
	 * @param $screen
	 */
	public function removeMetaBoxes($screen)
	{
		/*
		 * Remove all default meta boxes that we don't use.
		 */
		remove_meta_box('postcustom', $screen, 'normal');
		remove_meta_box('slugdiv', $screen, 'normal');
		remove_meta_box('authordiv', $screen, 'normal');
		remove_meta_box('revisionsdiv', $screen, 'normal');

		/*
		 * Remove the Member plugin meta box.
		 */
		if (class_exists('Members_Plugin')) {
			remove_meta_box('members-cp', $screen, 'advanced');
		}

		/*
		 * Remove the WPML config meta box because we want to edit this in the config screen.
		 */
		if (class_exists('SitePress')) {
			remove_meta_box('icl_div_config', $screen, 'advanced');
		}

		/*
		 * Remove the Relevanssi meta box because most of the times this isn't used.
		 * Remove these lines in the rare case we do need it.
		 */
		if (function_exists('relevanssi_premium_init')) {
			remove_meta_box('relevanssi_hidebox', $screen, 'advanced');
		}
	}

	/**
	 * Move the WP Seo Meta Box down
	 *
	 * @param $priority
	 * @return string
	 */
	public function changeWPSeoPriority($priority)
	{
		$priority = 'low';
		return $priority;
	}
}
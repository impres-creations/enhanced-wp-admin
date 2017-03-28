<?php

namespace EnhancedWPAdmin;

/**
 * Class EnhancedWPAdmin
 *
 * The Class that makes the magic.
 */
class Init
{
	public function __construct()
	{
		$this->addHooks();
	}

	/**
	 * Make sure all hooks are being executed.
	 * Load this hook on 20, so filters will work by default
	 */
	private function addHooks()
	{
		add_action('admin_init', [$this, 'loadClasses'], 20);
	}

	/**
	 * This function will load all the availabl classes
	 * If you don't want to use a class / part of the plugin you can turn it by adding a filter.
	 * You can add a filter prepended with enhanced follow by the Classname (case sensitive)
	 *
	 * @example: add_filter('enhancedMetaBoxes', '__return_false');
	 */
	public function loadClasses()
	{
		// Put all classes that we need to load in an array
		$classes = [
			'Comments',
			'Customizer',
			'Dashboard',
			'MetaBoxes',
			'Menu',
			'UI',
			'Help',
		];

		// Loop trough all the classes
		foreach ($classes as $class) {
			$loadClass = true; // Default to True
			$loadClass = apply_filters('enhanced' . $class, $loadClass); // Apply the filters

			// Check if we do actually want to load the class
			if ($loadClass) {
				$class = "EnhancedWPAdmin\\$class";
				new $class();
			}
		}
	}
}
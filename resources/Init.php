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
		new Comments();
		new Customizer();
		new Dashboard();
		new MetaBoxes();
		new Menu();
		new Styles();
		new Growl();
		new Help();
	}
}
<?php
/*
Plugin Name: Enhanced WP Admin
Plugin URI: https://github.com/DannyvanHolten/enhanced-wp-admin
Description: Clean up your WordPress admin with improvements designed to improve UI experience
Version: 0.1
Author: Danny van Holten
Author URI: http://www.dannyvanholten.com/
Copyright: Danny van Holten
*/

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

define('ENHANCED_WP_ADMIN_VERSION', 0.1);
define('ENHANCED_WP_ADMIN_ASSETS', plugin_dir_url(__FILE__) . 'dist/');
define('ENHANCED_WP_ADMIN_RESOURCES', __DIR__ . '/resources/');


require_once __DIR__ . '/vendor/composer/autoload.php';

new \EnhancedWPAdmin\Init();
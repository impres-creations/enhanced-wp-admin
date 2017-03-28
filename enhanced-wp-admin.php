<?php
/*
Plugin Name: Enhanced WP Admin
Plugin URI: https://github.com/DannyvanHolten/enhanced-wp-admin
Description: Clean up your WordPress admin with improvements designed to improve UI experience
Version: 0.8
Author: Danny van Holten
Author URI: http://www.dannyvanholten.com/
Copyright: Danny van Holten
*/

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

// Define multiple necessary constants
define('ENHANCED_WP_ADMIN_VERSION', 0.8);
define('ENHANCED_WP_ADMIN_TEXTDOMAIN', 'enhanced-wp-admin');
define('ENHANCED_WP_ADMIN_LANGUAGES', dirname(plugin_basename(__FILE__)) . '/languages/');

define('ENHANCED_WP_ADMIN_ASSETS', plugin_dir_url(__FILE__));
define('ENHANCED_WP_ADMIN_RESOURCES', __DIR__ . '/resources/');

// Use composer to autoload our classes
require_once __DIR__ . '/vendor/autoload.php';

new EnhancedWPAdmin\Init();
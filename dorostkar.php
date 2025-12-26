<?php

use function Dorostkar\WPLite\appLogger;

/**
 * Plugin Name: درست‌کار - دستیار هوشمند فروش
 * Description: ماژول هوش مصنوعی برای بهینه‌سازی فروش ووکامرس
 * Version: 1.0
 * Author: Hesam
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Text Domain: dorostkar
 */

if (!defined('ABSPATH')) exit;

/**
 * AI Agent Module Master Switch
 * Set to false to completely disable the AI Agent module (menus, settings, everything)
 */
if (!defined('DOROSTKAR_AIAGENT_ENABLED')) {
    define('DOROSTKAR_AIAGENT_ENABLED', true); // Disabled by default - change to true to enable
}

// Autoloader will be set up after WPLite installation
require __DIR__ . '/vendor/autoload.php';

use Dorostkar\WPLite\Facades\App;
App::setPluginFile(__FILE__);
App::setPluginPath(plugin_dir_path(__FILE__));
appLogger('booting dorostkar');
App::boot();

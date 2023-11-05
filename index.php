<?php
/**
 * Plugin Name: Search and replace post
 * Description: search and replace post
 * Plugin URI:  https://github.com/AlexShevchenko1985
 * Author URI:  https://github.com/AlexShevchenko1985
 * Author:      AlexShevchenko1985
 * Version:     0.1
 *
 * Text Domain: src
 * Requires PHP: 7.4
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// PLUGIN SETUP

/**
 * PSR-4 class autoloader
 */
if (file_exists(__DIR__ . "/" . "vendor/autoload.php")) {

    require_once __DIR__ . "/" . "vendor/autoload.php";
} else {
    error_log("Please, install composer dependencies in a theme directory: " . __DIR__);
}

define('SRP_PLUGIN_FILE', __FILE__);
define('SRP_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('SRP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SRP_PLUGIN_URL', plugin_dir_url(__FILE__));

use App\PluginInitialize;
$theme = PluginInitialize::getInstance();


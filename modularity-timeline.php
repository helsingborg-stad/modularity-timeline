<?php

/**
 * Plugin Name:       Modularity Timeline
 * Plugin URI:        https://github.com/helsingborg-stad/modularity-timeline.git
 * Description:       A module to display a timeline.
 * Version: 2.0.0
 * Author:            Jonatan Hanson
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-timeline
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (!defined('WPINC')) {
    die;
}

define('MODULARITY_TIMELINE_PATH', plugin_dir_path(__FILE__));
define('MODULARITY_TIMELINE_URL', plugins_url('', __FILE__));
define('MODULARITY_TIMELINE_VIEW_PATH', MODULARITY_TIMELINE_PATH . 'views/');
define('MODULARITY_TIMELINE_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('MODULARITY_TIMELINE_MODULE_PATH', MODULARITY_TIMELINE_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-timeline', false, plugin_basename(dirname(__FILE__)) . '/languages');

// Autoload from plugin
if (file_exists(MODULARITY_TIMELINE_PATH . 'vendor/autoload.php')) {
    require_once MODULARITY_TIMELINE_PATH . 'vendor/autoload.php';
}
require_once MODULARITY_TIMELINE_PATH . 'Public.php';

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-timeline');
    $acfExportManager->setExportFolder(MODULARITY_TIMELINE_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'timeline' => 'group_59ede2f88a7b5'
    ));
    $acfExportManager->import();
}); 

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-timeline'] = MODULARITY_TIMELINE_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new ModularityTimeline\App();

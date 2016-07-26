<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.optimizepress.com/
 * @since             1.0.0
 * @package           Op_ConverKit_Fix
 *
 * @wordpress-plugin
 * Plugin Name:       OptimizePress Convert kit fix
 * Plugin URI:        http://www.optimizepress.com/
 * Description:       Removing append_form filter from LiveEditor Pages that caused multiple form rendering
 * Version:           1.0.0
 * Author:            OptimizePress
 * Author URI:        http://www.optimizepress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       op-convertkit-fix
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('init', 'opRemoveConvertKitAction',10);

if (!function_exists("opRemoveConvertKitAction")){
    function opRemoveConvertKitAction(){
        $checkIfLEPage = get_post_meta(url_to_postid("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),'_optimizepress_pagebuilder', true);

        $pageBuilder = false;
        if (isset($_GET['page'])) {
            $pageBuilder = ($_GET['page'] == 'optimizepress-page-builder') ? true : false;
        }
        $liveEditorAjaxInsert = false;
        if (isset($_REQUEST['action'])) {
            $liveEditorAjaxInsert = ($_REQUEST['action'] == 'optimizepress-live-editor-parse') ? true : false;
        }

        //FRONTEND
        if ($checkIfLEPage == 'Y') {
            remove_filter('the_content', array('WP_ConvertKit', 'append_form'));
        }

        //LIVE EDITOR
        if ($pageBuilder || $liveEditorAjaxInsert) {

        }
    }
}

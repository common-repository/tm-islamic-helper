<?php
/**
 * Plugin Name:TM Islamic Helper
 * Plugin URI:: http://tmc.templines.org/ihsan/tm-islamic-helper/
 * Description: Islamic Helper plugin for muslims prayer times. Don't delete this plugin.
 * Version: 1.0.1
 * Author: Templines
 * Author URI: http://templines.com/
 * License: GPL v2
 */

/**====================================================================
==  Make sure we don't expose any info if called directly
====================================================================*/
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**====================================================================
==  Load Text domain
====================================================================*/
add_action('plugins_loaded', 'tmpray_islamic_helper_load_textdomain');
function tmpray_islamic_helper_load_textdomain() {
    load_plugin_textdomain( 'tmpray-islamic-helper', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

defined('TMPRAY_HELPING_PLUGIN_VERSION' )   or define( 'TMPRAY_HELPING_PLUGIN_VERSION', '1.0');
defined('TMPRAY_THEME_HELPER_ROOT_DIR' )    or define( 'TMPRAY_THEME_HELPER_ROOT_DIR', plugins_url() . '/tm-islamic-helper');
defined('TMPRAY_HELPING_PREVIEW_IMAGE')     or define( 'TMPRAY_HELPING_PREVIEW_IMAGE', plugin_dir_url(__FILE__) . '/assets/images/presentation-images');
defined('TMPRAY_THEME_HELPER_URL' )         or define( 'TMPRAY_THEME_HELPER_URL', plugin_dir_url( __FILE__ ));

/**====================================================================
==  Require Fl theme
====================================================================*/

if( !class_exists('TMPRAY_Islamic_Helping_Addons') ) {

    class TMPRAY_Islamic_Helping_Addons {

        // Construct
        public function __construct() {

            add_action( 'plugins_loaded', array($this,'tmpray_islamic_helper_load_textdomain') );

            /** Namaz Time Taxonomy*/
            require_once('custom_taxonomy/namaz-time.php');
            /** Hijri Calendar*/
            require_once ('function/hijri_date.php');
            /** Dashboard*/
            require_once ('dashboard/dashboard.php');

        }

/*
 *  Load plugin textdomain.
 * */
        public function tmpray_islamic_helper_load_textdomain() {
            load_plugin_textdomain( 'tmpray-islamic-helper', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
        }

    } // end of class
    $TMPRAY_Islamic_Helping_Addons = new TMPRAY_Islamic_Helping_Addons();

} // end of class_exists






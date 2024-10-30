<?php
/*
Plugin Name: Bottom fixed window
Plugin URI: http://wp.cancms.com/cancms-wp-float-bar-188
Description: Use the Bottom fixed window to create a sticky bar at the page bottom that can display your ads or form to interact with user.
Text Domain: cancms-float-bar
Author: wp.cancms.com
Version: 1.0
Author URI: http://wp.cancms.com/
*/


require_once 'vendor/autoload.php';





//if ( class_exists('CancmsFloatBar', false) ) {
//    return;
//} // if class is allready loaded return control to the main script


// if the plugin is registered, skip
if (defined('CANCMS_FLOATBAR_PLUGIN')) {
    return true;
}

// define the plugin name, the same as the folder name
define('CANCMS_FLOATBAR_PLUGIN', 'cancms-float-bar');


//： /wp-content/plugins/cancms-float-bar/
define('CANCMS_FLOATBAR_PLUGIN_ABSPATH', plugin_dir_path(__FILE__));


//:   /wp-content/plugins/cancms-float-bar
define('CANCMS_FLOATBAR_PLUGIN_URL', plugins_url('', __FILE__));



class CancmsFloatBar { // Plugin class
	
	const ID = 'cancms_float_bar';
	
	const VERSION = '1.0';


	public function __construct() {
    }

    // entrance init
    public static function init () {

	    self::initLanguages();

	    if (is_admin() ) {
            CancmsPlugin\Admin\Hooks::init();
        } else {
            CancmsPlugin\Front\Hooks::init();
        }

    }

    // register hook
    public static function initFnRegister() {
        add_action('init', array( CancmsFloatBar::class, 'init' )); // Main Hook
    }


    // init languages
    public static function initLanguages () {
        add_action('plugins_loaded',  function () {
            load_plugin_textdomain( CANCMS_FLOATBAR_PLUGIN, false, basename( dirname( __FILE__ ) ) . '/lang/' );
        });
    }

}

CancmsFloatBar::initFnRegister();





<?php // plugin uninstall script

require_once 'vendor/autoload.php';

use CancmsPlugin\Admin\BottomBar;


if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit(); // if uninstall not called from WordPress exit

$option_name = 'cancms-float-bar';

if ( !is_multisite() ) { // For Single site
	
	delete_option( $option_name );

	// remove the options in db
    BottomBar::removeOptions();

} else { // For Multisite
	
	/*global $wpdb;
	
	*/

}
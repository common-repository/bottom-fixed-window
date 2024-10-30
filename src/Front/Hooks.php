<?php

namespace CancmsPlugin\Front;


class Hooks
{
    public static function init() {
        // Runs when the template calls the wp_footer function,
        // generally near the bottom of the blog page.

        self::pluginLoadCssJs();


        add_action('wp_footer', array(FloatBar::class, 'registerWpFooter'));
    }


    public static function pluginLoadCssJs() {
        // depended on jquery, which means jquery is required
        wp_register_script( 'cancms_front_js', CANCMS_FLOATBAR_PLUGIN_URL . '/js/front.js', array('jquery') );

        wp_register_style( CANCMS_FLOATBAR_PLUGIN . '_CSS', CANCMS_FLOATBAR_PLUGIN_URL . '/css/front.css');


        if ( !is_admin() ) { /** Load Scripts and Style on Website Only */
             wp_enqueue_script( 'cancms_front_js' );
            wp_enqueue_style( CANCMS_FLOATBAR_PLUGIN  . '_CSS');

        }
    }

}
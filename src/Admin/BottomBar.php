<?php

namespace CancmsPlugin\Admin;

use CancmsPlugin\Lib\View;

class BottomBar
{
    private $cancmsFloatBarSettingGroup = 'cancmsFloatBar-settingGroup';
    public static $bottomBarOptions = [
        'bar_height' => 'cancms_bottom_bar_height',
        'bar_content' => 'cancms_bottom_bar_html_content',
    ];

    public function __construct() {
    }

    // register wp_footer hook
    public static function registerAdminMenu () {
        $floatBar = new BottomBar();

        add_action( 'admin_menu', array($floatBar, 'addAdminMenu'), 12 );

        // 调用注册设置函数
        add_action( 'admin_init', array($floatBar, 'registerOptionSettings') );

    }



    public function registerOptionSettings() {
        register_setting( $this->cancmsFloatBarSettingGroup, self::$bottomBarOptions['bar_height'] );
        register_setting( $this->cancmsFloatBarSettingGroup, self::$bottomBarOptions['bar_content'] );
    }

    public function outputBottomBarPage () {
        $data = [
            'cancmsFloatBarSettingGroup' => $this->cancmsFloatBarSettingGroup,
            'options' => self::$bottomBarOptions
        ];

        $content = View::renderHtml('admin/bottom-bar.phtml', $data);

        echo $content;
    }

    public function addAdminMenu () {
        // get the last menu position
        global $_wp_last_object_menu;

        $trDomain = CANCMS_FLOATBAR_PLUGIN;
        $menuSlug = 'cancms_float_bar';
        $_wp_last_object_menu++;

        add_menu_page(
            __( 'Cancsm Float Bar',  $trDomain),
            __( 'Cancms Bar', $trDomain ),
            'administrator', $menuSlug,
            array($this, 'outputBottomBarPage'), 'dashicons-feedback',
            $_wp_last_object_menu
        );

//        add_submenu_page( $menuSlug,
//            __( 'Bottom bar', $trDomain),
//            __( 'Bottom bar', $trDomain ),
//            'administrator', $menuSlug . '_bottom',
//            array($this, 'outputBottomBarPage') );

    }




    // called when uninstalling
    public static function removeOptions () {
        foreach (self::$bottomBarOptions as $key => $optionName) {
            delete_option($optionName);
        }
    }


}
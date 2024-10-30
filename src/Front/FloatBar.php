<?php

namespace CancmsPlugin\Front;

use CancmsPlugin\Lib\View;
use CancmsPlugin\Admin\BottomBar;

class FloatBar
{

    public function __construct() {
    }

    // register wp_footer hook
    public static function registerWpFooter () {
        $floatBar = new FloatBar();
        $floatBar->outputBottomBar();
    }

    public function outputBottomBar () {
        echo $this->createBottomBar();
    }

    private function createBottomBar () {

        $divStyle = $this->parseBarStyle(get_option(BottomBar::$bottomBarOptions['bar_height']));
        $barContent = $this->parseBarContent(get_option(BottomBar::$bottomBarOptions['bar_content']));

        $data = [
            'divStyle' => $divStyle,
            'barContent' => $barContent,
        ];

        $content = View::renderHtml('front/bottom-bar.phtml', $data);

        return $content;
    }

    private function parseBarStyle ($strStyle) {

        return $strStyle;
    }
    private function parseBarContent ($content) {
        return do_shortcode($content);
    }


}
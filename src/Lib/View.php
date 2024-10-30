<?php

namespace CancmsPlugin\Lib;


class View
{
    protected $data = [];
    private static $instance = null;

    public function __construct() {
    }


    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new View();
        }
        return self::$instance;
    }

    public static function renderHtml ($templateFile, $vars = [], $useRelativePath = true, $newView = true) {

        if ($newView == true) {
            $view = new View();
        } else {
            $view = self::instance();
        }

        $content = $view->render($templateFile, $vars, $useRelativePath);
        return $content;
    }





    public function render($templateFile, $vars = [], $useRelativePath = true) {

        ob_start();
        $vars = array_merge($vars, $this->data);
        extract($vars);

        // relative to the plugin folder
        if ($useRelativePath == true) {
            // /wp-content/plugins/cancms-float-bar/
            $templateFile = CANCMS_FLOATBAR_PLUGIN_ABSPATH . "tpl/$templateFile";
        }

        // showme($templateFile);

        if(file_exists($templateFile)) {
            require($templateFile);
        }


        return ob_get_clean();
    }


    public function assign($key, $val = '') {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key); // key is array
        } else {
            $this->data[$key] = $val; // key is string
        }

    }
}
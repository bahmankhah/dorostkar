<?php

namespace Dorostkar\WPLite;

use Dorostkar\WPLite\Facades\App;

class Config{

    public static function load(){
        $files = glob(App::pluginPath() . 'configs/*.php');
        $configs = [];
        foreach ($files as $file) {
            $configs[basename($file, '.php')] = require_once($file);
        }
        $GLOBALS[md5(App::pluginPath()).'_wplite_configs'] = $configs;
    }
    
    public static function get($configName, $default = null){
        return $GLOBALS[md5(App::pluginPath()).'_wplite_configs'][$configName] ?? $default;
    }
    
}
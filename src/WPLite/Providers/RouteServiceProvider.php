<?php

namespace Dorostkar\WPLite\Providers;
use Dorostkar\WPLite\Facades\App;
use Dorostkar\WPLite\Facades\Route;
use Dorostkar\WPLite\Provider;

class RouteServiceProvider extends Provider
{
    public function onInit()
    {
        if (is_admin()) {
            Route::loadRoutesFile(App::pluginPath() . 'routes/admin.php');
        }
        
        if (wp_doing_ajax()) {
            Route::loadRoutesFile(App::pluginPath() . 'routes/ajax.php');
        }
        Route::loadRoutesFile(App::pluginPath() . 'routes/web.php');

        Route::loadRoutesFile(App::pluginPath() . 'routes/rest.php');
    }
}

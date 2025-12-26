<?php

namespace Dorostkar\WPLite\Facades;

use Dorostkar\WPLite\Application;

/**
 * @method static \Dorostkar\WPLite\Application make($class, array $params = [])
 * @see \Dorostkar\WPLite\Application
**/
class App extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Application::class;
    }
}
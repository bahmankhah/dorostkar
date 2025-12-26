<?php

namespace Dorostkar\WPLite\Facades;

class Route extends Facade{

    protected static function getFacadeAccessor() {
        return \Dorostkar\WPLite\RouteManager::class;
    }
}
<?php

namespace Dorostkar\WPLite\Facades;

class View extends Facade{

    protected static function getFacadeAccessor() {
        return \Dorostkar\WPLite\ViewManager::class;
    }
}
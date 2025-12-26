<?php

namespace Dorostkar\WPLite\Facades;

class Config extends Facade{

    protected static function getFacadeAccessor() {
        return \Dorostkar\WPLite\Config::class;
    }
}
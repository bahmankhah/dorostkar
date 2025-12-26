<?php

namespace Dorostkar\WPLite\Facades;

class Wordpress extends Facade{

    protected static function getFacadeAccessor() {
        return \Dorostkar\WPLite\WordpressManager::class;
    }
}
<?php

namespace Dorostkar\WPLite\Facades;

use Dorostkar\WPLite\Cache\CacheManager;


/**
 * @method static \Dorostkar\WPLite\Application make($class, array $params = [])
 * @see \Dorostkar\WPLite\Application
**/
class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CacheManager::class;
    }
}
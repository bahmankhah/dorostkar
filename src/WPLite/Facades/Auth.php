<?php

namespace Dorostkar\WPLite\Facades;

use Dorostkar\WPLite\Application;
use Dorostkar\WPLite\Auth\AuthManager;

/**
 * @method static \Dorostkar\WPLite\Application make($class, array $params = [])
 * @see \Dorostkar\WPLite\Application
**/
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AuthManager::class;
    }
}
<?php

namespace Dorostkar\WPLite\Cache;

use Dorostkar\WPLite\Adapters\AdapterManager;


class CacheManager extends AdapterManager
{

    public function getKey(): string{
        return 'cache';
    }

}

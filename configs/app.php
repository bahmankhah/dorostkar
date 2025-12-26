<?php

use Dorostkar\Providers\AppServiceProvider;


return [
    'global_middlewares'=>[

    ],
    'providers'=>[
        AppServiceProvider::class,
    ],
    'version'=>'v1',
    'name'=>'donapp-core',
    'url'=>getenv('APP_URL'),
    'api'=> [
        'namespace'=>'dorostkar/v1',
    ],
];
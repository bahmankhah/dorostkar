<?php

namespace Dorostkar\WPLite\Middlewares;
use Dorostkar\WPLite\Contracts\Middleware;
use Dorostkar\WPLite\Pipeline;
use Dorostkar\WPLite\Facades\App;
class AppMiddleware implements Middleware{
    public function handle($request,Pipeline $pipeline){
        App::setRequest($request);
        return $pipeline->next($request);
    }
}

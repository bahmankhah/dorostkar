<?php

namespace Dorostkar\WPLite\Contracts;

use Dorostkar\WPLite\Pipeline;

interface Middleware {
    public function handle($request, Pipeline $pipeline);
}
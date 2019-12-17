<?php

namespace Hogus\LaravelMiniProgram\Facade;

use Illuminate\Support\Facades\Facade;

class Miniprogram extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'miniprogram';
    }
}

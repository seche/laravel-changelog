<?php

namespace Seche\LaravelChangelog\Facades;

use Illuminate\Support\Facades\Facade;

class Version extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'version';
    }
}


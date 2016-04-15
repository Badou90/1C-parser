<?php

namespace Badou\Parser\Facades;

use Illuminate\Support\Facades\Facade;
use Badou\Parser\Parser;

class ParserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Parser::class;
    }
}

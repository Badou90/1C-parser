<?php

namespace Badou\Parser\Mappers;

use Badou\Parser\Contracts\ParamsMapperInterface;

class ParamsMapper implements ParamsMapperInterface
{
    public function parse($offer)
    {
        echo self::class." - base mapper\n";
    }
}

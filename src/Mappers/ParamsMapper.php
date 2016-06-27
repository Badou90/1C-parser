<?php

namespace Badou\Parser\Mappers;

class ParamsMapper implements ParamsMapperInterface
{
    public function parse($offer)
    {
        echo self::class." - base mapper\n";
    }
}

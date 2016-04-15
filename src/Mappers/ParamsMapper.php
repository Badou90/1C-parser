<?php

namespace Badou\Parser\Mappers;

class ParamsMapper implements MapperInterface
{
    public function parse($offer)
    {
        echo get_class($this)."\n";
    }
}

<?php

namespace Badou\Parser\Mappers;

class ItemsMapper implements MapperInterface
{
    public function parse($import)
    {
        echo get_class($this)."\n";
    }
}

<?php

namespace Badou\Parser\Mappers;

class ParamsMapper implements MapperInterface
{
    public function parse()
    {
        echo get_class($this)."\n";
    }
}

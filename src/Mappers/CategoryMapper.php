<?php

namespace Badou\Parser\Mappers;

class CategoryMapper implements MapperInterface
{
    public function parse()
    {
        echo get_class($this)."\n";
    }
}

<?php

namespace Badou\Parser;

use Badou\Parser\Mappers\CategoryMapper;
use Badou\Parser\Mappers\ItemsMapper;
use Badou\Parser\Mappers\ParamsMapper;

class Parser
{
    protected $import = null;
    protected $offer = null;

    protected $categoryMapper = null;
    protected $itemsMapper = null;
    protected $paramsMapper = null;

    public function __construct(CategoryMapper $categoryMapper, ItemsMapper $itemsMapper, ParamsMapper $paramsMapper)
    {
        if (!is_file(config('parser.files.import'))) {
            throw new \Exception("file {$import_file} not found");
        }

        if (!is_file(config('parser.files.offers'))) {
            throw new \Exception("file {$offer_file} not found");
        }

        $this->import = new \SimpleXMLElement(file_get_contents(config('parser.files.import')));
        $this->offer = new \SimpleXMLElement(file_get_contents(config('parser.files.offers')));

        $this->categoryMapper = $categoryMapper;
        $this->itemsMapper = $itemsMapper;
        $this->paramsMapper = $paramsMapper;
    }

    public function parse()
    {
        $this->categoryMapper->parse($this->import);
        $this->itemsMapper->parse($this->import);
        $this->paramsMapper->parse($this->offer);
    }
}

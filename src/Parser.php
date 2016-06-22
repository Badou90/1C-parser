<?php

namespace Badou\Parser;

use Badou\Parser\Mappers\CategoryMapper;
use Badou\Parser\Mappers\ItemsMapper;
use Badou\Parser\Mappers\ParamsMapper;
use Badou\Parser\Exceptions\FileNotFoundException;

class Parser
{
    protected $import = null;
    protected $offer = null;

    protected $categoryMapper = null;
    protected $itemsMapper = null;
    protected $paramsMapper = null;

    public function __construct(CategoryMapper $categoryMapper, ItemsMapper $itemsMapper, ParamsMapper $paramsMapper)
    {
        $import_file = config('parser.files.import');
        $offer_file = config('parser.files.offers');

        if (is_file($import_file)) {
            throw new FileNotFoundException("file \"{$import_file}\" not found");
        }

        if (!is_file($offer_file)) {
            throw new FileNotFoundException("file \"{$offer_file}\" not found");
        }

        $this->import = new \SimpleXMLElement(file_get_contents($import_file));
        $this->offer = new \SimpleXMLElement(file_get_contents($offer_file));

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

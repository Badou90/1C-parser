<?php

namespace Badou\Parser\Mappers;
use App\Models\CatalogCategory;

class CategoryMapper implements MapperInterface
{
    protected $model;

    public function __construct(CatalogCategory $categoryModel)
    {
        $this->model = $categoryModel;
    }

    public function parse($import)
    {
        dd($this->model);
        foreach ($import->Классификатор->Группы->Группа as $group) {
            echo $group->Наименование."\n";
        }
    }
}

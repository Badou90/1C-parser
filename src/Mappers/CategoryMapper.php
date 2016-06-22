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
        foreach ($import->Классификатор->Группы->Группа as $group) {
            $this->create($group);
        }
    }

    public function create($item, $parentId = 0)
    {
        $attributes = [
            'title' => $item->Наименование,
            'code' => $item->Ид,
            'parent_id' => $parentId,
        ];
        $category = $this->model->create($attributes);

        if(isset($item->Группы)) {
            foreach($item->Группы->Группа as $group) {
                $this->create($group, $category->id);
            }
        }

    }
}

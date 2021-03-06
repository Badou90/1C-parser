<?php

namespace Badou\Parser\Mappers;

use Badou\Parser\Contracts\CategoryMapperInterface;
use App\Models\CatalogCategory;

class CategoryMapper implements CategoryMapperInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new CatalogCategory();
    }

    public function parse($import)
    {
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // $this->model->truncate();
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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

        if($category = CatalogCategory::where('code', $item->Ид)->first()) {
            $category->update($attributes);
        } else {
            $category = $this->model->create($attributes);
        }

        if(isset($item->Группы)) {
            foreach($item->Группы->Группа as $group) {
                $this->create($group, $category->id);
            }
        }

    }
}

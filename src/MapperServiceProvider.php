<?php

namespace Badou\Parser;

use Illuminate\Support\ServiceProvider;
use Badou\Parser\Mappers\CategoryMapper;
use Badou\Parser\Mappers\ItemsMapper;
use Badou\Parser\Mappers\ParamsMapper;
use App\Models\CatalogCategory;


class MapperServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(CategoryMapper::class, function(){
            return new CategoryMapper(new CatalogCategory());
        });

        $this->app->bind(ItemsMapper::class, function(){
            return new ItemsMapper();
        });

        $this->app->bind(ParamsMapper::class, function(){
            return new ParamsMapper();
        });
    }
}

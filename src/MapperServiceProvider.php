<?php

namespace Badou\Parser;

use Illuminate\Support\ServiceProvider;
use Badou\Parser\Mappers\CategoryMapper;
use Badou\Parser\Mappers\ItemsMapper;
use Badou\Parser\Mappers\ParamsMapper;

class MapperServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(CategoryMapper::class, CategoryMapper::class);
        $this->app->bind(ItemsMapper::class, ItemsMapper::class);
        $this->app->bind(ParamsMapper::class, ParamsMapper::class);
    }
}

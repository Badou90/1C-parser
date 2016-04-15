<?php

namespace Badou\Parser;

use Illuminate\Support\ServiceProvider;
use Badou\Parser\Mappers\CategoryMapper;
use Badou\Parser\Mappers\ItemsMapper;
use Badou\Parser\Mappers\ParamsMapper;

class ParserServiceProvider extends ServiceProvider
{
    protected $commands = ['Parse'];

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/parser.php' => config_path('parser.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton(Parser::class, function($app) {
            return new Parser($app->make(CategoryMapper::class), $app->make(ItemsMapper::class), $app->make(ParamsMapper::class));
        });

        $this->registerCommands();
    }

    protected function registerCommands()
    {
        foreach ($this->commands as $command) {
            $this->commands('Badou\\Parser\\Commands\\'.ucfirst($command).'Command');
        }
    }
}

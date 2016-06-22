# 1C parser for Laravel

Parse your 1C database export files to Laravel project.

## Installation

First, require package with composer:

    composer require badou/parser

After, run `composer update` from your command line.

Add this lines to your `config/app.php` file providers section:

    Badou\Parser\MapperServiceProvider::class,
    Badou\Parser\ParserServiceProvider::class,

And this line to fasades section of `config/app.php` file:

    'Parser' => Badou\Parser\Facades\ParserFacade::class,

Finally, run `php artisan vendor:publish` from your command line to publish package configuration file and change path to parsing files in config file.

## Categories

If you choose to use default CategoryMapper, shipped with package, your Category model must have at least 3 fields - `title`, `code`, `parent_id`

## Running parser

To parse your files all you need is simply run `php artisan parse:file` from your command line

## Overriding mappers

By default you adding `MapperServiceProvider` with some basic parsing functions. If you wish to expand mappers you need to register new bindings in custom service provider.

    class CustomMapperServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->bind(CategoryMapper::class, function(){
                return new TestCategoryMapper();
            });

            $this->app->bind(ItemsMapper::class, function(){
                return new TestItemsMapper();
            });

            $this->app->bind(ParamsMapper::class, function(){
                return new TestParamsMapper();
            });
        }
    }

Then you can write your own code to parse your unique fields from xml file. Your custom mapper must extend one of three classes `CategoryMapper`, `ItemsMapper`, `ParamsMapper`:

    class TestCategoryMapper extends CategoryMapper
    {
        public function parse($data)
        {
            echo "Test category mapper\n";
        }
    }

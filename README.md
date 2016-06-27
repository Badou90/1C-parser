# 1C parser for Laravel

Parse your 1C database export files to Laravel project.

## Installation

First, require package with composer:

    composer require badou/parser

After, run `composer update` from your command line.

Add this package providers to your `config/app.php` file providers section:

    Badou\Parser\MapperServiceProvider::class,
    Badou\Parser\ParserServiceProvider::class,

And facades to fasades section of `config/app.php` file:

    'Parser' => Badou\Parser\Facades\ParserFacade::class,

Finally, run `php artisan vendor:publish` from your command line to publish package config file, then change path to parsing files in config file.

## Overriding mappers

Next step is extend mappers provided by package. You will need to register new bindings in custom service provider.

    class CustomMapperServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->bind(CategoryMapper::class, YourOwnCategoryMapper::class);

            $this->app->bind(ItemsMapper::class, YourOwnItemsMapper::class);

            $this->app->bind(ParamsMapper::class, YourOwnParamsMapper::class);
        }
    }

Then you can write your own code to parse your unique fields from xml file. Your custom mapper must implement one of three interfaces: `CategoryMapperInterface`, `ItemsMapperInterface`, `ParamsMapperInterface`

    class TestCategoryMapper implements CategoryMapperInterface
    {
        public function parse($data)
        {
            echo "Test category mapper\n";
        }
    }

## Running parser

To parse your files all you need is simply run `php artisan parse:file` from your command line

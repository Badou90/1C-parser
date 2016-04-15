<?php

namespace Badou\Parser\Commands;

use Illuminate\Console\Command;
use Parser;

class ParseCommand extends Command
{
    protected $signature = 'parse:file';

    protected $description = 'Starts parsing of the 1C database files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->line('Считываю записи...');

        Parser::parse();

        $this->info('Обработка базы закончена успешно');
    }
}

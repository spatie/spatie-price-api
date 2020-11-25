<?php

namespace Spatie\PriceApi\Commands;

use Illuminate\Console\Command;

class PriceApiCommand extends Command
{
    public $signature = 'spatie-price-api';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}

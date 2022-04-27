<?php

namespace Spatie\PriceApi\Tests;

use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\PriceApi\SpatiePriceApi;
use Spatie\Snapshots\MatchesSnapshots;

class SpatiePriceApiTest extends Orchestra
{
    use MatchesSnapshots;

    /** @test */
    public function it_can_process_a_response()
    {
        $response = file_get_contents(__DIR__. '/stubs/response.json');

        Http::fake([
            'spatie.be/*' => Http::response($response),
        ]);

        $priceInfo = SpatiePriceApi::getPriceForPurchasable(1, 'BE');

        $this->assertMatchesSnapshot($priceInfo);
    }
}

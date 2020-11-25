<?php

namespace Spatie\PriceApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\PriceApi\PriceApi
 */
class PriceApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'spatie-price-api';
    }
}

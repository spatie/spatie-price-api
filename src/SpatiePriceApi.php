<?php

namespace Spatie\PriceApi;

use Spatie\PriceApi\Dto\Discount;
use Spatie\PriceApi\Dto\Price;
use Cache;
use Illuminate\Support\Facades\Http;

class SpatiePriceApi
{
    public static function getPriceForPurchasable(int $purchasableId): ?array
    {
        $ip = request()->ip();

        $countryCode = FreeGeoIp::getCountryCodeForIp($ip);

        $response = Cache::remember("price-{$purchasableId}-{$countryCode}", 60, function () use ($purchasableId, $countryCode) {
            $response = Http::get("http://spatie.be.test/api/price/{$purchasableId}}/{$countryCode}");

            if (! $response->successful()) {
                return null;
            }

            return $response->json();
        });

        if (is_null($response) || ! array_key_exists('actual', $response)) {
            return [
                'couldFetchPrice' => false,
                'actual' => null,
                'withoutDiscount' => null,
                'discount' => null,
            ];
        }

        return [
            'couldFetchPrice' => true,
            'actual' => Price::createFromResponse($response['actual']),
            'withoutDiscount' => Price::createFromResponse($response['without_discount']),
            'discount' => Discount::createFromResponse($response['discount']),
        ];
    }
}

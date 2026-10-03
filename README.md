# The price API used at promotional sites for our own products

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/spatie-price-api.svg?style=flat-square)](https://packagist.org/packages/spatie/spatie-price-api)
![Tests](https://github.com/spatie/spatie-price-api/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/spatie-price-api.svg?style=flat-square)](https://packagist.org/packages/spatie/spatie-price-api)

This package can retrieve prices from the API at spatie.be. It is used at the promotional sites for [our own products](https://spatie.be/products). Though it is open source, the package is not intended to be used by third parties.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/spatie-price-api.jpg?t=2" width="419px" />](https://spatie.be/github-ad-click/spatie-price-api)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/spatie-price-api
```

## Usage

You can get a pricing information using the `Spatie\PriceApi\SpatiePriceApi::getPriceForPurchasable()` method.

### Fetching prices in the browser

The price depends on the country of the visitor. When prices are fetched on the server, a page can't be cached at the edge. Instead, you can let the browser of the visitor fetch the price from the spatie.be API.

Add the scripts to your layout:

```blade
{{ \Spatie\PriceApi\SpatiePriceApi::scripts() }}
```

This adds two Alpine data components: `spatiePrice($purchasableId)` and `spatieBundlePrice($bundleId)`.

```blade
<div x-data="spatiePrice(20)" x-init="init()">
    <template x-if="discount.active">
        <p>
            <span x-text="discount.name"></span> ending in
            <span x-text="countdown.days"></span> days
            <span x-text="countdown.hours"></span> hours
            <span x-text="countdown.minutes"></span> minutes
        </p>
    </template>

    <s x-show="discount.active" x-text="priceWithoutDiscount"></s>

    <span x-text="couldFetchPrice ? price : '-'">-</span>
</div>
```

These properties are available:

- `loaded`: whether the request to the API has finished
- `couldFetchPrice`: whether a price could be fetched
- `price` and `priceWithoutDiscount`: the formatted price, for example `149 EUR`
- `discount`: an object with `active`, `percentage`, `name` and `expiresAt` (a unix timestamp)
- `countdown`: an object with `days`, `hours`, `minutes` and `seconds` until the discount expires, updated every second
- `response`: the raw response of the API

Alpine v3 calls `init()` automatically. On Alpine v2, add `x-init="init()"`. Calling it twice is harmless. Components for the same product share a single request.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
# The price API used at promotional sites for our own products

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/spatie-price-api.svg?style=flat-square)](https://packagist.org/packages/spatie/spatie-price-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/spatie-price-api/run-tests?label=tests)](https://github.com/spatie/spatie-price-api/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/spatie-price-api.svg?style=flat-square)](https://packagist.org/packages/spatie/spatie-price-api)

This package can retrieve prices from the API at spatie.be. It is used at the promotional sites for [our own products](https://spatie.be/products). Though it is open source, the package is not intended to be used by third parties.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/package-spatie-price-api-laravel.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/package-spatie-price-api-laravel)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/spatie-price-api
```

You can publish and run the migrations with:


## Usage

You can get a pricing information using the `App\Support\SpatiePrices\SpatiePriceApi::getPriceForPurchasable()` method.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

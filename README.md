# Flaravel - A Laravel Package for Flutterwave

This package is intended to be used with Laravel implementing the Flutterwave Payment Gateway.
Flutterwave Documentation - [link]<https://developer.flutterwave.com/docs/quickstart>

## Installation

You can install the package via composer:

```bash
composer require shadracnicholas/flaravel
```

## Usage

Publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="Shadracnicholas\Flaravel\FlaravelServiceProvider"
```

Update your .env file with the configuration

```php
FLW_PUBLIC_KEY=FLWPUBK-xxxxxxxxxxxxxxxxxxxxx-X
FLW_SECRET_KEY=FLWSECK-xxxxxxxxxxxxxxxxxxxxx-X
FLW_SECRET_HASH='create a random string'
```

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email me@shadracnicholas.com instead of using the issue tracker.

## Credits

- [ShadracK Nicholas](https://github.com/shadracnicholas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

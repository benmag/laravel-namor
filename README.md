# Namor
Namor - A domain-safe name generator

This package is based on the [Namor package by jsonmaur](https://github.com/jsonmaur/namor).

## Getting started
**Install via Composer**
```bash
composer install benmag/laravel-namor
```

**Register service provider**
Add the `NamorServiceProvider` to your `config/app.php` file in the providers key
```php
'providers' => [
    // ... other providers
    Benmag\Namor\NamorServiceProvider::class,
]
```

## Usage
```
use Benmag\Namor\Namor;

Namor::generate([number of words], [number of trailing numbers], [seperator character]);

// Defaults to 2 words and 4 trailing numbers
Namor::generate()

// Generate with 3 words and no numbers
Namor::generate(3, 0);
```

## Configuration
You may also publish the config file to `config/namor.php` which will let you customise the words used to generate the names.
```bash
php artisan vendor:publish --provider="Benmag\Namor\NamorServiceProvider"
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


# Laravel HTML Minifier

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://packagist.org/packages/dipeshsukhia/laravel-html-minify)
[![Build Status](https://img.shields.io/travis/dipeshsukhia/laravel-html-minify/master.svg?style=flat-square)](https://travis-ci.org/dipeshsukhia/laravel-html-minify)
[![Quality Score](https://img.shields.io/scrutinizer/g/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://scrutinizer-ci.com/g/dipeshsukhia/laravel-html-minify)
[![Total Downloads](https://img.shields.io/packagist/dt/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://packagist.org/packages/dipeshsukhia/laravel-html-minify)

This package helps to minify your project`s html (blade file) output.

## Installation

You can install the package via composer:

```bash
composer require dipeshsukhia/laravel-html-minify
```

## Usage

``` php
php artisan vendor:publish --tag=LaravelHtmlMinify


you should add middleware to your web middleware group within your app/Http/Kernel.php file:
use DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml;
LaravelMinifyHtml::class

add in env
for enable
HTML_MINIFY = true
for disable
HTML_MINIFY = false

for particular html part 
LaravelHtmlMinifyFacade::htmlMinify("<div>...</div>");
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dipesh.sukhia@gmail.com instead of using the issue tracker.

## Credits

- [Dipesh Sukhia](https://github.com/dipeshsukhia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


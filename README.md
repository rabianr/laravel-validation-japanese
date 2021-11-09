# Japanese validation rules for Laravel

## Installation

```sh
composer require rabianr/laravel-validation-japanese
```

## Configuration

Publish the config to copy the file to your own config:
```sh
php artisan vendor:publish --tag="japaneseValidation"
```

## Usage

```php
use Rabianr\Validation\Japanese\Rules\Hiragana;

$validator = Validator::make($request->all(), [
    'title' => [
        'required',
        new Hiragana,
    ],
]);
```

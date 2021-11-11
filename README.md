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

Allows Hiragana only
```php
use Rabianr\Validation\Japanese\Rules\Hiragana;

$validator = Validator::make($request->all(), [
    'title' => [
        'required',
        new Hiragana,
    ],
]);
```

Allows Hiragana, whitespace and Level 1 - 2 Kanji only
```php
use Rabianr\Validation\Japanese\Rules\Hiragana;
use Rabianr\Validation\Japanese\Rules\Kanji;

$validator = Validator::make($request->all(), [
    'title' => [
        'required',
        new Hiragana([ ' ', new Kanji('', true) ]),
    ],
]);
```

## Available Rules

| Class | Constructor |
| ----- | ----------- |
| Rabianr\Validation\Japanese\Rules\Hiragana | __construct($allowChars = '') |
| Rabianr\Validation\Japanese\Rules\Katakana | __construct($allowChars = '') |
| Rabianr\Validation\Japanese\Rules\Kanji | __construct($allowChars = '', $JISX0208 = false) |

## Trims full-width whitespace Middleware
```php
use Rabianr\Validation\Japanese\Middleware\TrimStrings
```

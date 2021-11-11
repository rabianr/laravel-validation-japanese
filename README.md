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

| Class | Constructor | Usage |
| ----- | ----------- | ----- |
| Rabianr\Validation\Japanese\Rules\Hiragana | __construct($allowChars = '') | The field under validation must be Hiragana and ```$allowChars``` only. |
| Rabianr\Validation\Japanese\Rules\Katakana | __construct($allowChars = '') | The field under validation must be Katakana and ```$allowChars``` only. |
| Rabianr\Validation\Japanese\Rules\Kanji | __construct($allowChars = '', $JISX0208 = false) | The field under validation must be Kanji and ```$allowChars``` only. If ```$JISX0208``` is ```true```, Kanji must be Level 1 and 2. |
| Rabianr\Validation\Japanese\Rules\KanjiJISX0208 | __construct() | If the field under validation contains Kanji, must be Level 1 and 2 only. |

## Trims full-width whitespace Middleware
```php
use Rabianr\Validation\Japanese\Middleware\TrimStrings
```

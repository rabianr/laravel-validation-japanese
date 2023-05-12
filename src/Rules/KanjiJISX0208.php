<?php

namespace Rabianr\Validation\Japanese\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validate Level 1, Level 2 Kanji
 */
class KanjiJISX0208 implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match_all('/\p{Han}+/ux', $value, $m)) {
            $kanjis = implode('', $m[0]);

            return $kanjis === mb_convert_encoding(
                mb_convert_encoding($kanjis, 'ISO-2022-JP', 'UTF-8'), 'UTF-8', 'ISO-2022-JP');
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('japaneseValidation::validation.kanji_jisx0208');
    }
}

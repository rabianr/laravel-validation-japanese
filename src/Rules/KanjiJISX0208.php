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
            $kanjis = mb_convert_encoding(implode('', $m[0]), 'sjis-win', 'utf-8');

            $origRegexEncoding = mb_regex_encoding();
            mb_regex_encoding('sjis-win');

            // Determine if not Level 1, Level 2 kanji
            if (mb_ereg('[^\x{889F}-\x{9872}\x{989F}-\x{EAA4}]+', $kanjis)) {
                mb_regex_encoding($origRegexEncoding);

                return false;
            }

            mb_regex_encoding($origRegexEncoding);
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

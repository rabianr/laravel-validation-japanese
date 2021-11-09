<?php

namespace Rabianr\Validation\Japanese\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validate Hiragana
 */
class Hiragana implements Rule
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
        return ! preg_match('/[^\p{Hiragana}]+/ux', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('japaneseValidation::validation.hiragana');
    }
}

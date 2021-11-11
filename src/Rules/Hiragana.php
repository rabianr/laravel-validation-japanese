<?php

namespace Rabianr\Validation\Japanese\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validate Hiragana
 */
class Hiragana implements Rule
{
    /**
     * Additional characters that will be allowed
     *
     * @var string
     */
    protected $allowChars;

    /**
     * Create a new rule instance.
     *
     * @param  string  $allowChars  Additional characters that will be allowed.
     * @return void
     */
    public function __construct($allowChars = '')
    {
        $this->allowChars = $allowChars;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! preg_match("/[^\p{Hiragana}{$this->allowChars}]+/ux", $value);
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

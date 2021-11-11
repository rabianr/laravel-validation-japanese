<?php

namespace Rabianr\Validation\Japanese\Rules;

/**
 * Validate Hiragana
 */
class Hiragana extends Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  string|array  $allowChars  Additional characters that will be allowed.
     * @return void
     */
    public function __construct($allowChars = '')
    {
        parent::__construct($allowChars);

        $this->charType = __('japaneseValidation::validation.type.hiragana');
        $this->setMessage(__('japaneseValidation::validation.hiragana'));
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
        $denied = preg_match_all("/[^\p{Hiragana}{$this->allowChars}]+/ux", $value, $matches);

        if ($denied) {
            return $this->passesAllowedRules($attribute, implode('', $matches[0]));
        }

        return true;
    }
}

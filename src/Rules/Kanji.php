<?php

namespace Rabianr\Validation\Japanese\Rules;

/**
 * Validate Kanji
 */
class Kanji extends Rule
{
    /**
     * Allow level 1, level 2 Kanji only.
     *
     * @var bool
     */
    protected bool $JISX0208 = false;

    /**
     * Create a new rule instance.
     *
     * @param  string|array  $allowChars  Additional characters that will be allowed.
     * @param  bool          $JISX0208    Allow level 1, level 2 Kanji only.
     * @return void
     */
    public function __construct($allowChars = '', $JISX0208 = false)
    {
        parent::__construct($allowChars);

        $this->JISX0208 = $JISX0208;
        $this->charType = __('japaneseValidation::validation.type.kanji');
        $this->setMessage(__('japaneseValidation::validation.kanji'));
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
        $denied = preg_match_all("/[^\p{Han}{$this->allowChars}]+/ux", $value, $matches);

        if ($this->JISX0208 && ! $denied) {
            if ($denied = ! (new KanjiJISX0208)->passes($attribute, $value)) {
                $this->setMessage(__('japaneseValidation::validation.kanji_jisx0208'));
            }
        }

        if ($denied) {
            return $this->passesAllowedRules($attribute, implode('', $matches[0]));
        }

        return true;
    }
}

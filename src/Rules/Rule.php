<?php

namespace Rabianr\Validation\Japanese\Rules;

use Illuminate\Contracts\Validation\Rule as RuleInterface;

/**
 * Validate Kanji
 */
abstract class Rule implements RuleInterface
{
    /**
     * Type of character.
     *
     * @var string
     */
    protected string $charType;

    /**
     * Additional characters that will be allowed
     *
     * @var string
     */
    protected string $allowChars = '';

    /**
     * Aditional rules that will be allowed
     *
     * @var array
     */
    protected array $allowRules = [];

    /**
     * The validation error message.
     *
     * @var string
     */
    protected string $message;

    /**
     * Create a new rule instance.
     *
     * @param  string|array  $allowChars  Additional characters that will be allowed.
     * @return void
     */
    public function __construct($allowChars = '')
    {
        if (is_array($allowChars)) {
            foreach ($allowChars as $allowChar) {
                if (is_object($allowChar)) {
                    $this->allowRules[] = $allowChar;
                } else {
                    $this->allowChars .= $allowChar;
                }
            }
        } else {
            $this->allowChars = $allowChars;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return str_replace(':charType', $this->charType, $this->message);
    }

    /**
     * Set the validation error message.
     *
     * @param  string  $message
     */
    protected function setMessage($message)
    {
        $this->message = $message;

        foreach ($this->allowRules as $rule) {
            $this->message = str_replace(':charType',
                ":charType, {$rule->charType()}", $this->message);
        }
    }

    /**
     * Get the type of character
     *
     * @return string
     */
    protected function charType()
    {
        return $this->charType;
    }

    /**
     * Determine if addtional rules pass.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    protected function passesAllowedRules($attribute, $value)
    {
        if ($this->allowRules) {
            $rule = array_shift($this->allowRules);
            $rule->mergeAllowedRules($this->allowRules);

            return $rule->passes($attribute, $value);
        }

        return false;
    }

    /**
     * Merge addtional rules.
     *
     * @param  array  $rules
     * @return self
     */
    protected function mergeAllowedRules(array $rules)
    {
        $this->allowRules = array_merge($this->allowRules, $rules);

        return $this;
    }
}

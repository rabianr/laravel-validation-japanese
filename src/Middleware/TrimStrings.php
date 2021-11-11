<?php

namespace Rabianr\Validation\Japanese\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        // Trim unicode whitepsace
        $value = is_string($value)
            ? preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $value)
            : $value;

        return parent::transform($key, $value);
    }
}

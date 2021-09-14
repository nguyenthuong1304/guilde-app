<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UrlRule implements Rule
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
        $regex = 'https?\:\/\/?';
        $regex .= '([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?';
        $regex .= '([a-z0-9-.]*)\.([a-z]{2,3})';
        $regex .= '(\:[0-9]{2,5})?';
        $regex .= '(\/([a-z0-9+\$_-]\.?)+)*\/?';
        $regex .= '(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?';
        $regex .= '(#[a-z_.-][a-z0-9+\$_.-]*)?';

        return $value === '#' || preg_match("/^$regex$/i", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.regex');
    }
}

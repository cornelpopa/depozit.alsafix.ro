<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GescomBlExportFileExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return (file_exists('C:/BL/'.$value.'.csv'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Fisierul CSV din Gescom lipseste!';
    }
}

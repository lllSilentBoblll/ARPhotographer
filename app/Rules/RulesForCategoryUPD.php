<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RulesForCategoryUPD implements Rule
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
        //только там нихуя нету про то как писать в этом файле свой валидатор кроме того что сюда нуно передавать какие-то параметры
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
